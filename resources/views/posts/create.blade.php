@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | Create Post ' }}
@endsection

@section('content')
    <div class="flex border border-grey-light-alt hover:border-grey rounded bg-white cursor-pointer mb-3 mt-2">
        <div class="w-full">
            <div class="inline-flex items-center">
                <nav aria-label="breadcrumb ">
                    <ol class="default-breadcrumb mt-2 -ml-5">
                        <li class="crumb">
                            <div class="bredcrumb-link">
                                <a href="{{ route('home') }}">
                                    <a href="{{ route('home') }}" class="fa fa-home"></a>
                                </a>
                            </div>
                        </li>
                        <li class="crumb">
                            <div class="bredcrumb-link">
                                <a href="{{ route('communities.show', $community->slug) }}">{{ $community->name }} Commuinty
                                </a>
                            </div>
                        </li>
                        <li class="crumb active">
                            <div class="bredcrumb-link">
                                <span aria-current="location">
                                    Create Post
                                </span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="head-text my-3">
                <h2>Create Post</h2>
            </div>
            <form method="POST" action="{{ route('communities.posts.store', $community) }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="title" type="text"
                            class="bg-white form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ old('title') }}" placeholder="Your post title ( Required)" required>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <textarea id="post_text" rows="10" class="bg-white form-control @error('post_text') is-invalid @enderror"
                            name="post_text" autocomplete="post_text">{{ old('post_text') }}</textarea>
                        @error('post_text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="post_url" type="text"
                            class="bg-white form-control @error('post_url') is-invalid @enderror" name="post_url"
                            value="{{ old('post_url') }}"
                            placeholder="Post url example : http://www.example.com (optional)">
                        @error('post_url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        Post Image (optional)
                        <input id="post_image" class="bg-white form-control mt-1" type="file" name="post_image"
                            accept="image/*">
                        @error('post_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary bg-blue font-semibold rounded px-4 py-2 w-full">
                            <i class="fas fa-plus fa-spin"></i> {{ __(' Create Post') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('ckeditor-scripts')
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script defer>
        CKEDITOR.replace('post_text');
    </script>
@endpush
