<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-slate-50 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-slate-50 dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
         {{-- @dump($menu); --}}

         @if (!empty($menu))
            
         @foreach ($menu as $m)
         @if ($m['type']==0)
         @include('livewire.admin.widgets.main-menu-component.submenu',[
               'icon' => '',
               'caption' => $m['name'],
               'badge' => null,
               'active' => @$m['active'],
               'child' => $m['child']
               ])
            @else
               @include('livewire.admin.widgets.main-menu-component.actionmenu',[
                  'icon' => '',
                  'caption'=> $m['name'],
                  'link'=> $m['link'],
                  'badge' => null,
                  'active' => @$m['active'],
               ])
            @endif
         @endforeach
         @endif
        
          
       </ul>
    </div>
    
 </aside>