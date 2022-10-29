<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm text-center fixed-nav">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">
            <img src="{{ URL::to('/') }}/logo.webp" class="logo img-fluid">
            <b>{{ config('app.name') }}</b>
        </a>

        @auth
            <li class="nav-item dropdown mx-3" id="got-to">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-base text-grey-darker" href="#"
                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                    @if (Route::current()->getName() == 'home')
                        <i class="fas fa-home"></i><span class=" mx-2"> Home</span>
                    @else
                        <i class="fas fa-th-large"></i> <span class=" mx-2"> Quick access</span>
                    @endif

                    <i class="far fa-chevron-down"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-end text-base p-1" aria-labelledby="navbarDropdown">
                    <p class="dropdown-item text-grey-dark hover:bg-white hover:text-grey-dark px-2">
                        <i class="fal fa-user-circle"></i> {{ __('Your communities') }}
                    </p>
                    @isset(Auth::user()->communities)
                        @forelse (Auth::user()->communities as $community)
                            <a class="dropdown-item px-4 pl-5" href="{{ route('communities.show', $community->slug) }}">
                                @if (file_exists(public_path('storage/communities/' . $community->id . '/thumbnail_' . $community->logo)))
                                    <img class="rounded-full border h-5 w-5 mr-1"
                                        src="{{ asset('storage/communities/' . $community->id . '/thumbnail_' . $community->logo) }}">
                                @else
                                    <img class="rounded-full border  h-5 w-5 mr-1"
                                        src="{{ asset('storage/communities/default.png') }}">
                                @endif
                                {{ $community->name }}
                            </a>
                        @empty
                            <p class="dropdown-item px-4 pl-5 text-center">
                                No Communities
                            </p>
                        @endforelse
                    @endisset

                    <p class="dropdown-item text-grey-dark hover:bg-white hover:text-grey-dark px-2">
                        <i class="fal fa-cog"></i> {{ __('Manage own communities') }}
                    </p>

                    <a class="dropdown-item px-4 pl-5" href="{{ route('communities.create') }}">
                        <i class="fal fa-plus ml-1"></i> Create new community
                    </a>

                    @isset(Auth::user()->ownCommunities)
                        @forelse (Auth::user()->ownCommunities as $mycommunity)
                            <a class="dropdown-item px-4 pl-5" href="{{ route('communities.show', $mycommunity->slug) }}">
                                @if (file_exists(public_path('storage/communities/' . $mycommunity->id . '/thumbnail_' . $mycommunity->logo)))
                                    <img class="rounded-full border h-5 w-5 mr-1"
                                        src="{{ asset('storage/communities/' . $mycommunity->id . '/thumbnail_' . $mycommunity->logo) }}">
                                @else
                                    <img class="rounded-full border h-5 w-5 mr-1"
                                        src="{{ asset('storage/communities/default.png') }}">
                                @endif
                                {{ $mycommunity->name }}
                            </a>
                        @empty
                            <p class="dropdown-item px-4 pl-5 text-center">
                                No Communities
                            </p>
                        @endforelse
                    @endisset

                </div>
            </li>
        @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            @livewire('search-bar')

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item mb-2">
                            <a type="button" class="btn btn-outline-primary rounded-3 mx-2" href="{{ route('login') }}">
                                <i class="far fa-sign-in"></i> {{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a type="button" class="btn btn-primary rounded-3"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if (file_exists(public_path('storage/users/' . auth()->id() . '/thumbnail_' . Auth::user()->avatar)))
                        <img src="{{ asset('storage/users/' . auth()->id() . '/thumbnail_' . Auth::user()->avatar) }}"
                            class="logo img-fluid h-8 w-8 nav-avatar m-auto">
                    @else
                        <img class="rounded-full border h-8 w-8 mr-1 m-auto"
                            src="{{ asset('storage/users/default.png') }}">
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-base font-medium" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                            <i class="far fa-chevron-down mx-2"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end text-base p-1" aria-labelledby="navbarDropdown">
                            <p class="dropdown-item text-grey-dark hover:bg-white hover:text-grey-dark px-2">
                                <i class="fal fa-user-circle"></i> {{ __('My Stuff') }}
                            </p>

                            <a class="dropdown-item px-4 pl-5" href="{{ route('communities.joined') }}">
                                {{ __('Joined Commuinties') }}
                            </a>

                            <a class="dropdown-item px-4 pl-5" href="{{ route('communities') }}">
                                {{ __('Manage Commuinties') }}
                            </a>

                            <a class="dropdown-item px-4 pl-5" href="{{ route('posts') }}">
                                {{ __('Manage posts') }}
                            </a>

                            <a class="dropdown-item px-4 pl-5" href="{{ route('post.saved') }}">
                                {{ __('Saved posts') }}
                            </a>

                            <div class="dropdown-divider text-grey-lightest"></div>

                            <p class="dropdown-item text-grey-dark hover:bg-white hover:text-grey-dark px-2">
                                <i class="fal fa-user-cog"></i> {{ __('Setting') }}
                            </p>

                            <a class="dropdown-item px-4 pl-5" href="{{ route('profile.edit') }}">
                                {{ __(' Profile') }}
                            </a>

                            <div class="dropdown-divider text-grey-lightest"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="far fa-sign-out"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
