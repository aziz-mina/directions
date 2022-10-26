<div class="flex border border-grey-light-alt hover:border-grey rounded bg-white mb-2">
    <div class="w-11/12 px-1">
        <div class="inline-flex items-center my-2">
            <a href="{{ route('home') }}" class="flex hover:bg-grey-lighter rounded p-1 ml-2 no-underline">
                <span class="ml-2 text-sm font-semibold text-grey-darker">
                    <div @if (request('sort', '') == '') style="color:#03a7f3" @endif>
                        <i class="fad fa-rocket"></i>
                        Best this week
                    </div>
                </span>
            </a>
            <a href="?sort=popular" class="flex hover:bg-grey-lighter rounded p-1 ml-2 no-underline	">
                <span class="ml-2 text-sm font-semibold text-grey-darker ">
                    <div @if (request('sort', '') == 'popular') style="color:#03a7f3" @endif>
                        <i class="fad fa-fire"></i>
                        Popular Posts
                    </div>
                </span>
            </a>
            <a href="?sort=new" class="flex hover:bg-grey-lighter rounded p-1 ml-2 no-underline	">
                <span class="ml-2 text-sm font-semibold text-grey-darker">
                    <div @if (request('sort', '') == 'new') style="color:#03a7f3" @endif>
                        <i class="fas fa-certificate"></i>
                        New Posts
                    </div>
                </span>
            </a>
        </div>
    </div>
</div>
