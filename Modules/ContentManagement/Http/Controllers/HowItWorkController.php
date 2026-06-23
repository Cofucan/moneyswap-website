<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ContentManagement\Entities\HowItWork;
use Modules\ContentManagement\Entities\HowItWorkSection;
use Modules\ContentManagement\Entities\HowItWorkGroup;
use Modules\ContentManagement\Entities\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use DB;
use Session;
use Image;
use File;

class HowItWorkController extends Controller
{
    private function hasGroupItemPivotTable()
    {
        return Schema::hasTable('how_it_work_group_items');
    }

    private function hasGroupItemDisplayOrder()
    {
        return $this->hasGroupItemPivotTable() && Schema::hasColumn('how_it_work_group_items', 'display_order');
    }

    private function hasGroupItemEnabledFlag()
    {
        return $this->hasGroupItemPivotTable() && Schema::hasColumn('how_it_work_group_items', 'is_enabled');
    }

    private function normalizeGroupIds(array $groupIds = [])
    {
        return collect($groupIds)
            ->filter(function ($id) {
                return !empty($id);
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->values()
            ->all();
    }

    private function resolvePrimaryGroup(array $groupIds = [])
    {
        if (empty($groupIds)) {
            return null;
        }

        return HowItWorkGroup::find($groupIds[0]);
    }

    private function nextGroupDisplayOrder($groupId)
    {
        if (!$this->hasGroupItemDisplayOrder()) {
            return 1;
        }

        $max = DB::table('how_it_work_group_items')
            ->where('how_it_work_group_id', $groupId)
            ->max('display_order');

        return ((int) $max) + 1;
    }

    private function buildGroupSyncPayload(array $groupIds, HowItWork $howitwork = null)
    {
        if (!$this->hasGroupItemDisplayOrder() && !$this->hasGroupItemEnabledFlag()) {
            return collect($groupIds)->mapWithKeys(function ($groupId) {
                return [$groupId => []];
            })->toArray();
        }

        $payload = [];
        $existingItems = [];

        if ($howitwork) {
            $columns = ['how_it_work_group_id'];
            if ($this->hasGroupItemDisplayOrder()) {
                $columns[] = 'display_order';
            }
            if ($this->hasGroupItemEnabledFlag()) {
                $columns[] = 'is_enabled';
            }

            $existingItems = DB::table('how_it_work_group_items')
                ->where('how_it_work_id', $howitwork->id)
                ->get($columns)
                ->keyBy('how_it_work_group_id')
                ->toArray();
        }

        foreach ($groupIds as $groupId) {
            $pivotPayload = [];

            if (array_key_exists($groupId, $existingItems)) {
                $existing = $existingItems[$groupId];

                if ($this->hasGroupItemDisplayOrder()) {
                    $pivotPayload['display_order'] = (int) ($existing->display_order ?? 1);
                }

                if ($this->hasGroupItemEnabledFlag()) {
                    $pivotPayload['is_enabled'] = (bool) ($existing->is_enabled ?? true);
                }
            } else {
                if ($this->hasGroupItemDisplayOrder()) {
                    $pivotPayload['display_order'] = $this->nextGroupDisplayOrder($groupId);
                }
                if ($this->hasGroupItemEnabledFlag()) {
                    $pivotPayload['is_enabled'] = true;
                }
            }

            $payload[$groupId] = $pivotPayload;
        }

        return $payload;
    }

    private function sectionDefaults()
    {
        return [
            'swap' => [
                'title' => 'Swap your currency',
                'subtitle' => 'Match with live marketplace offers',
                'description' => 'Browse verified swap requests, compare rates, and confirm the exchange in minutes.',
                'icon' => 'bi-arrow-left-right',
                'display_order' => 1,
                'published' => true,
            ],
            'request' => [
                'title' => 'Request a swap',
                'subtitle' => 'Create a request in seconds',
                'description' => 'Post your desired currencies and amount when no matching request is available.',
                'icon' => 'bi-clipboard-check',
                'display_order' => 2,
                'published' => true,
            ],
            'accept' => [
                'title' => 'Accept a swap',
                'subtitle' => 'Review, confirm, and complete',
                'description' => 'Receive offers, verify details, and securely close your swap.',
                'icon' => 'bi-shield-check',
                'display_order' => 3,
                'published' => true,
            ],
        ];
    }

    private function buildManageSections()
    {
        if (!Schema::hasTable('how_it_work_sections')) {
            return collect($this->sectionDefaults())->map(function ($data, $key) {
                return (object) array_merge(['key' => $key], $data);
            });
        }

        $defaults = $this->sectionDefaults();
        $stored = HowItWorkSection::orderBy('display_order')->get()->keyBy('key');

        $sections = collect($defaults)->map(function ($data, $key) use ($stored) {
            $existing = $stored->get($key);
            $payload = $existing ? array_merge($data, $existing->toArray()) : array_merge(['key' => $key], $data);
            $payload['key'] = $key;
            return (object) $payload;
        });

        $extraKeys = $stored->keys()->diff(array_keys($defaults));
        foreach ($extraKeys as $extraKey) {
            $sections->push((object) $stored->get($extraKey)->toArray());
        }

        return $sections->sortBy('display_order')->values();
    }

    private function displaySections()
    {
        if (!Schema::hasTable('how_it_work_sections')) {
            return collect($this->sectionDefaults())->map(function ($data, $key) {
                return (object) array_merge(['key' => $key], $data);
            });
        }

        $sections = HowItWorkSection::active()->orderBy('display_order')->get();
        if ($sections->isNotEmpty()) {
            return $sections;
        }

        return collect($this->sectionDefaults())->map(function ($data, $key) {
            return (object) array_merge(['key' => $key], $data);
        });
    }

    private function forWhomOptions()
    {
        return [
            'Swapping' => 'Swapping',
            'Requesting' => 'Requesting',
            'Bidding' => 'Bidding',
            'Members' => 'Members',
            'Prospects' => 'Prospects',
            'Investment' => 'Investment',
            'Store' => 'Store',
        ];
    }
    public function __construct()
    {
                
    }
    public function SaveHowitworks()
    {
        $groupIds = $this->normalizeGroupIds($this->data['how_it_work_group_ids'] ?? []);
        if (empty($groupIds) && !empty($this->data['how_it_work_group_id'])) {
            $groupIds = $this->normalizeGroupIds([$this->data['how_it_work_group_id']]);
        }

        $primaryGroup = $this->resolvePrimaryGroup($groupIds);

      
        $this->howitwork = new HowItWork;  
        $this->howitwork->label = $this->data['label'];
        $this->howitwork->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';
        $this->howitwork->display_order = 1;
        $this->howitwork->how_it_work_group_id = $primaryGroup ? $primaryGroup->id : null;
        $this->howitwork->forwhom = $primaryGroup ? $primaryGroup->name : (!empty($this->data['forwhom']) ? $this->data['forwhom'] : '');
        $this->howitwork->published = !empty($this->data['published']) ? $this->data['published'] : '1';             
        $this->howitwork->button_text = !empty($this->data['button_text']) ? $this->data['button_text'] : null;
        $this->howitwork->button_url = !empty($this->data['button_url']) ? $this->data['button_url'] : null;
        if(isset($this->display_image))
        {
            $this->saveDisplayImage() ;
        }
        if ( ! $this->howitwork->save()) {           
            return false;
        }

        $syncPayload = $this->buildGroupSyncPayload($groupIds, $this->howitwork);
        $this->howitwork->groups()->sync($syncPayload);

        return $this->howitwork;
    } 

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'howitwork_id' => 'required',
            'display_image' => 'required|file|mimes:jpeg,jpg,png,gif,mp4,webm,mov|max:20480',
        ]);

