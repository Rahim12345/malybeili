@extends('back.layout.master')

@section('title') Kateqoriyalar @endsection

@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')

        <div class="content">
            <div class="mb-3 col-md-8 offset-md-2">
                <a href="{{ route('category.create') }}" class="btn btn-primary w-100">Əlavə et</a>
                <table class="table">
                    @foreach($categories as $item)
                        <tr>
                            <td><img src="{{ asset('files/categories/'.$item->src) }}" class="empty-img w-25" alt=""></td>
                            <td>{{ $item->name_az }}</td>
                            <td>
                                <form action="{{ route('category.status') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $item->on_home }}" name="on_home">
                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                    <button class="btn btn-{{ $item->on_home == 0 ? 'danger' : 'primary' }}">{{ $item->on_home == 0 ? 'Deaktiv' : 'Activ' }}</button>
                                </form>
                            </td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('category.edit',$item->id) }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <form action="{{ route('category.destroy',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Silmek istədiyinizdən əminsiniz?')"><i class="fa fa-times"></i></button>
                                </form>
                                </div>
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
