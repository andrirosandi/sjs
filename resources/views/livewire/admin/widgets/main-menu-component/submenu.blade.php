@php
    $dropdownid = str_replace(' ','-',@$caption).bin2hex(random_bytes(6));
@endphp
<li>
    <button type="button" class="flex items-center w-full p-2 text-base
    @if (@$active === true)
    bg-slate-100 dark:bg-slate-700
    @endif
     text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-{{ @$dropdownid }}" data-collapse-toggle="dropdown-{{ @$dropdownid }}">
            <span class="text-gray-600 flex items-center w-5 h-5">
            <i class="{{@$icon}}"></i>
           </span>
          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{@$caption}}</span>
          <span class="inline-flex items-center justify-center px-2 ms-3 mr-2 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">{{@$badge}}</span>    
          <svg class="w-3 h-3" aria-hidden="true" xmlns="https://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
    </button>
    <ul id="dropdown-{{ @$dropdownid }}" class="hidden py-2 space-y-2">
        @foreach ($child as $m)
        @if ($m['type']==0)
           @include('livewire.admin.widgets.main-menu-component.submenu',[
                'icon' => '',
                'caption' => $m['name'],
                'badge' => null,
                'active' => false,
                'child' => $m['child']  
           ])
        @else
        @include('livewire.admin.widgets.main-menu-component.actionsubmenu',[
            'icon' => '',
            'caption'=> $m['name'],
            'link'=> $m['link'],
            'badge' => null,
            'active' => false,
          ])
        @endif
        @endforeach
          
          
          
          
          
          
    </ul>
 </li>
 @php
     unset($dropdownid);
 @endphp