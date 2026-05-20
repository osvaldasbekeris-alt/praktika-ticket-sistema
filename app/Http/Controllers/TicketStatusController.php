<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,resolved,closed',
        ]);

        $oldStatus = $ticket->status;
        $ticket->update(['status' => $request->status]);

        // El. pašto pranešimas apie statuso pasikeitimą
        if ($oldStatus !== $request->status) {
            \Mail::to($ticket->user->email)
                ->send(new \App\Mail\StatusChangedMail($ticket, $oldStatus));
        }

        return back()->with('success', 'Statusas pakeistas!');
    }
}