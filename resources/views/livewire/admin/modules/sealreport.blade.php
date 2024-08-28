<div>
    
    <div class="flex justify-start space-x-2 items-center" wire:replace>
        <!-- Tombol Unduh Seal-History.Rpt -->
        <a href="{{ env('APP_URL') }}/storage/reports/seal-history.rpt" 
            class="flex items-center px-4 py-2 bg-green-500 text-white text-xs rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
            Unduh Seal-History.Rpt
        </a>
    
        <!-- Tombol Export PDF -->
        <a href='javascript:void(0)' 
        {{-- onclick="window.open(window.location.href + (window.location.href.includes('?') ? '&export=pdf' : '?export=pdf'), '_blank')" --}}
        wire:click='generatePDF'
    class="flex items-center px-4 py-2 bg-red-500 text-white text-xs rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
    Export PDF
</a>

    </div>
    
    

    
       
    
    {{-- @dump($meta) --}}

    {{-- @dump($errorsInput) --}}
    <button id="filterbutton" wire:click='setShowFilterForm(1)' 
    onclick="document.getElementById('filterform').classList.remove('hidden');
    document.getElementById('filterbutton').classList.add('hidden');" 
    class="px-4 py-2 text-gray-700 text-sm rounded-md hover:bg-grey-600
    @if (@$showFilterForm == 1)
        hidden
    @endif
    ">
        Tampilkan Filter +
    </button>
    
    <form id="filterform" wire:submit='load()' class="space-y-4 p-4 @if (@$showFilterForm == 0) hidden @endif">
        <!-- Seal Type -->
        <div>
          <label for="seal_type" class="block text-xs font-medium text-gray-700">Seal Type</label>
          <select wire:model='sealid' id="seal_type" name="sealid" class="mt-1 block w-full md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs">
            <option></option>
            @if(isset($sealtypes[0]))
            @foreach (@$sealtypes as $type )
                <option value="{{$type->sealid}}">{{$type->sealname}}</option>
            @endforeach
            @endif
          </select>
          @include('livewire.includes.error-field', ['field' => 'sealid'])
        </div>
      
        <!-- Sealed By -->
        {{-- <div> --}}
          {{-- <label for="sealed_by" class="block text-xs font-medium text-gray-700">Sealed By</label> --}}
          {{-- <input wire:model='sealed_by' type="text" id="sealed_by" name="sealed_by" class="mt-1 block w-full md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs" /> --}}
          {{-- @include('livewire.includes.error-field', ['field' => 'sealed_by']) --}}
        {{-- </div> --}}

        <div>
            <label for="sealed_by" class="block text-xs font-medium text-gray-700">Seal By</label>
            <select wire:model='sealed_by' id="sealed_by" name="sealed_by" class="mt-1 block w-full md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs">
              <option></option>
              @if(!empty($sealusers))
              @foreach (@$sealusers as $sealuser )
                  <option value="{{$sealuser->userid}}">{{ Str::title( $sealuser->userid)}}</option>
              @endforeach
              @endif
            </select>
            @include('livewire.includes.error-field', ['field' => 'sealed_by'])
          </div>
      
        <!-- Sealed At -->
        <div>
          <label class="block text-xs font-medium text-gray-700">Sealed At</label>
          <div class="flex space-x-2">
            <input wire:model='sealed_at_from' type="date" name="sealed_at_from" class="mt-1 block w-1/2 md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs" />
            <input wire:model='sealed_at_to' type="date" name="sealed_at_to" class="mt-1 block w-1/2 md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs" />
          </div>
          @include('livewire.includes.error-field', ['field' => 'sealed_at_from'])
          @include('livewire.includes.error-field', ['field' => 'sealed_at_to'])
        </div>
      
        <!-- Unsealed By -->
        {{-- <div> --}}
          {{-- <label for="unsealed_by" class="block text-xs font-medium text-gray-700">Unsealed By</label> --}}
          {{-- <input wire:model='unsealed_by' type="text" id="unsealed_by" name="unsealed_by" class="mt-1 block w-full md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs" /> --}}
          {{-- @include('livewire.includes.error-field', ['field' => 'unsealed_by']) --}}
        {{-- </div> --}}
        <div>
            <label for="unsealed_by" class="block text-xs font-medium text-gray-700">Unseal By</label>
            <select wire:model='unsealed_by' id="unsealed_by" name="unsealed_by" class="mt-1 block w-full md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs">
              <option></option>
              @if(!empty($sealusers))
              @foreach (@$sealusers as $sealuser )
                  <option value="{{$sealuser->userid}}">{{ Str::title( $sealuser->userid)}}</option>
              @endforeach
              @endif
            </select>
            @include('livewire.includes.error-field', ['field' => 'unsealed_by'])
          </div>
      
        <!-- Unsealed At -->
        <div>
          <label class="block text-xs font-medium text-gray-700">Unsealed At</label>
          <div class="flex space-x-2">
            <input wire:model='unsealed_at_from' type="date" name="unsealed_at_from" class="mt-1 block w-1/2 md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs" />
            <input wire:model='unsealed_at_to' type="date" name="unsealed_at_to" class="mt-1 block w-1/2 md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs" />
          </div>
          @include('livewire.includes.error-field', ['field' => 'unsealed_at_from'])
          @include('livewire.includes.error-field', ['field' => 'unsealed_at_to'])
        </div>
      
        <!-- Status -->
        <div>
          <label for="status" class="block text-xs font-medium text-gray-700">Status</label>
          <select wire:model='status' id="status" name="status" class="mt-1 block w-full md:w-1/4 rounded-md border-gray-300 shadow-sm text-xs">
            <option></option>
            <option value="1">Sealed</option>
            <option value="2">Unsealed</option>
          </select>
          @include('livewire.includes.error-field', ['field' => 'status'])
        </div>
      
        <!-- Order By and Order Method -->
        <div class="flex space-x-2">
          <div class="w-1/2 md:w-1/4">
            <label for="orderby" class="block text-xs font-medium text-gray-700">Order By</label>
            <select wire:model='orderby' id="orderby" name="orderby" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-xs">
              <option value="sealtypes.sealid">Seal Type</option>
              <option value="sealed_by">Sealed By</option>
              <option value="sealed_at" @if (@$orderby=='')
                  selected
              @endif>Sealed At</option>
              <option value="unsealed_by">Unsealed By</option>
              <option value="unsealed_at">Unsealed At</option>
              <option value="status">Status</option>
            </select>
          </div>
          <div class="w-1/2 md:w-1/4">
            <label for="ordermethod" class="block text-xs font-medium text-gray-700">Order Method</label>
            <select wire:model='ordermethod' id="ordermethod" name="ordermethod" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-xs">
              <option value="asc">Ascending</option>
              <option value="desc" @if (@$orderby=='')
              selected
          @endif>Descending</option>
            </select>
          </div>
        </div>
        
        <!-- Buttons -->
        <div class="flex justify-start space-x-2 mt-4">
            <button type="button" wire:click='setShowFilterForm(0)' onclick="document.getElementById('filterform').classList.add('hidden');document.getElementById('filterbutton').classList.remove('hidden');" 
            class="px-4 py-2 text-gray-700 text-sm rounded-md hover:bg-grey-600">
                Sembunyikan
            </button>
            <button type="button" wire:click='resetInput' class="px-4 py-2 bg-gray-500 text-white text-xs rounded-md hover:bg-gray-600">
                Reset
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-xs rounded-md hover:bg-blue-600">
                Filter
            </button>
        </div>
    </form>
    {{-- @dump($sealhistory) --}}

    {{-- @include('livewire.admin.modules.sealhistory.sealhistory-mobile') --}}
    {{-- @include('livewire.admin.modules.sealhistory.sealhistory-pc') --}}

    
    @php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
    $domain = env('APP_URL', 'http://localhost');
