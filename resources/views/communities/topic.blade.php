@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | Communities' }}
@endsection

@section('content')
  
    {{ Breadcrumbs::render('topic', $topic) }}

    <div class="card">
        <div class="card-body">
            <div class="head-text my-3">
                <h2>{{ $topic->name }} Communities</h2>
            </div>
            @if ($communities->count() > 0)
                <table class="table">
                    <tbody class="items-center">
                        @foreach ($communities as $community)
                            <tr class="focus:outline-none border-top border-bottom border-gray-100">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span class="mx-2 font-bold">
                                        {{ $loop->iteration }}
                                        <i class="ml-2 fas fa-chevron-right text-blue-light"></i>
                                    </span>
                                </th>
                                <td class="py-4 px-6">
                                    @if (file_exists(public_path('storage/communities/' . $community->id . '/thumbnail_' . $community->logo)))
                                        <img class="border-image"
                                            src="{{ asset('storage/communities/' . $community->id . '/thumbnail_' . $community->logo) }}">
                                    @else
                                        <img class="border-image" src="{{ asset('storage/communities/default.png') }}">
                                    @endif
                                    <span class="ml-2">
                                        dir/ {{ $community->name }}
                                    </span>

                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('communities.show', [$community->slug]) }}"
                                        class="btn btn-blue text-white bg-blue-dark float-right rounded-pill px-3"
                                        style="background-color:#03a0e8;">
                                        <i class="fad fa-eye"></i> View community
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4 class="text-center text-secondary ">
                    <i class="fad fa-users-crown fa-2x my-3"></i>
                    <p>There are no {{ $topic->name }} commuinties </p>
                </h4>
            @endif
        </div>
    </div>
@endsection
