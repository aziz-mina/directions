@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | Edit Post ' }}
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
                                    <a href="#" class="fa fa-home"></a>
                                </a>
                            </div>
                        </li>

                        <li class="crumb">
                            <div class="bredcrumb-link">
                                <a href="{{ route('communities.show', $community->slug) }}">{{ $community->name }}</a>
                            </div>
                        </li>
                        <li class="crumb active">
                            <div class="bredcrumb-link">
                                <span aria-current="location">
                                    Edit Your Post
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
                <h2>Edit Post</h2>
            </div>
            <form method="POST" action="{{ route('communities.posts.update', [$community, $post]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="title" type="text"
                            class="bg-white form-control @error('title') is-invalid @enderror" name="title"
                            placeholder="Your post title ( Required)" value="{{ $post->title }}" required>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-12">
                        <textarea id="post_text" rows="5" class="form-control @error('post_text') is-invalid @enderror" name="post_text"
                            autocomplete="post_text">{{ $post->post_text }}</textarea>

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
                            placeholder="Post url example : http://www.example.com/abcd" value="{{ $post->post_url }}">

                        @error('post_url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="post_image" type="file" class="bg-white form-control" accept="image/*"
                            name="post_image">

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
                            <i class="fad fa-sync fa-spin"></i> {{ __('Save Post') }}
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
