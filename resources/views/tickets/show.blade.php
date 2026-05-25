@extends('layouts.app')
@section('title', 'Bilietas #' . $ticket->id)

@section('content')
<div class="row">
    {{-- Kairė: bilieto info --}}
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <span class="text-muted">#{{ $ticket->id }}</span>
                    {{ $ticket->title }}
                </h4>
                <span class="badge bg-{{ $ticket->status_color }} fs-6">
                    {{ $ticket->status_label }}
                </span>
            </div>
            <div class="card-body">
                <p class="lead">{{ $ticket->description }}</p>
                <hr>
                <div class="row text-sm">
                    <div class="col-sm-4">
                        <strong>Kategorija:</strong><br>
                        <span class="badge" style="background-color: {{ $ticket->category->color }}">
                            {{ $ticket->category->name }}
                        </span>
                    </div>
                    <div class="col-sm-4">
                        <strong>Prioritetas:</strong><br>
                        {{ $ticket->priority }}
                    </div>
                    <div class="col-sm-4">
                        <strong>Sukūrė:</strong><br>
                        {{ $ticket->user->name }}<br>
                        <small class="text-muted">{{ $ticket->created_at->format('Y-m-d H:i') }}</small>
                    </div>
                </div>
            </div>
            @if(auth()->id() === $ticket->user_id || auth()->user()->isAdmin())
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-pencil"></i> Redaguoti
                </a>
                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST"
                      onsubmit="return confirm('Tikrai trinti šį bilietą?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> Trinti
                    </button>
                </form>
            </div>
            @endif
        </div>

        {{-- Komentarai --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header"><h5 class="mb-0"><i class="bi bi-chat-dots"></i> Komentarai ({{ $ticket->comments->count() }})</h5></div>
            <div class="card-body">
                @forelse($ticket->comments as $comment)
                <div class="d-flex gap-3 mb-3">
                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center"
                         style="width:40px;height:40px;min-width:40px;font-weight:bold;">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $comment->user->name }}</strong>
                            <small class="text-muted">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
                        </div>
                        <p class="mb-0 mt-1">{{ $comment->body }}</p>
                    </div>
                </div>
                @if(!$loop->last)<hr>@endif
                @empty
                <p class="text-muted text-center">Komentarų dar nėra.</p>
                @endforelse
            </div>
            <div class="card-footer">
                <form action="{{ route('comments.store', $ticket) }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="body" class="form-control"
                               placeholder="Rašykite komentarą..." required>
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-send"></i> Siųsti
                        </button>
                    </div>
                    @error('body')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </form>
            </div>
        </div>
    </div>

    {{-- Dešinė: statuso keitimas (tik admin) --}}
    @if(auth()->user()->isAdmin())
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="bi bi-arrow-repeat"></i> Keisti statusą</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tickets.status', $ticket) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select mb-2">
                        @foreach(['new' => 'Naujas', 'in_progress' => 'Vykdomas', 'resolved' => 'Išspręstas', 'closed' => 'Uždarytas'] as $val => $label)
                            <option value="{{ $val }}" {{ $ticket->status === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-warning w-100">
                        <i class="bi bi-check2"></i> Atnaujinti statusą
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection