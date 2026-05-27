<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>Bilieto statusas pasikeitė</h2>
    <p>Sveiki, <strong>{{ $ticket->user->name }}</strong>,</p>
    <p>Jūsų bilieto <strong>#{{ $ticket->id }} – {{ $ticket->title }}</strong> statusas pasikeitė:</p>
    @php
        $statusLabels = [
            'new'         => 'Naujas',
            'in_progress' => 'Vykdomas',
            'resolved'    => 'Išspręstas',
            'closed'      => 'Uždarytas',
        ];
    @endphp
    <p>
        <strong>Buvo:</strong> {{ $statusLabels[$oldStatus] ?? $oldStatus }}<br>
        <strong>Tapo:</strong> {{ $ticket->status_label }}
    </p>
    <a href="{{ url('/tickets/' . $ticket->id) }}" style="background:#3498db;color:white;padding:10px 20px;text-decoration:none;border-radius:4px;">
        Peržiūrėti bilietą
    </a>
</body>
</html>