@extends('back.layout.master')

@section('title') {{ __('menus.home') }} @endsection

@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')

        <div class="content">
            <div class="mb-3 col-md-8 offset-md-2">
                <a href="{{ route('home-banner.create') }}" class="btn btn-primary w-100">Əlavə et</a>
                <table class="table">
                    @foreach($banners as $banner)
                        <tr>
                            <td><img src="{{ asset('files/home/'.$banner->src) }}" class="empty-img w-25" alt=""></td>
                            <td>{{ $banner->text }}</td>
                            <td><a href="{{ route('home-banner.edit',$banner->id) }}" class="btn btn-primary"><i class="fa fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('home-banner.destroy',$banner->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Silmek istədiyinizdən əminsiniz?')"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @include('back.includes.footer')
    </div>
@endsection

@section('js')

@endsection
