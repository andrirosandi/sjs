<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @persist('player') 
        @vite('resources/js/app.js')
        @endpersist
        {{-- <script src="https://unpkg.com/html5-qrcode"></script> --}}
        <script src="https://kit.fontawesome.com/f985998339.js" crossorigin="anonymous"></script>
        <title>{{ @$data['title'] != null ? 'Sukses Group - ' . @$data['title'] : 'Sukses Group' }}</title>
        @livewireStyles

    </head>
<body  class="container">
<nav class="fixed top-0 z-50 w-full bg-slate-50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="https://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="/" class="flex ms-2 md:me-24">
          {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" /> --}}
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Sukses Group</span>
        </a>
      </div>
      @livewire('admin.widgets.profileSettings')
    </div>
  </div>
</nav>

@livewire('admin.widgets.main-menu')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    @livewire('admin.widgets.content-title')
    <hr class="mt-2">
    
    @livewire('admin.widgets.action-button')
    
      {{ $slot }}
   </div>
</div>
@livewireScripts


<script>
    window.addEventListener('refreshPage', () => {
        location.reload();
    });
</script>

</body>
</html>
 