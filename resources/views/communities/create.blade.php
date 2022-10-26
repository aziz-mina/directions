@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | Create Community ' }}
@endsection

@section('content')
    <div class="flex border border-grey-light-alt hover:border-grey rounded bg-white cursor-pointer mb-3 mt-2">
        <div class="w-full">
            <div class="inline-flex items-center">
                <nav aria-label="breadcrumb ">
                    <ol class="default-breadcrumb mt-2 -ml-5">
                        <li class="crumb">
                            <div class="bredcrumb-link"><a href="{{ route('home') }}" class="fa fa-home"></a></div>
                        </li>
                        <li class="crumb active">
                            <div class="bredcrumb-link">
                                <span aria-current="location">
                                    Create Community
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
            <form method="POST" action="{{ route('communities.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="text-center mt-2 mb-5">
                    <h3>Create Community</h3>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="name" type="text"
                            class="bg-white form-control @error('name') is-invalid @enderror"
                            placeholder="Community name ( Required )" name="name" value="{{ old('name') }}" required
                            autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-12">
                        <textarea id="description" rows="5" class="bg-white form-control @error('description') is-invalid @enderror"
                            name="description" placeholder="Community decription and rules (Minimum 250 characters)" required
                            autocomplete="description">{{ old('description') }}</textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        Community Topics
                        <select name="topics[]" multiple class="form-control select2 mt-1" style="width:100%" required>
                            @foreach ($topics as $topic)
                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        Community Logo
                        <input id="logo" class="bg-white form-control  mt-1" type="file" name="logo"
                            accept=".png, .jpg, .jpeg" required>
                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-12">
                        <button type="submit"
                            class="btn btn-blue text-white bg-blue hover:bg-blue-dark font-semibold rounded px-4 py-2 w-full ">
                            <i class="fas fa-plus fa-spin"></i> {{ __('Create Community') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
