@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | Manage Communities' }}
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
                                    Manage My Communities
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
            <div class="text-center my-4">
                <h3>Manage Communities</h3>
            </div>
            @if ($communities->count() > 0)
                <table class="table text-center text-sm text-gray-500 dark:text-gray-400 rounded">
                    <thead class="table-custom-bg text-xs text-white uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                ID
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Logo
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>

                    </thead>
                    <tbody class="items-center">
                        @foreach ($communities as $community)
                            <tr
                                class="bg-white border-b dark:bg-gray-800  dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="py-4 px-6">
                                    @if (file_exists(public_path('storage/communities/' . $community->id . '/thumbnail_' . $community->logo)))
                                        <img class="rounded-full border h-6 w-6 mr-1"
                                            src="{{ asset('storage/communities/' . $community->id . '/thumbnail_' . $community->logo) }}">
                                    @else
                                        <img class="rounded-full border h-6 w-6 mr-1"
                                            src="{{ asset('storage/communities/default.png') }}">
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    {{ $community->name }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="d-block">
                                        <a href="{{ route('communities.show', $community) }}"
                                            class="btn btn-warning btn-xs mx-1">
                                            <i class="fad fa-eye"></i></a>
                                        <a href="{{ route('communities.edit', $community) }}"
                                            class="btn btn-primary btn-xs mx-1">
                                            <i class="fad fa-cogs"></i>
                                        </a>
                                        <form action="{{ route('communities.destroy', $community) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger bg-red-dark rounded mx-1  btn-xs"><i
                                                    class="fad fa-trash"></i></button>
                                        </form>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4 class="text-center text-secondary ">
                    <i class="fad fa-users-crown fa-2x my-3"></i>
                    <p>You dont have commuinties </p>
                </h4>
            @endif
        </div>
    </div>
@endsection
