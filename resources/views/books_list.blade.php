@extends('layouts.main')

@section('content')
    @foreach($books as $book)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="card-text"><span class="fw-bold">@lang('lang.authors'):</span> {{ $book->authors->pluck('name')->implode(', ') }}</p>
            </div>
            <div class="card-footer">
                <span class="fst-italic">@lang('lang.publishers'):</span>
                @foreach ($book->publishers as $publisher)
                    <span class="badge rounded-pill bg-primary fs-6">{{ $publisher->title }}</span>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection