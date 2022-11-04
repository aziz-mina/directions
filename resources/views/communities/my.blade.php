@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | Joined Communities' }}
@endsection

@section('content')

    {{ Breadcrumbs::render('myCommunities') }}

    <div class="card">
        <div class="card-body">
            <div class="head-text my-3">
                <h2>Joined Communities</h2>
            </div>
            @if ($myCommunities->count() > 0)
                <table class="table text-center">
                    <tbody class="items-center">
                        @foreach ($myCommunities as $community)
                            <tr class="focus:outline-none border-top border-bottom border-gray-100">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span class="mx-2 font-bold">
                                        {{ $loop->iteration }}
                                        <i class="ml-2 fas fa-chevron-right text-blue-light"></i>
                                    </span>
                                </th>
                                <td class="py-4 px-6">
                                    @if (file_exists(public_path('storage/communities/' . $community->Community->id . '/thumbnail_' . $community->Community->logo)))
                                        <img class="border-image"
                                            src="{{ asset('storage/communities/' . $community->Community->id . '/thumbnail_' . $community->Community->logo) }}">
                                    @else
                                        <img class="border-image" src="{{ asset('storage/communities/default.png') }}">
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    {{ $community->Community->name }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('communities.show', $community->Community->slug) }}"
                                        class="btn btn-warning btn-xs mx-1">
                                        <i class="fad fa-eye"></i>
                                    </a>
                                    <form action="{{ route('leave', $community->Community->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-danger bg-red-dark rounded mx-1  btn-xs">
                                            <i class="far fa-sign-out"></i> Leave
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
                    <p>You dont joined commuinties </p>
                </h4>
            @endif
        </div>
    </div>
@endsection
