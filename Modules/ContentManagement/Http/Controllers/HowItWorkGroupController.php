<?php

namespace Modules\ContentManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Modules\ContentManagement\Entities\HowItWork;
use Modules\ContentManagement\Entities\HowItWorkGroup;

class HowItWorkGroupController extends Controller
{
    private function hasPivotTable()
    {
        return Schema::hasTable('how_it_work_group_items');
    }

    private function hasPivotDisplayOrder()
    {
        return $this->hasPivotTable() && Schema::hasColumn('how_it_work_group_items', 'display_order');
    }

    private function hasPivotItemEnabled()
    {
        return $this->hasPivotTable() && Schema::hasColumn('how_it_work_group_items', 'is_enabled');
    }

    private function nextGroupItemOrder(HowItWorkGroup $group)
    {
        if (!$this->hasPivotDisplayOrder()) {
            return 1;
        }

        $max = $group->howItWorks()->max('how_it_work_group_items.display_order');
        return ((int) $max) + 1;
    }

    private function ensureLegacyGroupItems(HowItWorkGroup $group)
    {
        $legacyIds = HowItWork::where('how_it_work_group_id', $group->id)
            ->whereDoesntHave('groups', function ($query) use ($group) {
                $query->where('how_it_work_groups.id', $group->id);
            })
            ->orderBy('display_order')
            ->orderBy('id')
            ->pluck('id');

        if ($legacyIds->isEmpty()) {
            return;
        }

        if (!$this->hasPivotDisplayOrder()) {
            $group->howItWorks()->syncWithoutDetaching($legacyIds->all());
            return;
        }

        $nextOrder = $this->nextGroupItemOrder($group);
        $attachData = [];
        foreach ($legacyIds as $howItWorkId) {
            $pivotPayload = ['display_order' => $nextOrder++];
            if ($this->hasPivotItemEnabled()) {
                $pivotPayload['is_enabled'] = true;
            }
            $attachData[$howItWorkId] = $pivotPayload;
        }

        $group->howItWorks()->attach($attachData);
    }

    public function manage()
    {
        $groups = HowItWorkGroup::withCount('howItWorks')->orderBy('display_order')->get();
        return view('contentmanagement::howitworks.groups', compact('groups'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:190|unique:how_it_work_groups,name',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:1',
            'published' => 'nullable|boolean',
        ]);

        HowItWorkGroup::create([
            'name' => $request->name,
            'description' => $request->description,
            'display_order' => $request->display_order ?? 1,
            'published' => $request->has('published') ? (bool) $request->published : true,
        ]);

        return redirect()->route('howitworks.groups.manage')->with('success', 'Workflow group created successfully.');
    }

    public function update(Request $request, HowItWorkGroup $group)
    {
        $this->validate($request, [
            'name' => 'required|string|max:190|unique:how_it_work_groups,name,' . $group->id,
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:1',
            'published' => 'nullable|boolean',
        ]);

        $group->update([
            'name' => $request->name,
            'description' => $request->description,
            'display_order' => $request->display_order ?? 1,
            'published' => $request->has('published') ? (bool) $request->published : $group->published,
        ]);

        HowItWork::where('how_it_work_group_id', $group->id)->update([
            'forwhom' => $group->name,
        ]);

        return redirect()->route('howitworks.groups.manage')->with('success', 'Workflow group updated successfully.');
    }

    public function show(HowItWorkGroup $group)
    {
        $this->ensureLegacyGroupItems($group);

        $items = $group->howItWorks()
            ->with(['groups' => function ($query) {
                $query->orderBy('how_it_work_groups.display_order');
            }]);

        if ($this->hasPivotDisplayOrder()) {
            $items->orderBy('how_it_work_group_items.display_order');
        }

        $items = $items
            ->orderBy('how_it_works.label')
            ->get();

        $attachableItems = HowItWork::whereDoesntHave('groups', function ($query) use ($group) {
                $query->where('how_it_work_groups.id', $group->id);
            })
            ->orderBy('label')
            ->get();

        return view('contentmanagement::howitworks.group_show', compact('group', 'items', 'attachableItems'));
    }

