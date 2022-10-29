@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | A space For You' }}
@endsection

@section('info')
    @include('layouts.partials.home')
@endsection

@section('content')
    @include('layouts.partials.stories')

    @include('layouts.partials.filters')

    @forelse ($posts  as $index => $post)
        @include('components.post-card', $post)
    @empty
        <h4 class="text-center text-secondary my-5">
            <i class="fad fa-sticky-note fa-2x my-2"></i>
            <p class="text-lg">No posts added yet</p>
        </h4>
    @endforelse
@endsection
