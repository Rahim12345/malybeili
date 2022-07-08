@extends('back.layout.master')

@section('title') Rəylər @endsection

@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')

        <div class="content">
            <div class="mb-3 col-md-8 offset-md-2">
                <a href="{{ route('review.create') }}" class="btn btn-primary w-100">Əlavə et</a>
                <table class="table">
                    @foreach($reviews as $item)
                        <tr>
                            <td><img src="{{ asset('files/reviews/'.$item->src) }}" class="empty-img w-25" alt=""></td>
                            <td>{{ $item->name_az }}</td>
                            <td>{{ $item->review_az }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('review.edit',$item->id) }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <form action="{{ route('review.destroy',$item->id) }}" method="POST">
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