    public function attachItems(Request $request, HowItWorkGroup $group)
    {
        $this->validate($request, [
            'howitwork_ids' => 'required|array|min:1',
            'howitwork_ids.*' => 'required|exists:how_it_works,id',
        ]);

        $this->ensureLegacyGroupItems($group);

        $incomingIds = collect($request->input('howitwork_ids', []))
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->values();

        $alreadyAttached = $group->howItWorks()
            ->whereIn('how_it_works.id', $incomingIds->all())
            ->pluck('how_it_works.id')
            ->map(function ($id) {
                return (int) $id;
            })
            ->all();

        $newIds = $incomingIds->reject(function ($id) use ($alreadyAttached) {
            return in_array($id, $alreadyAttached, true);
        })->values();

        if ($newIds->isEmpty()) {
            return redirect()->route('howitworks.groups.show', $group->id)
                ->with('error', 'Selected items are already attached to this group.');
        }

        $attachData = $newIds->all();
        if ($this->hasPivotDisplayOrder()) {
            $nextOrder = $this->nextGroupItemOrder($group);
            $attachData = [];
            foreach ($newIds as $howItWorkId) {
                $pivotPayload = ['display_order' => $nextOrder++];
                if ($this->hasPivotItemEnabled()) {
                    $pivotPayload['is_enabled'] = true;
                }
                $attachData[$howItWorkId] = $pivotPayload;
            }
        } elseif ($this->hasPivotItemEnabled()) {
            $attachData = [];
            foreach ($newIds as $howItWorkId) {
                $attachData[$howItWorkId] = ['is_enabled' => true];
            }
        }

        $group->howItWorks()->attach($attachData);

        HowItWork::whereIn('id', $newIds->all())
            ->where(function ($query) {
                $query->whereNull('how_it_work_group_id')
                    ->orWhere('how_it_work_group_id', 0);
            })
            ->update([
                'how_it_work_group_id' => $group->id,
                'forwhom' => $group->name,
            ]);

        return redirect()->route('howitworks.groups.show', $group->id)
            ->with('success', $newIds->count() . ' item(s) attached to the group successfully.');
    }

    public function updateItemOrder(Request $request, HowItWorkGroup $group, HowItWork $howitwork)
    {
        if (!$this->hasPivotDisplayOrder()) {
            return redirect()->route('howitworks.groups.show', $group->id)
                ->with('error', 'Run migrations to enable group-level display ordering.');
        }

        $this->validate($request, [
            'display_order' => 'required|integer|min:1',
        ]);

        $this->ensureLegacyGroupItems($group);

        $isAttached = $group->howItWorks()
            ->where('how_it_works.id', $howitwork->id)
            ->exists();

        if (!$isAttached) {
            return redirect()->route('howitworks.groups.show', $group->id)
                ->with('error', 'Item does not belong to this group.');
        }

        $group->howItWorks()->updateExistingPivot($howitwork->id, [
            'display_order' => (int) $request->display_order,
        ]);

        return redirect()->route('howitworks.groups.show', $group->id)
            ->with('success', 'Group item order updated successfully.');
    }

    public function toggle(HowItWorkGroup $group)
    {
        $group->published = ! $group->published;
        $group->save();

        return redirect()->route('howitworks.groups.manage')->with('success', 'Workflow group status updated.');
    }

    public function toggleItemStatus(HowItWorkGroup $group, HowItWork $howitwork)
    {
        if (!$this->hasPivotItemEnabled()) {
            return redirect()->route('howitworks.groups.show', $group->id)
                ->with('error', 'Run migrations to enable group-level item status toggling.');
        }

        $this->ensureLegacyGroupItems($group);

        $item = $group->howItWorks()
            ->where('how_it_works.id', $howitwork->id)
            ->first();

        if (!$item) {
            return redirect()->route('howitworks.groups.show', $group->id)
                ->with('error', 'Item does not belong to this group.');
        }

        $currentlyEnabled = (bool) ($item->pivot->is_enabled ?? true);

        $group->howItWorks()->updateExistingPivot($howitwork->id, [
            'is_enabled' => !$currentlyEnabled,
        ]);

        return redirect()->route('howitworks.groups.show', $group->id)
            ->with('success', 'Group item status updated successfully.');
    }

    public function detachItem(HowItWorkGroup $group, HowItWork $howitwork)
    {
        $this->ensureLegacyGroupItems($group);

        $isAttached = $howitwork->groups()
            ->where('how_it_work_groups.id', $group->id)
            ->exists();
        $isLegacyPrimary = (int) $howitwork->how_it_work_group_id === (int) $group->id;

        if (!$isAttached && !$isLegacyPrimary) {
            return redirect()->route('howitworks.groups.show', $group->id)
                ->with('error', 'Item does not belong to this group.');
        }

        if ($isAttached) {
            $howitwork->groups()->detach($group->id);
        }

        if ($isLegacyPrimary) {
            $replacementQuery = $howitwork->groups();
            if ($this->hasPivotDisplayOrder()) {
                $replacementQuery->orderBy('how_it_work_group_items.display_order');
            }
            $replacementGroup = $replacementQuery->first();
            $howitwork->how_it_work_group_id = $replacementGroup ? $replacementGroup->id : null;
            if ($replacementGroup) {
                $howitwork->forwhom = $replacementGroup->name;
            } else {
                $howitwork->forwhom = '';
            }
            $howitwork->save();
        }

        return redirect()->route('howitworks.groups.show', $group->id)
            ->with('success', 'Item removed from workflow group successfully.');
    }

    public function destroy(HowItWorkGroup $group)
    {
        $count = HowItWork::where('how_it_work_group_id', $group->id)
            ->orWhereHas('groups', function ($query) use ($group) {
                $query->where('how_it_work_groups.id', $group->id);
            })
            ->count();
        if ($count > 0) {
            return redirect()->route('howitworks.groups.manage')->with('error', 'Remove items from this group before deleting it.');
        }

        $group->delete();
        return redirect()->route('howitworks.groups.manage')->with('success', 'Workflow group deleted successfully.');
    }
}
