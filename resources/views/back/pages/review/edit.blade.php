@extends('back.layout.master')

@section('title') Kateqoriya yarat @endsection

@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')

        <div class="content">
            <div class="mb-3 col-md-8 offset-md-2">
            <form action="{{ route('review.update',$review->id) }}" method="POST" enctype="multipart/form-data" class="mb-5">
            @csrf
            @method('PUT')
                <div class="form-group mb-3">
                    <label class="form-label" for="foto">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid  @enderror" id="foto" name="foto">
                    @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <img src="{{ asset('files/reviews/'.$review->src) }}" alt="" style="width: 100px">
                <div class="form-group mb-3">
                    <label class="form-label" for="text">Name(az***en***ru)</label>
                    <input type="text" class="form-control @error('name') is-invalid  @enderror" name="name" id="name" value="{{ old('name',$review->name_az.'***'.$review->name_en.'***'.$review->name_ru) }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="text">Rəy(az***en***ru)</label>
                    <textarea class="form-control @error('review') is-invalid  @enderror" name="review" id="review" cols="30" rows="4">{{ old('review',$review->review_az.'***'.$review->review_en.'***'.$review->review_ru) }}</textarea>
                    @error('review')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            <div class="form-group mb-3">
                <button class="btn btn-primary float-end">Redaktə et</button>
            </div>
            </form>
            </div>
        </div>
        @include('back.includes.footer')
    </div>
@endsection

@section('js')

@endsection
