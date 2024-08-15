<li>
    <a wire:navigate href="{{@$link}}" class="
    @if (@$active == 1)
    bg-slate-100 dark:bg-slate-700
    @endif
    flex w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
       <span class="text-gray-600 -ml-8 mr-3 flex items-center w-5 h-5">
       <i class="{{@$icon}}"></i>
       </span>
       <span class="flex-1 text-left rtl:text-right whitespace-nowrap ">{{@$caption}}</span>
       <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 
       @if ($badge != null)
       bg-gray-100 rounded-full dark:bg-gray-700 
       @endif
       
       dark:text-gray-300">{{@$badge}}</span>    
   </a>

 </li>