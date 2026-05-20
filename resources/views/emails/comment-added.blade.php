<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>Naujas komentaras prie jūsų bilieto</h2>
    <p>Sveiki, <strong>{{ $ticket->user->name }}</strong>,</p>
    <p>Prie bilieto <strong>#{{ $ticket->id }} – {{ $ticket->title }}</strong> pridėtas naujas komentaras:</p>
    <blockquote style="border-left:4px solid #ccc; padding-left:12px; color:#555;">
        {{ $comment->body }}
    </blockquote>
    <p>Komentarą paliko: <strong>{{ $comment->user->name }}</strong></p>
    <a href="{{ url('/tickets/' . $ticket->id) }}" style="background:#3498db;color:white;padding:10px 20px;text-decoration:none;border-radius:4px;">
        Peržiūrėti bilietą
    </a>
</body>
</html>