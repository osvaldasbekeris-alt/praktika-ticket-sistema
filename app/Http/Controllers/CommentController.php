<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'body' => 'required|min:2',
        ]);

        $comment = $ticket->comments()->create([
            'user_id' => auth()->id(),
            'body'    => $request->body,
        ]);

        // El. pašto pranešimas bilietą sukūrusiam vartotojui
        if ($ticket->user_id !== auth()->id()) {
            \Mail::to($ticket->user->email)
                ->send(new \App\Mail\CommentAddedMail($ticket, $comment));
        }

        return back()->with('success', 'Komentaras pridėtas!');
    }
}