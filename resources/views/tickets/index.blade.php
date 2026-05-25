@extends('layouts.app')
@section('title', 'Bilietai')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-list-ul"></i> Visi bilietai</h2>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Naujas bilietas
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Pavadinimas</th>
                    <th>Kategorija</th>
                    <th>Statusas</th>
                    <th>Prioritetas</th>
                    <th>Sukūrė</th>
                    <th>Data</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                <tr>
                    <td class="text-muted">{{ $ticket->id }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket) }}" class="text-decoration-none fw-semibold">
                            {{ $ticket->title }}
                        </a>
                    </td>
                    <td>
                        <span class="badge" style="background-color: {{ $ticket->category->color }}">
                            {{ $ticket->category->name }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $ticket->status_color }}">
                            {{ $ticket->status_label }}
                        </span>
                    </td>
                    <td>
                        @if($ticket->priority === 'high')
                            <span class="text-danger fw-bold"><i class="bi bi-arrow-up"></i> Aukštas</span>
                        @elseif($ticket->priority === 'medium')
                            <span class="text-warning"><i class="bi bi-dash"></i> Vidutinis</span>
                        @else
                            <span class="text-success"><i class="bi bi-arrow-down"></i> Žemas</span>
                        @endif
                    </td>
                    <td>{{ $ticket->user->name }}</td>
                    <td class="text-muted small">{{ $ticket->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                        @if(auth()->id() === $ticket->user_id || auth()->user()->isAdmin())
                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Tikrai trinti?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">Bilietų nėra</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $tickets->links() }}
</div>
@endsection