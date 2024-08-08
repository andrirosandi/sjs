<div class="my-2 -ml-1">
    {{-- @dump($data) --}}
    @if ( is_array (@$data['actionButton']))    
        @foreach (@$data['actionButton'] as $caption => $button)
        
        @switch(@$button['color'])

            @case('red')
            <span class="p-1 rounded-md m-1 border bg-red-300 text-red-800 border-red-300 text-sm">
                @break

            @case('green')
            <span class="p-1 rounded-md m-1 border bg-green-300 text-green-800 border-green-300 text-sm">
                @break

            @case('yellow')
            <span class="p-1 rounded-md m-1 border bg-yellow-300 text-yellow-800 border-yellow-300 text-sm">
                @break

            @case('blue')
            <span class="p-1 rounded-md m-1 border bg-blue-300 text-blue-800 border-blue-300 text-sm">
                @break

            @case('sky')
            <span class="p-1 rounded-md m-1 border bg-sky-300 text-sky-800 border-sky-300 text-sm">
                @break
        
            @default
            <span class="p-1 rounded-md m-1 border bg-slate-300 text-slate-800 border-slate-300 text-sm">
        @endswitch
            <a wire:navigate href="{{$button['link']}}" class="">
                @if (@$button['icon'] != null)
                <span class="mr-0.5"><i class="{{@$button['icon']}}"></i></span>
                @endif
                <span class="">
                    {{$caption}}
                </span>
            </a>
        </span>
        @endforeach
    @endif
</div>
