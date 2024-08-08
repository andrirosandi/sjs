@if (!is_null($successPopup))
<div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="$set('successPopup', null)" aria-hidden="true"></div>
    <!-- Modal --> 
    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full sm:p-6">
      <div>
        <div class="text-center">
          <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
            Success
          </h3>
          <div class="mt-2">
            <p class="text-sm text-gray-500">
              {{$successPopup}}
            </p>
          </div>
        </div>
      </div>
      <div class="mt-5 sm:mt-6">
        <button type="button" wire:click="$set('successPopup', null)" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
          Close
        </button>
      </div>
    </div>
  </div>
</div>
@endif