<?php

namespace Modules\CommunicationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\CommunicationManagement\Entities\Announcement;
use Modules\SchoolManagement\Entities\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Modules\RoleManagement\Entities\RoleCategory;
use Modules\CommunicationManagement\Traits\CommunicationTrait;
use DB;
use Session;
use Excel;
use File;
use Datatables;
use Image;
use Auth;

class AnnouncementController extends Controller
{
    use CommunicationTrait;
    public function __construct()
    {

        $this->programs = Program::where('published', true)->pluck("label", "id");
        return $this->middleware('auth');
    }

    public function manage()
    {
        //
        $announcements = Announcement::all ();
        $rolecategories = RoleCategory::wherePublished(true)->pluck("profile_type", "id");
        return view('communicationmanagement::announcements.manage', compact('announcements', 'rolecategories') );
    }

    public function outbox($status)
    {
        $user = Auth::user();
        $announcements = $user->Announcements()->whereStatus($status)->get();
        $rolecategories = RoleCategory::wherePublished(true)->pluck("profile_type", "id");
        return view('communicationmanagement::announcements.manage', compact('announcements', 'rolecategories'));
    }

    public function inbox()
    {
        $user = Auth::user();
        $announcements = $user->infobox;
        $rolecategories = RoleCategory::wherePublished(true)->pluck("profile_type", "id");
        return view('communicationmanagement::announcements.manage', compact('announcements', 'rolecategories'));
    }

    public function academicterm(AcademicTerm $academicterm)
    {
        $announcements = Announcement::whereAcademicTermId($academicterm->id)->get();
        return view('communicationmanagement::announcements.academicterm', compact('announcements', 'academicterm'));
    }



    public function announcement($slug)
    {
        //dd($activityType);
        $announcement = Announcement::where('slug', $slug)->first();
        $announcement->increment('page_views');
        return view('communicationmanagement::announcements.announcement', compact('announcement'));
    }
    public function toggle(Announcement $announcement)
    {
        if ($announcement->published == 1) {
            $announcement->published = 0;
            $feedback = 'Announcement Unpublished successfully';
        } else {
            $announcement->published = 1;
            $feedback = 'Announcement Unpublished successfully';
        }
        if ( ! $announcement->save()) {
            return redirect()->back()->with('error', 'Could not update Announcement Status');
        }
        return redirect()->back()->with('success', $feedback);
    }

    public function change(Request $request)
    {
        $this->validate($request, [
           'announcement_id' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        $this->status = $request->status;
        $this->announcement = Announcement::findorFail($request->announcement_id);

        switch ($this->status){
            case "Scheduled":

            // send notification to
            break;
            case "Approved":
                // send notification to
                $this->announcement->published = 1;

            break;
            case "Rejected":
            //send test notification to client

            break;
            case "Archived":
            break;
            default:
            return redirect()->back();
            //$this->announcement->status = 'Scheduled';
            }
            $this->announcement->status = $this->status;
            $this->msgtitle = 'success';
            $this->msgbody = $this->announcement->status. ' Updated sucessfully';
            if($this->announcement->save())
            {
                return redirect()->back()->with($this->msgtitle, $this->msgbody);
            }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $announcements = Announcement::all ();
        return view('communicationmanagement::announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $announcements = Announcement::all();
        // $statuses = $this->statuses;
        $rolecategories = RoleCategory::wherePublished(true)->pluck("profile_type", "id");
        $programs = $this->programs;
        return view('communicationmanagement::announcements.create', compact('announcements', 'programs','rolecategories'));
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
            'subject' => 'required',
            'body' => 'required'
        ]);
        $this->data = $request->all();
        $this->announcement = new Announcement;
        $this->announcement->subject = $this->data['subject'] ;
        $this->announcement->body = $this->data['body'];
        $this->announcement->action_text = !empty($this->data['action_text']) ? $this->data['action_text'] : NULL;
        $this->announcement->action_url = !empty($this->data['action_url']) ? $this->data['action_url'] : NULL;
        $this->announcement->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        $this->announcement->academic_term_id = $this->data['academic_term_id'];
        if(!$this->announcement->save())
        {
            return redirect()->back()->withInput();
        }
        if(!isset($this->data['users']))
        {
            switch ($request->recipient_type){
                case "level":
                    $levels = Level::findOrFail($request->recipient_id);
                    $users = User::with('Profile')
                            ->whereHas('Profile.Pupils', function($query){
                                $query->where('role_id', $this->data['recipient_id']);
                                })->get();
                    if ( ! $subject->Lives()->save($this->live)) {
                        return redirect()->back()->withInput()->withErrors('Could not schedule live lesson for the subject, contact the admin');
                    }
                    break;
                case "role":
                    $users = User::with('Profile')
                            ->whereHas('Profile', function($query){
                                $query->where('role_id', $this->data['recipient_id']);
                                })->get();
                break;
                case "profile_type":
                    $roleCategory = RoleCategory::find($request->recipient_id);
                    $this->live->access_code = $roleCategory->slug;
                    if ( ! $classroom->Lives()->save($this->live)) {
                        return redirect()->back()->withInput()->withErrors('Could not schedule live lesson for the subject, contact the admin');
                    }
                break;

                }
        }
        $this->announcement->Recipients()->sync($this->data['users']);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $this->announcement->addMediaFromRequest('image')->toMediaCollection('images');
        }

       return redirect()->route('announcements.show', $announcement->id)->with('success','Announcement Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
        return view('communicationmanagement::announcements.show',compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
        return view('communicationmanagement::announcements.edit',compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
        $this->validate($request, [
            'subject' => 'required',
            'body' => 'required'
        ]);
        $announcement = Announcement::findorFail($announcement->id);
        $announcement->subject = $request->subject ;
        $announcement->body = $request->body;
        //$announcement->display_order = $request->display_order;
        if(!$announcement->save())
        {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }
       return redirect()->route('announcements.show', $announcement->id)->with('success','Announcement Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
        $announcement->delete();
         return redirect()->route('manageSections')
                         ->with('success','Announcement deleted successfully');
    }
}
