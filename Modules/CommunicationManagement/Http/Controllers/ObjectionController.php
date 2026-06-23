<?php

namespace Modules\CommunicationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\CommunicationManagement\Entities\Objection;
use Modules\CommunicationManagement\Traits\ObjectionTrait;
use Illuminate\Http\Request;
use Session;
class ObjectionController extends Controller
{
    use ObjectionTrait;

    public function process(Request $request)
    {
        $this->validate($request, [
           'objection_id' => 'required'
        ]);
        $this->data = $request->all();
        if(!$this->processObjection())
        {
            return redirect()->back()->with('error', 'Cannot perform action');
        }
        $this->msghead = 'success';
        $this->msgbody = 'Objection marked as resolved';
        return redirect()->back()->with($this->msghead, $this->msgbody);
    }

    public function manage()
    {
        $objections = Objection::pending()->get();
        return view('communicationmanagement::objections.manage', compact('objections'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('communicationmanagement::objections.image');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('communicationmanagement::objections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $this->validate($request, [
        'reason' => 'required',
        'objectionable_type' => 'required',
        'objectionable_id' => 'required'
    ]);
    $this->data = $request->all();
    if ( ! $this->saveObjection()) {
        return redirect()->back()->with('error', 'Cannot perform action');
    }
    return back()->with('success', 'Objection generated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Objection  $objection
     * @return \Illuminate\Http\Response
     */
    public function show(Objection $objection)
    {
        //
        return view('communicationmanagement::objections.show', compact('objection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Objection  $objection
     * @return \Illuminate\Http\Response
     */
    public function edit(Objection $objection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Objection  $objection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objection $objection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Objection  $objection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objection $objection)
    {
        //
        $objection->delete();
        return redirect()->back()
                        ->with('success','objection deleted successfully');
    }
}
