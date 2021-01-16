<?php

namespace App\Http\Controllers\Admin;

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
        $pendingTickets     =   Ticket::where('completed_at',null)->count();
        $closedTicketsToday =   Ticket::where('completed_at','<>',null)->whereDate('completed_at', Carbon::today())->count();
        $closedTicketsMonth =   Ticket::where('completed_at','<>',null)->whereMonth('completed_at', Carbon::today()->month)->whereYear('completed_at', Carbon::today()->year)->count();

        return Inertia::render('Admin/Dashboard',[
            'pendingTickets'    =>  $pendingTickets,
            'closedTicketsToday'    =>  $closedTicketsToday,
            'closedTicketsMonth'    =>  $closedTicketsMonth,
        ]);
    }
}
