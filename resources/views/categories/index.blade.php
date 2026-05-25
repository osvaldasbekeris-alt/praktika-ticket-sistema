@extends('layouts.app')
@section('title', 'Kategorijos')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2><i class="bi bi-tags"></i> Kategorijos</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nauja kategorija
    </a>
</div>

<div class="card shadow-sm">
    <table class="table mb-0">
        <thead class="table-dark">
            <tr><th>Spalva</th><th>Pavadinimas</th><th>Bilietų</th><th>Veiksmai</th></tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
            <tr>
                <td>
                    <span class="d-inline-block rounded" style="width:24px;height:24px;background:{{ $cat->color }}"></span>
                </td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->tickets_count }}</td>
                <td>
                    <a href="{{ route('categories.edit', $cat) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('categories.destroy', $cat) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Tikrai trinti?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center text-muted py-3">Kategorijų nėra</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection