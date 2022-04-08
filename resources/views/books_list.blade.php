@extends('layouts.main')

@section('content')
    @foreach($books as $book)
        @foreach ($book->publishers as $publisher)
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title fw-bold">{{ $book->title }}</h3>
                    <p class="card-text"><span class="fw-bold">@lang('lang.authors'):</span> {{ $book->authors->pluck('name')->implode(', ') }}</p>
                    <span class="badge rounded-pill bg-primary fs-6">{{ $publisher->title }}</span>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection