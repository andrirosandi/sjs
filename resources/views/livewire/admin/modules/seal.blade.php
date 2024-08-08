<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @if($step == 1)
    <div id="qr-reader" style="max-w-full max-h-full"></div>
    <div id="qr-reader-results"></div>
    @elseif ($step == 2)
        @if($needcapture == 1)
        @include('livewire.includes.upload-field',['uploadfieldName'=>'newattachment','uploadfieldCaption'=>'New Attachment','useCamera' => true])
        @endif

        @if ($needlocation == 1)
        <div class="">
            <label for="geolocation" class="block text-gray-700 text-sm font-bold mb-2">Geolocation</label>
            <input type="hidden" name="geolocation" id="geolocation">
            <p id="location" class="mb-4 text-xs text-gray-700">
                @if ($geolocation != null )
                @php
                    $loc = explode(',',$geolocation);
                @endphp

                Latitude: {{$loc[0]}}, Longitude: {{$loc[1]}}
                @else
                the button to get your geolocation.
                @endif </p>
            <button class="bg-blue-500 text-white px-3 py-2 text-sm rounded hover:bg-blue-700"
                
                onclick="if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            var geolocationInput = document.getElementById('geolocation');
                            var locationText = 'Latitude: ' + position.coords.latitude + ', Longitude: ' + position.coords.longitude;
                            geolocationInput.value = locationText;
                            document.getElementById('location').textContent = locationText;
                            document.getElementById('mapsLink').href = 'https://www.google.com/maps?q=' + position.coords.latitude + ',' + position.coords.longitude;
                            document.getElementById('mapsLink').classList.remove('hidden');
                            Livewire.dispatch('setloc', { geolocation: position.coords.latitude + ',' + position.coords.longitude });
                            
                        },
                        function(error) {
                            alert('Error: ' + error.message);
                        }
                    );
                } else {
                    console.log('Geolocation is not supported by this browser.');
                }">
                Get Geolocation
            </button>
            <a id="mapsLink" href="@if ($geolocation != null)
            https://www.google.com/maps?q={{$geolocation}}
            @else
            #
            @endif" target="_blank" class="@if ($geolocation == null)
                hidden
            @endif text-blue-500 text-sm mt-4 inline-block">Open in Google Maps</a>
        </div>

        
        
            
        @endif
        <div class="mt-6 flex items-center justify-end gap-x-6">
            
            <button type="button" class=" font-semibold leading-6 text-gray-900" onclick="location.reload()">Cancel</button>
            <button 
                @if (
                    ($needcapture == 1 and $newattachment == null) 
                    or
                    ($needlocation == 1 and $geolocation == null))
                    disabled
                @endif
            
            type="button" wire:click="save({{$barcodedata->status+1}})" class="
                rounded-md  px-4 py-2 font-semibold text-white shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 
                @if (
                    ($needcapture == 1 and $newattachment == null) 
                    or
                    ($needlocation == 1 and $geolocation == null))
                bg-gray-600
                @elseif ($barcodedata->status == 1)
                bg-red-600 hover:bg-red-500 focus-visible:outline-red-600
                @else
                bg-indigo-600 hover:bg-indigo-500 focus-visible:outline-indigo-600
                @endif

                ">
                @if ($barcodedata->status == 1)
                    Buka Segel
                @else
                    Pasang Segel
                @endif
            </button>
          </div>
        {{-- <button class="fixed right-0 top-1/2 transform -translate-y-1/2 bg-red-500 text-white px-4 py-2 rounded-l-lg hover:bg-red-700">
            Pasang Segel
        </button> --}}
    @elseif($step == 3)
    <div class="bg-white p-6 rounded-lg text-center">
        <div class="mb-4">
            <!-- Icon -->
            @if($status === 1)
                <svg class="w-16 h-16 text-green-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            @else
                <svg class="w-16 h-16 text-red-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            @endif
        </div>
        <h2 class="text-2xl font-semibold mb-2">
            <!-- Success/Failed -->
            @if($status === 1)
                Berhasil
            @else
                Gagal
            @endif
        </h2>
        <p class="text-gray-600">
            <!-- Pesan -->
            {{ $message }}
        </p>
    </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
            
        <button type="button" class="border rounded-lg font-semibold px-4 py-2 leading-6 text-gray-900" onclick="location.reload()">Selesai</button>
    </div>
    @endif

    @script
        <script>
            
        </script>
        @endscript



</div>
