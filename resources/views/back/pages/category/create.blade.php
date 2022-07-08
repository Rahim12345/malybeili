@extends('back.layout.master')

@section('title') Kateqoriya yarat @endsection

@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')

        <div class="content">
            <div class="mb-3 col-md-8 offset-md-2">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="foto">Foto</label>
                <input type="file" class="form-control @error('foto') is-invalid  @enderror" id="foto" name="foto">
                @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="text">Text(az***en***ru)</label>
                <textarea name="text"  class="form-control @error('text') is-invalid  @enderror" id="text" cols="30" rows="4">{{ old('text') }}</textarea>
                @error('text')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <button class="btn btn-primary float-end">Əlavə et</button>
            </div>
            </form>
            </div>
        </div>
        @include('back.includes.footer')
    </div>
@endsection

@section('js')

@endsection
