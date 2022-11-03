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
            <div class="head-text my-3">
                <h2>Manage Communities</h2>
            </div>
            @if ($communities->count() > 0)
                <table class="table text-center">
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
