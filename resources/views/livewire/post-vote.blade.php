<div class="w-1/12 flex flex-col text-center pt-2">
    
    <a class="text-sm" wire:click.prevent="vote(1)"  href="#">
        <svg class="w-5 fill-current text-grey hover:text-blue" height="3em" width="3em" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20">
            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z" />
        </svg>
    </a>

    <span class="text-sm font-semibold my-1 cursor-default"> {{ $totalVotes }}</span>

    <a class="text-sm" wire:click.prevent="vote(-1)" href="#">
        <svg class="w-5 fill-current text-grey hover:text-red" height="3em" width="3em" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20">
            <path d="M7 10V2h6v8h5l-8 8-8-8h5z" />
        </svg>
    </a>
</div>