@endphp

<div class="space-y-4 p-4 md:p-8" wire:replace>
    @foreach ($sealhistory as $item)
        <div key='{{Str::random(80)}}' class="border-t pt-4">
            <!-- Mobile header -->
            <div class="md:hidden">
                <p key="{{Str::random(40)}}" class="text-lg">{{ $item->sealname }}</p>
                <p class="text-gray-500 text-xs pb-2">{{ $item->barcode }}</p>
            </div>
            
            <!-- Desktop and mobile content -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                <!-- Desktop header -->
                <div class="hidden md:block">
                    <p class="text-lg">{{ $item->sealname }}</p>
                    <p class="text-gray-500 text-xs">{{ $item->barcode }}</p>
                    <p class="text-gray-500 text-xs mt-1">
                        Status: 
                        @switch($item->status)
                            @case(0)
                                Unused
                                @break
                            @case(1)
                                Sealed
                                @break
                            @case(2)
                                Unsealed
                                @break
                            @default
                                Unknown
                        @endswitch
                    </p>
                    @if($item->blocked)
                        <p class="text-red-500 text-xs mt-1">Blocked</p>
                    @endif
                </div>
                
                <!-- Sealed Picture -->
                <div>
                    @if($item->status >= 1)
                        <a href="{{ $domain }}/storage/pictures/{{ $item->sealed_picture }}" target="_blank">
                            <img src="{{ $domain }}/storage/pictures/{{ $item->sealed_picture }}" alt="Sealed Picture" class="w-full h-32 md:h-48 bg-gray-200 object-cover cursor-pointer">
                        </a>
                        <p class="text-gray-700 text-xs md:text-sm mt-2">{{ $item->sealed_by }}</p>
                        <p class="text-gray-500 text-xs md:text-sm">
                            {{ Carbon::parse($item->sealed_at)->format('d M Y, H:i') }}
                        </p>
                        <a href="https://www.google.com/maps?q={{ $item->sealed_location }}" target="_blank" class="text-blue-500 text-xs md:text-sm">Map</a>
                    @else
                        <div class="w-full h-32 md:h-48 bg-gray-100 flex items-center justify-center">
                            <p class="text-gray-500 text-xs md:text-sm">Not sealed yet</p>
                        </div>
                    @endif
                </div>
                
                <!-- Unsealed Picture -->
                <div>
                    @if($item->status == 2)
                        <a href="{{ $domain }}/storage/pictures/{{ $item->unsealed_picture }}" target="_blank">
                            <img src="{{ $domain }}/storage/pictures/{{ $item->unsealed_picture }}" alt="Unsealed Picture" class="w-full h-32 md:h-48 bg-gray-200 object-cover cursor-pointer">
                        </a>
                        <p class="text-gray-700 text-xs md:text-sm mt-2">{{ $item->unsealed_by }}</p>
                        <p class="text-gray-500 text-xs md:text-sm">
                            {{ Carbon::parse($item->unsealed_at)->format('d M Y, H:i') }}
                        </p>
                        <a href="https://www.google.com/maps?q={{ $item->unsealed_location }}" target="_blank" class="text-blue-500 text-xs md:text-sm">Map</a>
                    @else
                        <div class="w-full h-32 md:h-48 bg-gray-100 flex items-center justify-center">
                            <p class="text-gray-500 text-xs md:text-sm">Not unsealed yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if (@$meta['lastpagenumber'] >= 1)
    <div class="flex space-x-2 items-center text-xs">
        <!-- Tombol First -->
        <button 
            wire:click="setPage(1)"
            class="focus:outline-none {{ $meta['page'] == 1 ? 'text-gray-400 cursor-not-allowed' : 'text-blue-500 hover:text-blue-700' }}"
            @if ($meta['page'] == 1) disabled @endif>
            <span class="material-icons align-middle">
                first_page
            </span>
        </button>
    
        <!-- Tombol Previous -->
        <button 
            wire:click="setPage({{ $meta['page'] - 1 }})"
            class="focus:outline-none {{ $meta['page'] == 1 ? 'text-gray-400 cursor-not-allowed' : 'text-blue-500 hover:text-blue-700' }}"
            @if ($meta['page'] == 1) disabled @endif>
            <span class="material-icons align-middle">
                chevron_left
            </span>
        </button>
    
        <!-- Halaman Saat Ini -->
        <span class="text-gray-600 align-middle">
            {{ $meta['page'] }} / {{ $meta['lastpagenumber'] }}
        </span>
    
        <!-- Tombol Next -->
        <button 
            wire:click="setPage({{ $meta['page'] + 1 }})"
            class="focus:outline-none {{ $meta['page'] == $meta['lastpagenumber'] ? 'text-gray-400 cursor-not-allowed' : 'text-blue-500 hover:text-blue-700' }}"
            @if ($meta['page'] == $meta['lastpagenumber']) disabled @endif>
            <span class="material-icons align-middle">
                chevron_right
            </span>
        </button>
    
        <!-- Tombol Last -->
        <button 
            wire:click="setPage({{ $meta['lastpagenumber'] }})"
            class="focus:outline-none {{ $meta['page'] == $meta['lastpagenumber'] ? 'text-gray-400 cursor-not-allowed' : 'text-blue-500 hover:text-blue-700' }}"
            @if ($meta['page'] == $meta['lastpagenumber']) disabled @endif>
            <span class="material-icons align-middle">
                last_page
            </span>
        </button>
    </div>
    
    <!-- Tambahkan link untuk Material Icons di head HTML -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @endif
    
</div>

    </div>