        $this->howitwork = HowItWork::findorFail($request->howitwork_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->howitwork->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
    }

    public function saveDisplayImage()
    {
            // create new directory for uploading image if doesn't exist
            $targetDirectory = public_path('images/howitworks/');
            if ( ! File::exists($targetDirectory)) {
                $person_img = File::makeDirectory($targetDirectory, 0777, true);
            }
            $extension = strtolower($this->display_image->getClientOriginalExtension());
            $filename = Str::slug($this->howitwork->label).'_'.time().'.'.$extension;
            $display_image_url = 'images/howitworks/' . $filename;
            $this->howitwork->display_image     = $display_image_url;
            $isVideo = in_array($extension, ['mp4', 'webm', 'mov'], true);
            $isAnimatedGif = $extension === 'gif';

            if ($isVideo || $isAnimatedGif) {
                $this->display_image->move($targetDirectory, $filename);
                return;
            }

            // upload image to server
            Image::make($this->display_image)->fit('389', '439', function ($constraint) {
                $constraint->upsize();
            })->save(public_path($display_image_url));

    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_tag = 'howitworks';
        $page = Page::where('page_tag', $page_tag)->first();
        $groups = HowItWorkGroup::active()
            ->orderBy('display_order')
            ->with(['howItWorks' => function ($query) {
                $query->active();
                if ($this->hasGroupItemEnabledFlag()) {
                    $query->wherePivot('is_enabled', true);
                }
                if ($this->hasGroupItemDisplayOrder()) {
                    $query->orderBy('how_it_work_group_items.display_order');
                } else {
                    $query->orderBy('how_it_works.label');
                }
            }])
            ->get();
        $sections = $groups->map(function ($group) {
            $items = $group->howItWorks->values();
            return (object) [
                'key' => $group->slug,
                'title' => $group->name,
                'subtitle' => null,
                'description' => $group->description,
                'icon' => null,
                'display_order' => (int) $group->display_order,
                'items' => $items,
            ];
        })->filter(function ($section) {
            return $section->items->count() > 0;
        })->values();

        return view('contentmanagement::howitworks.index', compact('sections', 'page'));
    }

