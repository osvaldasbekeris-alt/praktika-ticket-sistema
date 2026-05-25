@extends('layouts.app')
@section('title', 'Nauja kategorija')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header"><h4 class="mb-0">Nauja kategorija</h4></div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pavadinimas *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spalva</label>
                        <input type="color" name="color" class="form-control form-control-color"
                               value="{{ old('color', '#3498db') }}">
                    </div>
                    <button class="btn btn-primary">Sukurti</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Atšaukti</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection