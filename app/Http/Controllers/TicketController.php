<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Sąrašas
    public function index()
    {
        $perPage = (int) Setting::get('items_per_page', 10);

        $tickets = Ticket::with(['user', 'category'])
            ->latest()
            ->paginate($perPage);

        return view('tickets.index', compact('tickets'));
    }

    // Kūrimo forma
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    // Išsaugojimas
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'priority'    => 'required|in:low,medium,high',
        ]);

        $data['user_id'] = auth()->id();
        $data['status']  = 'new';

        Ticket::create($data);

        return redirect()->route('tickets.index')
            ->with('success', 'Bilietas sėkmingai sukurtas!');
    }

    // Peržiūra
    public function show(Ticket $ticket)
    {
        $ticket->load(['user', 'category', 'comments.user']);
        return view('tickets.show', compact('ticket'));
    }

    // Redagavimo forma
    public function edit(Ticket $ticket)
    {
        // Tik savininkas arba admin gali redaguoti
        if (auth()->id() !== $ticket->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $categories = Category::all();
        return view('tickets.edit', compact('ticket', 'categories'));
    }

    // Atnaujinimas
    public function update(Request $request, Ticket $ticket)
    {
        if (auth()->id() !== $ticket->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $data = $request->validate([
            'title'       => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'priority'    => 'required|in:low,medium,high',
        ]);

        $ticket->update($data);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Bilietas atnaujintas!');
    }

    // Trynimas
    public function destroy(Ticket $ticket)
    {
        if (auth()->id() !== $ticket->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Bilietas ištrintas.');
    }
}