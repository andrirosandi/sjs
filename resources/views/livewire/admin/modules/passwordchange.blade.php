<div class="space-y-4">
    {{-- <h2 class="text-lg font-medium text-gray-700 mb-4">Update Password</h2> --}}
    @if ($message)
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ $message }}</p>
        </div>
    @php
        unset($message)
    @endphp
    @endif

    <form wire:submit.prevent="updatePassword" class="space-y-4">
        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-xs font-medium text-gray-700">Current Password</label>
            <input wire:model.defer="current_password" type="password" id="current_password" name="current_password" class="mt-1 block w-full md:w-1/2 rounded-md border-gray-300 shadow-sm text-xs" required>
            @include('livewire.includes.error-field', ['field' => 'current_password'])
        </div>

        <!-- New Password -->
        <div>
            <label for="new_password" class="block text-xs font-medium text-gray-700">New Password</label>
            <input wire:model.defer="new_password" type="password" id="new_password" name="new_password" class="mt-1 block w-full md:w-1/2 rounded-md border-gray-300 shadow-sm text-xs" required>
            @include('livewire.includes.error-field', ['field' => 'new_password'])
        </div>

        <!-- Confirm New Password -->
        <div>
            <label for="new_password_confirmation" class="block text-xs font-medium text-gray-700">Confirm New Password</label>
            <input wire:model.defer="new_password_confirmation" type="password" id="new_password_confirmation" name="new_password_confirmation" class="mt-1 block w-full md:w-1/2 rounded-md border-gray-300 shadow-sm text-xs" required>
            @include('livewire.includes.error-field', ['field' => 'new_password_confirmation'])
        </div>

        <!-- Submit Button -->
        <div class="flex justify-start space-x-2 mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-xs rounded-md hover:bg-blue-600"
            wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        Change Password
                    </span>
                    
                    <span wire:loading>
                        Loading ... 
                    </span>
                
            </button>
        </div>
    </form>
</div>