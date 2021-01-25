<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendingTickets     =   Ticket::where('completed_at',null)->where('user_id',auth()->user()->id)->count();
        $closedTicketsToday =   Ticket::where('completed_at','<>',null)->where('user_id',auth()->user()->id)->whereDate('completed_at', Carbon::today())->count();
        $closedTicketsMonth =   Ticket::where('completed_at','<>',null)->where('user_id',auth()->user()->id)->whereMonth('completed_at', Carbon::today()->month)->whereYear('completed_at', Carbon::today()->year)->count();

        return Inertia::render('Client/Dashboard',[
            'pendingTickets'    =>  $pendingTickets,
            'closedTicketsToday'    =>  $closedTicketsToday,
            'closedTicketsMonth'    =>  $closedTicketsMonth,
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
