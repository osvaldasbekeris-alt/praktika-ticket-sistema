@extends('layouts.app')
@section('title', 'Naujas bilietas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Naujas bilietas</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pavadinimas *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="Trumpai apibūdinkite problemą">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Aprašymas *</label>
                        <textarea name="description" rows="5"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Detaliai aprašykite problemą...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kategorija *</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Pasirinkite --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Prioritetas *</label>
                            <select name="priority" class="form-select @error('priority') is-invalid @enderror">
                                <option value="low"    {{ old('priority') === 'low'    ? 'selected' : '' }}>Žemas</option>
                                <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }} selected>Vidutinis</option>
                                <option value="high"   {{ old('priority') === 'high'   ? 'selected' : '' }}>Aukštas</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i> Pateikti
                        </button>
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">Atšaukti</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection