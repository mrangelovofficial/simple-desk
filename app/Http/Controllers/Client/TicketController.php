<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets = Ticket::with('status','priority','category','user')
        ->where('completed_at',null)
        ->where('user_id', auth()->user()->id)
        ->orderBy('priority_id')
        ->paginate();

        if($request->wantsJson()){
            return $tickets;
        }

        return Inertia::render('Client/Ticket/Index',
            [
                'tickets' => $tickets
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tickets = auth()->user()->tickets()->get();
        
        return Inertia::render('Client/Ticket/Create',
            [
                'tickets' => $tickets
            ]
        );
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
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function closed(Request $request)
    {
        $tickets = Ticket::with('status','priority','category','user')
        ->where('completed_at','<>',null)
        ->where('user_id', auth()->user()->id)
        ->orderBy('priority_id')
        ->paginate();

        if($request->wantsJson()){
            return $tickets;
        }

        return Inertia::render('Client/Ticket/Index',
            [
                'tickets'           =>  $tickets,
            ]
        );
    }
}
