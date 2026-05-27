<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $adminEmail = Setting::get('admin_email', '');
        return view('reports.send', compact('adminEmail'));
    }

    // Rodyti / parsisiųsti PDF
    public function pdf()
    {
        $tickets = Ticket::with(['user', 'category'])
            ->where('status', '!=', 'closed')
            ->latest()
            ->get();

        $appName = Setting::get('app_name', 'Ticket Sistema');

        $pdf = Pdf::loadView('reports.pdf', compact('tickets', 'appName'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('aktyvios-problemos.pdf');
    }

    // Siųsti PDF el. paštu
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $tickets = Ticket::with(['user', 'category'])
            ->where('status', '!=', 'closed')
            ->latest()
            ->get();

        $appName = Setting::get('app_name', 'Ticket Sistema');

        $pdf = Pdf::loadView('reports.pdf', compact('tickets', 'appName'))
            ->setPaper('A4', 'landscape');

        \Mail::send([], [], function ($message) use ($pdf, $request) {
            $message->to($request->email)
                ->subject('Aktyvių problemų ataskaita')
                ->attachData($pdf->output(), 'ataskaita.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });

        return back()->with('success', 'Ataskaita išsiųsta į ' . $request->email);
    }
}