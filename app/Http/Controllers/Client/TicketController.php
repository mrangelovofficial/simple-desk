<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
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
    public function show($id)
    {
        $ticket = Ticket::with('status','priority','category','user')
        ->find($id);

        $comments = Comment::where('ticket_id',$id)
        ->with('user')
        ->get();

        return Inertia::render('Client/Ticket/Show',
            [
                'comments' => $comments,
                'ticket' => $ticket,
                'tinymce_app_key'   =>  env('TINYMCE_APP_KEY'),
            ]
        );
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

    /**
     * Return a search listing of tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function ticketList(Request $request)
    {

        $searchKeyword = strip_tags($request->search);

        if(!empty($searchKeyword)){
            $tickets = Ticket::with('status','priority','category','user')
            ->where('completed_at',null)
            ->where('user_id', auth()->user()->id)
            ->where('subject', 'like', '%' . $searchKeyword . '%')
            ->orderBy('priority_id')
            ->limit(5)
            ->get();
        }else{
            $tickets = new Ticket();
        }

        return $tickets;

    }
}
