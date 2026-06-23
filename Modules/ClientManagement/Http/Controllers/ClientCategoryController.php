<?php

namespace Modules\ClientManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\ClientManagement\Entities\ClientCategory;
use Modules\ClientManagement\Entities\Client;
use Session;
use Auth;

class ClientCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clientcategories = ClientCategory::active()->withCount([
            'Clients'])->get();
        return view('clientmanagement::clientcategories.index', compact('clientcategories',));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
    public function manage()
    {
        //
        $clientcategories = clientcategory::all();
        return view('clientmanagement::clientcategories.manage', compact('clientcategories',));
    }
    public function toggle(clientcategory $clientcategory)
    {
        if ($clientcategory->published == '0') {
            $clientcategory->published = '1';
            $feedback = 'client type Activated Successfully';
        } else {
            $clientcategory->published = '0';
            $feedback = 'client type Deactivated Successfully';
        }
        if ( ! $clientcategory->save()) {
            return redirect()->back()->with('error', 'Could not update clientcategory Status');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clientcategory  $clientcategory
     * @return \Illuminate\Http\Response
     */
    public function show(ClientCategory $clientcategory)
    {
        //
        $clients = Client::active()->whereStudentTypeId($clientcategory->id)->get()
        ->groupBy(function($item) {
            return $item->batch->label;
        });
        return view('clientmanagement::clientcategories.show', compact('clientcategory'));
    }

    public function clients(ClientCategory $clientcategory)
    {
        //
        $clients = Client::active()->whereStudentTypeId($clientcategory->id)->get()
        ->groupBy(function($item) {
            return $item->batch->label;
        });
        return view('clientmanagement::clientcategories.clients', compact('clientcategory', 'clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clientcategory  $clientcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(clientcategory $clientcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clientcategory  $clientcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clientcategory $clientcategory)
    {
        //
        $this->validate($request, [
            'label' => 'required'
        ]);
        if( !$clientcategory->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->route('clientmanagement::clientcategories.show', $clientcategory)->with('success','client attendance type Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clientcategory  $clientcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(clientcategory $clientcategory)
    {
        //
        $clientcategory->delete();
        return redirect()->back()
                        ->with('success','item deleted successfully');
    }
}
