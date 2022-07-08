@extends('back.layout.master')

@section('title') {{ __('menus.home') }} @endsection

@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')

        <div class="content">
            <div class="mb-3 col-md-8 offset-md-2">
            <a href="{{ route('home-banner.index') }}" class="btn btn-primary w-100">Bütün</a>
            <form action="{{ route('home-banner.update',$banner->id) }}" method="POST" enctype="multipart/form-data" class="mb-5">
            @csrf
                @method('PUT')
            <div class="form-group mb-3">
                <label class="form-label" for="banner">Banner</label>
                <input type="file" class="form-control @error('banner') is-invalid  @enderror" id="banner" name="banner">
                <span class="bg-primary p-2 d-block mt-3">{{ $banner->src }}</span>
                @error('banner')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="text">Text</label>
                <input type="text" class="form-control @error('text') is-invalid  @enderror" id="text" name="text" value="{{ old('text',$banner->text) }}">
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
