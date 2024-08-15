<div class="flex items-center">
    <div class="flex items-center ms-3">
      <div>
        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
          <span class="sr-only">Open user menu</span>
          <img class="w-8 h-8 rounded-full" srdc="https://source.unsplash.com/100x100?cute%20cat" alt="">
        </button>
      </div>
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
        <div class="px-4 py-3" role="none">
          <p class="text-sm text-gray-900 dark:text-white" role="none">
            {{@$user['userid']}} - {{@$user['firstname']}} {{@$user['lastname']}}
          </p>
          <p class="text-sm text-gray-900 truncate dark:text-gray-300" role="none">
            group: {{@$usergroup['description']}}
          </p>

        </div>
        <ul class="py-1" role="none">
          <li>
            <a href="/changepassword" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Change Password</a>
          </li>
        <ul class="py-1" role="none">
          <li>
            <a href="#" wire:click='logoutRun' class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
          </li>
        </ul>
      </div>
    </div>
    <script>
      document.addEventListener('livewire:initialized',()=>{
      Livewire.on('deletecookies',({ cookiesToDelete })=>{
          window.location.href = '/auth/login';
      });
  });
  </script>
  </div>