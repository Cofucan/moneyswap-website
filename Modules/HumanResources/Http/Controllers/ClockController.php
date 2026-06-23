<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\Clock;
use Illuminate\Http\Request;

class ClockController extends Controller
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
    public function manage()
    {
        $clocks = Clock::pending()->get();
    }

    public function timesheet()
    {
        $clocks = Clock::attendance()->get();
        return view('humanresources::clocks.employee', compact('clocks'));
    }

    public function report()
    {
        $clocks = Clock::active()->get()
                            ->groupBy(function($item) {
                                return $item->work_day;
                            });
        return view('humanresources::clocks.report', compact('clocks'));
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
     * @param  \App\Clock  $clock
     * @return \Illuminate\Http\Response
     */
    public function show(Clock $clock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clock  $clock
     * @return \Illuminate\Http\Response
     */
    public function edit(Clock $clock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clock  $clock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clock $clock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clock  $clock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clock $clock)
    {
        //
    }
}
