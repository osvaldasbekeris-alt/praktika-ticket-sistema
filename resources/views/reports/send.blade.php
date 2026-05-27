@extends('layouts.app')
@section('title', 'Siųsti ataskaitą')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0"><i class="bi bi-file-pdf"></i> PDF ataskaita</h4>
            </div>
            <div class="card-body">
                <p>
                    <a href="{{ route('reports.pdf') }}" class="btn btn-danger btn-lg w-100 mb-3" target="_blank">
                        <i class="bi bi-download"></i> Peržiūrėti / Parsisiųsti PDF
                    </a>
                </p>
                <hr>
                <h5>Siųsti el. paštu</h5>
                <form action="{{ route('reports.send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">El. pašto adresas</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $adminEmail) }}""
                               placeholder="pvz@imone.lt">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button class="btn btn-primary">
                        <i class="bi bi-envelope"></i> Siųsti
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection