@extends('layouts.app')
@section('title', 'Sistemos nustatymai')

@section('content')
<h2 class="mb-4"><i class="bi bi-sliders"></i> Sistemos nustatymai</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('settings.update', 1) }}" method="POST">
            @csrf @method('PUT')

            @foreach($settings as $key => $setting)
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label fw-semibold">{{ $key }}</label>
                <div class="col-sm-6">
                    <input type="text" name="settings[{{ $key }}]"
                           class="form-control"
                           value="{{ old('settings.' . $key, $setting->value) }}">
                </div>
                @if($setting->description)
                <div class="col-sm-3">
                    <small class="text-muted">{{ $setting->description }}</small>
                </div>
                @endif
            </div>
            @endforeach

            <button class="btn btn-primary mt-2">
                <i class="bi bi-save"></i> Išsaugoti nustatymus
            </button>
        </form>
    </div>
</div>
@endsection