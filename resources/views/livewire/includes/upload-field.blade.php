{{-- @dump(@$$uploadfieldName) --}}
@php

$tempUrl =null;
$clientOriginalname =null;

if (@$$uploadfieldName != null){   
    try {
        $tempUrl = @$$uploadfieldName->temporaryUrl();
    } catch (\Throwable $th) {
        //throw $th;
    }
    $clientOriginalname = @$$uploadfieldName->getClientOriginalName();
}
@endphp

<div x-data="{ uploading: false, loadingFinished: false, progress: 0 }"
x-on:livewire-upload-start="uploading = true"
x-on:livewire-upload-finish="uploading = false"
x-on:livewire-upload-cancel="uploading = false"
x-on:livewire-upload-error="uploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress"
id="upload-block-{{$uploadfieldName}}" class="col-span-full mb-4">
    <label for="cover-photo-{{$uploadfieldName}}" class="block text-sm font-medium leading-6 text-gray-900">{{$uploadfieldCaption}}</label>
    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-indigo-600/25 px-6 py-10"
        ondragover="event.preventDefault(); this.classList.add('bg-indigo-100'); this.classList.remove('border-indigo-600');"
        ondrop="event.preventDefault(); this.classList.remove('bg-indigo-100'); this.classList.add('border-indigo-600'); document.getElementById('file-upload-{{$uploadfieldName}}').files = event.dataTransfer.files; document.getElementById('file-upload-{{$uploadfieldName}}').dispatchEvent(new Event('change'));"
        ondragleave="this.classList.remove('bg-indigo-100'); this.classList.add('border-indigo-600');"
        id="drop-field-{{$uploadfieldName}}">
        <div class="text-center">
            {{-- @dump(@$$uploadfieldName) --}}
            
            <span wire:loading.remove wire:target='{{$uploadfieldName}}'>
                
                <img id='image-temporary-{{$uploadfieldName}}' src="{{@$tempUrl}}" alt="Uploaded Image" class="@if (@$tempUrl == null) hidden @endif mx-auto rounded-sm h-12 w-12" />
                
                <div
                id='image-placeholder-{{$uploadfieldName}}' class=" @if (@$tempUrl != null) hidden @endif mx-auto h-12 w-12 text-gray-300" 
                > 
                {{-- @if ($attachment['filetype'] === 'image/png')
                    <i class="fas fa-image text-blue-500"></i> <!-- Warna biru untuk gambar -->
                @elseif ($attachment['filetype'] === 'application/pdf')
                    <i class="fas fa-file-pdf text-red-500"></i> <!-- Warna merah untuk PDF -->
                @elseif(Str::startsWith($attachment['filetype'], 'video/')) 
                    <i class="fas fa-video text-yellow-500"></i> <!-- Warna kuning untuk video -->
                @elseif($attachment['filetype'] === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $attachment['filetype'] === 'application/msword')
                    <i class="fas fa-file-word text-blue-300"></i> <!-- Warna biru muda untuk dokumen Word -->
                @elseif($attachment['filetype'] === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $attachment['filetype'] === 'application/vnd.ms-excel')
                    <i class="fas fa-file-excel text-green-500"></i> <!-- Warna hijau untuk spreadsheet -->
                @else
                    <i class="fas fa-file"></i>
                @endif --}}

                <svg 
                    viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                </svg>
                </div>
                
            </span> 



            <span x-show="uploading && !loadingFinished" class="mx-auto  rounded-sm">

                <span x-text="progress + '%'"><img wire:loading wire:target='{{$uploadfieldName}}'  src="{{ asset('src/loading.svg') }}" width="18" height="18" alt="Loading animation"></span>
            </span>
        

        <div class="mt-4 flex text-sm leading-6 text-gray-600">
            <label for="file-upload-{{$uploadfieldName}}" 
                class="relative cursor-pointer rounded-md bg-white font-semibold 
                text-indigo-600 focus-within:outline-none focus-within:ring-2 
                focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                <span id="file-name-{{$uploadfieldName}}">
                    @if (@$clientOriginalname != null)
                    {{@$clientOriginalname}}
                    @else
                    Upload a file
                    @endif
                </span>
                <input 
                    @if (@$useCamera === true)
                        accept="image/*" capture="environment"
                    @endif
                id="file-upload-{{$uploadfieldName}}"  wire:model='{{$uploadfieldName}}'
                    name="{{$uploadfieldName}}" type="file" class="sr-only" 
                    onchange="document.getElementById('file-name-{{$uploadfieldName}}')
                    .textContent = this.files.length > 0 ? this.files[0].name : 'Upload a file';
                    document.getElementById('drag-drop-text-{{$uploadfieldName}}')
                    .style.display = this.files.length > 0 ? 'none' : 'inline-block';
                    document.getElementById('cancel-button-{{$uploadfieldName}}')
                    .style.display = this.files.length > 0 ? 'inline-block' : 'none';"
                >
            </label>
<p class="pl-1 @if (@$clientOriginalname != null) hidden @endif flex" id="drag-drop-text-{{$uploadfieldName}}">
    
    <span>or drag and drop</span>
</p>
            <div wire:click="{{@$cancelAttachmentMethod}}" id="cancel-button-{{$uploadfieldName}}" 
                class="@if (@$clientOriginalname == null) hidden @endif hover:cursor-pointer" 
                onclick="document.getElementById('file-upload-{{$uploadfieldName}}').value = ''; 
                document.getElementById('file-name-{{$uploadfieldName}}').textContent = 'Upload a file';
                document.getElementById('drag-drop-text-{{$uploadfieldName}}').style.display = 'inline-block';
                this.style.display = 'none';
                document.getElementById(`image-placeholder-{{$uploadfieldName}}`).classList.remove('hidden');
                document.getElementById(`image-temporary-{{$uploadfieldName}}`).classList.add('hidden');">
                <svg class="h-4 w-4 text-gray-600 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
        <img id="uploaded-image-{{$uploadfieldName}}" class="hidden mt-4 max-h-40" src="" alt="Uploaded Image">
    </div>
</div>
@include('livewire.includes.error-field', ['field' => 'newattachment'])
</div>
