@unless($breadcrumbs->isEmpty())
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
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if (!is_null($breadcrumb->url) && !$loop->last)
                                <li class="crumb">
                                    <div class="bredcrumb-link">
                                        <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                                    </div>
                                </li>
                                <li class="breadcrumb-item"></li>
                            @else
                                <li class="crumb active">
                                    <div class="bredcrumb-link">
                                        <span aria-current="location">
                                            {{ $breadcrumb->title }}
                                        </span>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endunless
