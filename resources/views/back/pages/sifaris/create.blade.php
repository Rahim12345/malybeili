@extends('back.layout.master')

@section('title') Blog @endsection

@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')
        <div class="container-xl mt-3" style="min-height: 70vh">
            <div class="row row-cards">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <a href="{{ route('product.index') }}" class="btn btn-primary w-100">Bütün</a>
                        <div class="content p-3">
                            <form action="{{ route('product.store') }}" id="contact-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label" for="category_id">Kateqoriya</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->name_az }}</option>
                                    @endforeach
                                    </select>
                                    @error('sub_title_az')
                                    <small class="text-danger" id="sub_title_az-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="name_az">Ad(AZ)</label>
                                    <input type="text" name="name_az" id="name_az" class="form-control w-100 @error('name_az') is-invalid  @enderror" value="{{ old('name_az') }}">
                                    @error('name_az')
                                    <small class="text-danger" id="name_az-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="name_en">Ad(EN)</label>
                                    <input type="text" name="name_en" id="name_en" class="form-control w-100 @error('name_en') is-invalid  @enderror" value="{{ old('name_en') }}">
                                    @error('name_en')
                                    <small class="text-danger" id="name_en-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="name_ru">Ad(RU)</label>
                                    <input type="text" name="name_ru" id="name_ru" class="form-control w-100 @error('name_ru') is-invalid  @enderror" value="{{ old('name_ru') }}">
                                    @error('name_ru')
                                    <small class="text-danger" id="sub_title_az-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="about_az">Təsvir(AZ)</label>
                                    <textarea name="about_az" id="about_az" class="form-control w-100 @error('about_az') is-invalid  @enderror" rows="5" placeholder="">{{ old('about_az') }}</textarea>
                                    @error('about_az')
                                    <small class="text-danger" id="about_az-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="about_en">Təsvir(EN)</label>
                                    <textarea name="about_en" id="about_en" class="form-control w-100 @error('about_en') is-invalid  @enderror" rows="5" placeholder="">{{ old('about_en') }}</textarea>
                                    @error('about_en')
                                    <small class="text-danger" id="about_en-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="about_ru">Təsvir(RU)</label>
                                    <textarea name="about_ru" id="about_ru" class="form-control w-100 @error('about_ru') is-invalid  @enderror" rows="5" placeholder="">{{ old('about_ru') }}</textarea>
                                    @error('about_ru')
                                    <small class="text-danger" id="about_ru-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="price">Qiymət</label>
                                    <input type="number" name="price" id="price" class="form-control w-100 @error('price') is-invalid  @enderror" value="{{ old('price',1) }}" min="1" max="99999" step=".01">
                                    @error('price')
                                    <small class="text-danger" id="price-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="discount">Endirim(% - lə)</label>
                                    <input type="number" name="discount" id="discount" class="form-control w-100 @error('discount') is-invalid  @enderror" value="{{ old('discount',0) }}" min="0" max="99" step=".01">
                                    @error('discount')
                                    <small class="text-danger" id="discount-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="stock">Say</label>
                                    <input type="number" name="stock" id="stock" class="form-control w-100 @error('stock') is-invalid  @enderror" value="{{ old('stock',1) }}" min="1" max="99999">
                                    @error('stock')
                                    <small class="text-danger" id="stock-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="colors">Rənglər(AZ***EN***RU)</label>
                                    <input type="text" name="colors" id="colors" class="form-control w-100 @error('colors') is-invalid  @enderror" value="{{ old('colors') }}">
                                    @error('colors')
                                    <small class="text-danger" id="colors-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="sizes">Ölçülər(AZ***EN***RU)</label>
                                    <input type="text" name="sizes" id="sizes" class="form-control w-100 @error('sizes') is-invalid  @enderror" value="{{ old('sizes') }}">
                                    @error('sizes')
                                    <small class="text-danger" id="sizes-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <button class="btn btn-primary float-end" type="submit">Əlavə et</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('back.includes.footer')
    </div>
@endsection

@section('js')

@endsection
