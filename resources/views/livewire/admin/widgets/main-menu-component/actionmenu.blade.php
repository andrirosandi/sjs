<li>
    <a wire:navigate href="{{$link}}" class="
    @if (@$active === true)
    bg-slate-100 dark:bg-slate-700
    @endif
    flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
       
       <span class="text-gray-600 flex items-center w-5 h-5">
        <i class="{{@$icon}}"></i>
       </span>
       <span class="flex-1 ms-3 whitespace-nowrap">{{$caption}}</span>
       @if (@$badge != null)
           <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">{{@$badge}}</span>    
       @endif
    </a>
 </li>