    public function getinvolved()
    {
        //
        $page_tag = 'get-involved';
        $page = Page::where('page_tag', $page_tag)->first();
        $howitworks = HowItWork::public()->get();
        return view('contentmanagement::howitworks.involve', compact('howitworks', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $forwhom = $this->forWhomOptions();
        $groups = HowItWorkGroup::orderBy('display_order')->get();
        return view('contentmanagement::howitworks.create', compact('forwhom', 'groups'));
    }

    public function client()
    {
        //
        $page_tag = 'howtoenrol';
        $page = Page::where('page_tag', $page_tag)->first();
        $page->increment('page_views'); 
        $howitworks = HowItWork::client()->get();
        return view('contentmanagement::howitworks.clients', compact('howitworks', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [  
            'label' => 'required',
            'overview' => 'required',
            'how_it_work_group_ids' => 'nullable|array',
            'how_it_work_group_ids.*' => 'required|exists:how_it_work_groups,id',
            'published' => 'nullable|boolean',
            'display_image' => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4,webm,mov|max:20480',
        ]);        
        $this->data = $request->all();       
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
        }
        if(!$this->SaveHowitworks())
        {
            return redirect()->back()->with('error','Could not save How It Work at the moment. Try Again later.');
        }
        return redirect()->route('howitworks.manage')->with('success','How It Work Added successfully.');
    }

    public function toggle(HowItWork $howitwork)
    {
        if ($howitwork->published == 1) {
            $howitwork->published = 0; 
            $feedback = 'How it Work Unpublished successfully';        
        } else {
            $howitwork->published = 1;
            $feedback = 'How it Work Published successfully';
        }
        if ( ! $howitwork->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HowItWork  $howitwork
     * @return \Illuminate\Http\Response
     */
    public function show(HowItWork $howitwork)
    {
        //
        $forwhom = $this->forWhomOptions();
        $howitwork->loadMissing(['groups' => function ($query) {
            $query->orderBy('how_it_work_groups.display_order');
        }]);
        $groups = HowItWorkGroup::orderBy('display_order')->get();
        return view('contentmanagement::howitworks.show',compact('howitwork', 'forwhom', 'groups'));
    }

    public function manage()
    {
    $howitworks = HowItWork::with([
        'group',
        'groups' => function ($query) {
            $query->orderBy('display_order');
        },
    ])->orderBy('id', 'desc')->get();
    $forwhom = $this->forWhomOptions();
    $groups = HowItWorkGroup::orderBy('display_order')->get();
    return view('contentmanagement::howitworks.manage', compact('howitworks', 'forwhom', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HowItWork  $howitwork
     * @return \Illuminate\Http\Response
     */
    public function edit(HowItWork $howitwork)
    {
        //      
        $forwhom = $this->forWhomOptions();
        $groups = HowItWorkGroup::orderBy('display_order')->get();
        $howitwork->loadMissing(['groups' => function ($query) {
            $query->orderBy('display_order');
        }]);
        return view('contentmanagement::howitworks.edit',compact('howitwork', 'forwhom', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HowItWork  $howitwork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HowItWork $howitwork)
    {
        //
        $this->validate($request, [
            'label' => 'required',
            'overview' => 'required',
            'how_it_work_group_ids' => 'nullable|array',
            'how_it_work_group_ids.*' => 'required|exists:how_it_work_groups,id',
            'published' => 'nullable|boolean',
        ]);

        $groupIds = $this->normalizeGroupIds($request->input('how_it_work_group_ids', []));
        $primaryGroup = $this->resolvePrimaryGroup($groupIds);
        $payload = $request->only([
            'label',
            'overview',
            'button_text',
            'button_url',
            'published',
        ]);
        $payload['how_it_work_group_id'] = $primaryGroup ? $primaryGroup->id : null;
        $payload['forwhom'] = $primaryGroup ? $primaryGroup->name : '';

        if( ! $howitwork->update($payload)) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }

        $syncPayload = $this->buildGroupSyncPayload($groupIds, $howitwork);
        $howitwork->groups()->sync($syncPayload);

        return redirect()->route('howitworks.manage')->with('success','How it Work Updateded successfully.');
    }

    public function syncGroups(Request $request, HowItWork $howitwork)
    {
        $this->validate($request, [
            'how_it_work_group_ids' => 'nullable|array',
            'how_it_work_group_ids.*' => 'required|exists:how_it_work_groups,id',
        ]);

        $groupIds = $this->normalizeGroupIds($request->input('how_it_work_group_ids', []));
        $primaryGroup = $this->resolvePrimaryGroup($groupIds);

        $syncPayload = $this->buildGroupSyncPayload($groupIds, $howitwork);
        $howitwork->groups()->sync($syncPayload);

        $howitwork->how_it_work_group_id = $primaryGroup ? $primaryGroup->id : null;
        $howitwork->forwhom = $primaryGroup ? $primaryGroup->name : '';
        $howitwork->save();

        return redirect()->route('howitworks.show', $howitwork->id)
            ->with('success', 'How It Works group attachments updated successfully.');
    }

    public function updateSections(Request $request)
    {
        if (!Schema::hasTable('how_it_work_sections')) {
            return redirect()->route('howitworks.manage')->with('error', 'Please run migrations to enable section editing.');
        }

        $this->validate($request, [
            'sections' => 'required|array',
            'sections.*.title' => 'required|string|max:190',
            'sections.*.subtitle' => 'nullable|string|max:190',
            'sections.*.description' => 'nullable|string',
            'sections.*.icon' => 'nullable|string|max:190',
            'sections.*.display_order' => 'nullable|integer|min:1',
            'sections.*.published' => 'nullable|boolean',
        ]);

        foreach ($request->input('sections') as $key => $payload) {
            $data = [
                'key' => $key,
                'title' => $payload['title'] ?? '',
                'subtitle' => $payload['subtitle'] ?? null,
                'description' => $payload['description'] ?? null,
                'icon' => $payload['icon'] ?? null,
                'display_order' => !empty($payload['display_order']) ? (int) $payload['display_order'] : 1,
                'published' => array_key_exists('published', $payload) ? (bool) $payload['published'] : false,
            ];

            HowItWorkSection::updateOrCreate(['key' => $key], $data);
        }

        return redirect()->route('howitworks.manage')->with('success', 'How It Works sections updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HowItWork  $howitwork
     * @return \Illuminate\Http\Response
     */
    public function destroy(HowItWork $howitwork)
    {
        if ($howitwork->groups()->exists() || !empty($howitwork->how_it_work_group_id)) {
            return redirect()->back()->with('error', 'Detach this item from all workflow groups before deleting it.');
        }

        $howitwork->delete();
        return redirect()->back()
                        ->with('success','How It Works item deleted successfully');
    }
}
