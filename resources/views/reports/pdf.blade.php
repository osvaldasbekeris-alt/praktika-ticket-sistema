<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #222; }
        h1 { text-align: center; color: #2c3e50; font-size: 18px; margin-bottom: 4px; }
        .subtitle { text-align: center; color: #666; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        thead { background-color: #2c3e50; color: white; }
        th, td { padding: 6px 10px; border: 1px solid #ddd; }
        tr:nth-child(even) { background: #f5f5f5; }
        .badge-new { color: #fff; background:#3498db; padding:2px 6px; border-radius:4px; }
        .badge-progress { color: #fff; background:#f39c12; padding:2px 6px; border-radius:4px; }
        .badge-resolved { color: #fff; background:#27ae60; padding:2px 6px; border-radius:4px; }
        .footer { margin-top: 20px; text-align: center; color: #aaa; font-size: 10px; }
    </style>
</head>
<body>
    <h1>{{ $appName }}</h1>
    <div class="subtitle">Aktyvių problemų ataskaita – {{ now()->format('Y-m-d H:i') }}</div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Pavadinimas</th>
                <th>Kategorija</th>
                <th>Statusas</th>
                <th>Prioritetas</th>
                <th>Sukūrė</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->category->name }}</td>
                <td>
                    <span class="badge-{{ $ticket->status }}">{{ $ticket->status_label }}</span>
                </td>
                <td>{{ $ticket->priority }}</td>
                <td>{{ $ticket->user->name }}</td>
                <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center">Aktyvių bilietų nėra</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Viso aktyvių problemų: {{ $tickets->count() }} | Sugeneruota: {{ now()->format('Y-m-d H:i:s') }}
    </div>
</body>
</html>