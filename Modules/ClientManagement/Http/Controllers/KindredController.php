<?php

namespace Modules\ClientManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ClientManagement\Entities\Client;
use Modules\ProfileManagement\Entities\Relationship;
use Modules\ContentManagement\Entities\Instruction;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\State;
use Modules\ClientManagement\Entities\Kindred;
use Illuminate\Http\Request;
use Modules\ClientManagement\Traits\KindredTrait;
class KindredController extends Controller
{
    use KindredTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients= Client::active()->get();
        $relationships = Relationship::active()->pluck("label", "id");
        return view('clientmanagement::kindreds.create', compact('clients', 'relationships'));

    }

    public function manage()
    {
        //
        $kindreds = Kindred::available()->get();
        return view('clientmanagement::kindreds.manage', compact('kindreds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new(Client $client)
    {
        $instruction = Instruction::byTag('new-kindred');
        $relationships = Relationship::active()->pluck("label", "id");
        $countries = Country::all()->pluck("label", "code");
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
            ];
        $states = State::all()->pluck("state_name", "id");
        return view('clientmanagement::kindreds.new',
        compact('client','relationships', 'instruction', 'states', 'addressPrefix', 'countries'));
    }

    public function make(Request $request)
    {
        $this->validate($request, [
            'profile_id' => 'required',
            'client_id' => 'required',
            'relationship_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        $kindred = $this->saveRelative();
        if($kindred)
        {
            return redirect()->route('kindreds.show', $kindred)->with('success','Kindred added successfully.');
        }
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            'telephone' => 'required',
            'client_id' => 'required',
            'relationship_id' => 'required'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('avatar')) {
            $this->avatar = $request->file('avatar');
        }
        if($request->address == 'NewAddress')
        {
            if(isset($request->street_name) && isset($request->neighbourhood_name))
            {
                $address = $this->saveAddress();
                $request->merge([
                    'address_id' => $address->id
                ]);

            }else{
                return redirect()->back()->with('error', 'incomplete address. please check your data and try again');
            }
        }
        $kindred = $this->saveKindred();
        if (!$kindred){
            return redirect()->back()->with('error', 'Something went wrong. please check your data and try again');
        }
        return redirect()->back()->with('success','Kindred Record uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function show(Kindred $kindred)
    {
        return view('clientmanagement::kindreds.show',compact('kindred'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function edit(Kindred $kindred)
    {
        $relationships = Relationship::pluck("label", "id");
         return view('clientmanagement::kindreds.edit',compact('kindred', 'relationships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kindred $kindred)
    {
        $this->validate($request, [
            'relationship_id' => 'required',
            'status' => 'required'
        ]);

        if(!$kindred->update($request->all()))
        {
            return redirect()->back()->withInput()->with('error', 'Data update error, try again later');
        }
        return redirect()->back()->with('success','data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kindred $kindred)
    {
        $kindred->delete();
        return redirect()->back()
                        ->with('success','Kindred deleted successfully');
    }
}
