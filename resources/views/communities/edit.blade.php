@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | Edit Community ' }}
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
                                <a href="{{ route('communities.show', $community->slug) }}">{{ $community->name }} Community
                                </a>
                            </div>
                        </li>
                        <li class="crumb active">
                            <div class="bredcrumb-link">
                                <span aria-current="location">
                                    Edit Community
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
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link text-base active" href="#information" id="information-tab" data-bs-toggle="tab"
                        data-bs-target="#information" type="button" role="tab" aria-controls="information"
                        aria-selected="true"><i class="fad fa-sync"></i> Update Community </a>
                    <a class="nav-link text-base" href="#posts" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts"
                        type="button" role="tab" aria-controls="posts" aria-selected="false"><i
                            class="fas fa-sticky-note"></i> Post requests</a>
                    <a class="nav-link text-base" href="#users" id="users-tab" data-bs-toggle="tab" data-bs-target="#users"
                        type="button" role="tab" aria-controls="users" aria-selected="false"><i
                            class="fad fa-users"></i> Community users </a>
                    <a class="nav-link text-base" href="#delete" id="delete-tab" data-bs-toggle="tab"
                        data-bs-target="#delete" type="button" role="tab" aria-controls="delete"
                        aria-selected="false"><i class="fad fa-trash"></i> Delete Community</a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                    <form method="POST" action="{{ route('communities.update', $community) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="text-center my-5 text-grey">
                            <h4>Update Community</h3>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="name" type="text"
                                    class="form-control bg-white @error('name') is-invalid @enderror"
                                    placeholder="Community name ( Required )" name="name" value="{{ $community->name }}"
                                    required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <textarea id="description" rows="5" class="form-control bg-white @error('description') is-invalid @enderror"
                                    name="description" required placeholder="Type your community decription and rules" autocomplete="description">{{ $community->description }}</textarea>

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
                                <select name="topics[]" multiple class="form-control select2" style="width:100%" required>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}"
                                            @if ($community->topics->contains($topic->id)) selected @endif>
                                            {{ $topic->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                Community Logo
                                <input id="logo" class="bg-white form-control  mt-1" type="file" name="logo"
                                    accept="image/*" required>
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
                                    class="btn btn-primary bg-blue-dark font-semibold rounded px-4 py-2 w-full">
                                    <i class="fad fa-sync fa-spin mx-1"></i> {{ __('Update  Community') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                    <div class="text-center  my-5 text-grey">
                        <h4>{{ $community->name }}'s Posts Request</h3>
                    </div>
                    @if ($postRequests->count() > 0)
                        <table class="table text-center text-sm text-gray-500 dark:text-gray-400 rounded">
                            <tbody>
                                @foreach ($postRequests as $post)
                                    <tr class="focus:outline-none border-top border-bottom border-gray-100">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $post->user->name }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $post->title }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $post->created_at->diffForHumans() }}
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span>
                                                <form action="{{ route('posts.request.approve', [$community->id]) }}"
                                                    method="post" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success  rounded mx-1  btn-xs">
                                                        <i class="fad fa-check"></i>
                                                    </button>
                                                </form>

                                                <form
                                                    action="{{ route('communities.posts.destroy', [$post->community, $post]) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger bg-red-dark rounded mx-1  btn-xs">
                                                        <i class="fad fa-trash"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4 class="text-center text-secondary ">
                            <i class="fad fa-sticky-note fa-2x my-3"></i>
                            <p>You dont have posts requests </p>
                        </h4>
                    @endif

                </div>

                <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                    <div class="text-center my-5 text-grey">
                        <h4>Manage Community users</h3>
                    </div>
                    @if ($communityUsers->count() > 0)
                        <table class="table text-center">
                            <tbody class="items-center">
                                @foreach ($communityUsers as $communityUser)
                                    <tr class="focus:outline-none border-top border-bottom border-gray-100">
                                        <th scope="row"
                                            class="py-3 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <span class="mx-2 font-bold">
                                                {{ $loop->iteration }}

                                            </span>
                                        </th>
                                        <td class="py-3 px-6">
                                            @if (file_exists(public_path('storage/users/' . $communityUser->user->id . '/thumbnail_' . $communityUser->user->avatar)))
                                                <img class="border-image"
                                                    src="{{ asset('storage/users/' . $communityUser->user->id . '/thumbnail_' . $communityUser->user->avatar) }}">
                                            @else
                                                <img class="border-image" src="{{ asset('storage/users/default.png') }}">
                                            @endif
                                        </td>
                                        <td class="py-3 px-6">
                                            {{ $communityUser->user->name }}
                                        </td>
                                        <td class="py-3 px-6">
                                            Joined {{ $communityUser->created_at->diffForHumans() }}
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <a href="{{ route('users.show', $communityUser->user->id) }}"
                                                class="btn btn-warning bg-yellow-dark rounded mx-1 mb-3">
                                                <i class="fad fa-eye"></i> Show
                                            </a>

                                            <form method="POST" class="d-inline-block">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-danger bg-red-dark rounded mx-1 mb-3">
                                                    <i class="fad fa-trash"></i> Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4 class="text-center text-secondary ">
                            <i class="fad fa-users-crown fa-2x my-3"></i>
                            <p>No users joined your commuinty </p>
                        </h4>
                    @endif
                </div>
                <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
                    <div class="text-center mt-5 mb-3 text-grey">
                        <h4>Delete Community</h3>
                    </div>
                    <div class="text-center my-3">
                        <div class="text-xl my-2">
                            <i class="fad fa-engine-warning text-red-dark"></i>
                            <span class="text-red-dark my-4">warning</span>
                        </div>
                        <p>
                            Before Proceeding Please <b> note </b> that , After <b>deleting</b> community you might not
                            be able
                            to recover it later.
                        </p>
                    </div>
                    <form action="{{ route('communities.destroy', $community) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit"
                                    class="btn btn-danger bg-red-dark font-semibold rounded px-4 py-2 w-full">
                                    <i class="fad fa-trash"></i> Delete Community
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
