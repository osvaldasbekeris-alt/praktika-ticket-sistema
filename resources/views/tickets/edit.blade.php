@extends('layouts.app')
@section('title', 'Redaguoti bilietą')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-pencil"></i> Redaguoti bilietą #{{ $ticket->id }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tickets.update', $ticket) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pavadinimas *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $ticket->title) }}">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Aprašymas *</label>
                        <textarea name="description" rows="5"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $ticket->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kategorija *</label>
                            <select name="category_id" class="form-select">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id', $ticket->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Prioritetas *</label>
                            <select name="priority" class="form-select">
                                @foreach(['low' => 'Žemas', 'medium' => 'Vidutinis', 'high' => 'Aukštas'] as $val => $label)
                                    <option value="{{ $val }}"
                                        {{ old('priority', $ticket->priority) === $val ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Išsaugoti
                        </button>
                        <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-outline-secondary">Atšaukti</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection