<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\ClockType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
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

    /**
     * Display the specified resource.
     *
     * @param  \App\ClockType  $clocktype
     * @return \Illuminate\Http\Response
     */
    public function show(ClockType $clocktype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClockType  $clocktype
     * @return \Illuminate\Http\Response
     */
    public function edit(ClockType $clocktype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClockType  $clocktype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClockType $clocktype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClockType  $clocktype
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClockType $clocktype)
    {
        //
    }
}
