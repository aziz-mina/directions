@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | Saved Posts' }}
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

                        <li class="crumb active">
                            <div class="bredcrumb-link">
                                <span aria-current="location">
                                    My Saved Posts
                                </span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {{-- {{ dd($savedPosts) }} --}}
    <div class="card">
        <div class="card-body">
            <div class="text-center my-4 mb-5">
                <h3>Saved Posts</h3>
            </div>
            @if ($savedPosts->count() > 0)
                <table class="table text-center ">
                    <tbody>
                        @foreach ($savedPosts as $savedPost)
                            <tr class="focus:outline-none border-top border-bottom border-gray-100">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span class="mx-2 font-bold">
                                        {{ $loop->iteration }}
                                        <i class="ml-2 fas fa-chevron-right text-blue-light"></i>
                                    </span>
                                </th>
                                <td class="py-4 px-6">
                                    {{ $savedPost->post->title }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $savedPost->post->created_at->diffForHumans() }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span>
                                        <a href="{{ route('communities.posts.show', [$savedPost->post->slug]) }}"
                                            class="btn btn-warning btn-xs mx-1 text-white">
                                            <i class="fad fa-eye"></i>
                                        </a>
                                        <form action="{{ route('post.unsave', [$savedPost->post->id]) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-xs mx-1 text-white rounded">
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
                    <p>You dont have posts </p>
                </h4>
            @endif
        </div>
    </div>
@endsection
