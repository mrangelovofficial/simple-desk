<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Display a listing pending tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tickets = Ticket::with('status','priority','category','user')
        ->where('completed_at',null)
        ->orderBy('priority_id')
        ->paginate();

        if($request->wantsJson()){
            return $tickets;
        }

        return Inertia::render('Admin/Ticket/Index',
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
     * Display the specified ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::with('status','priority','category','user')
        ->find($id);

        $comments = Comment::where('ticket_id',$id)
        ->with('user')
        ->get();

        return Inertia::render('Admin/Ticket/Show',
            [
                'comments' => $comments,
                'ticket' => $ticket
            ]
        );
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

     /**
     * Display a listing closed tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function closed(Request $request)
    {

        $tickets = Ticket::with('status','priority','category','user')
        ->where('completed_at','<>',null)
        ->orderBy('priority_id')
        ->paginate();

        if($request->wantsJson()){
            return $tickets;
        }

        return Inertia::render('Admin/Ticket/Index',
            [
                'tickets' => $tickets
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
