<form class="" action="#" wire:submit='save(0)'>
  @isset($id)
    <div class="flex items-center space-x-2 my-4 font-semibold">
      <span class="font-semibold text-gray-500 italic">Status: </span>
      <!-- Condition for displaying the span element -->
      @switch($response)
        @case(0)
          <span class="text-green-800 italic border-b-2 border-green-800">
            New Request
          </span>
          @break
        @case(1)
          <span class="text-blue-800 italic border-b-2 border-blue-800">
            Approved
          </span>
          @break
        @case(2)
          <span class="text-red-800 italic border-b-2 border-red-800">
            Rejected
          </span>
          @break
        @case(3)
          <span class="text-yellow-800 italic border-b-2 border-yellow-800">
            Hold
          </span>
          @break
        @case(4)
          <span class="text-gray-800 italic border-b-2 border-gray-800">
            Canceled
          </span>
          @break
      @endswitch

      
    </div>
@endisset

  @script
  <script>

    document.addEventListener('livewire:initialized',()=>{
      Livewire.on('rebuildAttachments',()=>{
        $wire.initAttachments();
      });
    });
    </script>
    @endscript

  <div class="sm:col-span-3 mb-4">
    <label for="orlansoft" class="block text-sm font-medium leading-6 text-gray-900">Orlansoft</label>
    <div class="mt-2">
        <select 
        @if (@$id != null AND @$response!=3) disabled @endif 
        wire:model='orlansoft' id="orlansoft" name="orlansoft" autocomplete="orlansoft-name" 
        class="
        block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
            <option value="" @if (@$orlansoft == null) selected @endif>pilih</option>
            @if (is_array(@$orlansoftOptions))
                @foreach ($orlansoftOptions as $orlansoftOption)
                    <option value="{{$orlansoftOption['id']}}" @if (@$orlansoft == $orlansoftOption['id']) selected @endif>{{$orlansoftOption['name']}}</option>
                @endforeach
            @endif
        </select>
        @include('livewire.includes.error-field', ['field' => 'orlansoft'])
    </div>
</div>

<div class="sm:col-span-full mb-4">
    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
    <div class="mt-2">
        <input 
        @if (@$id != null AND @$response!=3) disabled @endif 
        wire:model='title' id="title" name="title" type="text" autocomplete="title" class=" block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        @include('livewire.includes.error-field', ['field' => 'title'])
    </div>
</div>

<input type="text" class="hidden" wire:model='requesttype_id' name="requesttype_id" value="">

<div class="sm:col-span-3 mb-4">
    <label for="transactiontype" class="block text-sm font-medium leading-6 text-gray-900">Transaction Type</label>
    <div class="mt-2">
        <select @if (@$id != null AND @$response!=3) disabled @endif 
            wire:model='transactiontype_id' id="transactiontype" name="transactiontype_id" autocomplete="transactiontype-name" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
            <option value="" @if (@$transactiontype == null) selected @endif>pilih</option>
            @if (is_array(@$transactiontypeOptions))
                @foreach ($transactiontypeOptions as $transactiontypeOption)
                    <option value="{{$transactiontypeOption['id']}}" @if (@$transactiontype == $transactiontypeOption['id']) selected @endif>{{$transactiontypeOption['name']}}</option>
                @endforeach
            @endif
        </select>
        @include('livewire.includes.error-field', ['field' => 'transactiontype_id'])
    </div>
</div>
<div class="sm:col-span-3 w-1/1 mb-4">
    <label for="trno" class="block text-sm font-medium leading-6 text-gray-900">Transaction No</label>
    <div class="mt-2 flex">
        <input id="trno" readonly wire:model='trno' name="trno" type="text" autocomplete="trno" class="block w-full h-10 rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
        <button @if (@$id != null AND @$response!=3) disabled @endif  type="button" wire:click='initSearch' onclick="document.getElementById('cari').classList.remove('hidden');document.getElementById('searchQuery').focus();getElementById('searchShow').value=1;" class="cursor-pointer ml-2 px-4 bg-indigo-600 text-white h-10 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "><i class="fa-solid fa-magnifying-glass"></i></button>
        @include('livewire.includes.error-field', ['field' => 'trno'])
        <input wire:model='searchShow' type="hidden" name="searchShow" id="searchShow">
    </div>
</div>

<div class="mb4 {{ @$searchReturn['success'] != null ? '' : (@$searchShow == true ? '' : 'hidden')}}" id="cari">
    <label for="searchQuery" class="block text-sm font-medium text-gray-700">Cari:</label>
    <input  type="text" wire:model.live='searchQuery' name="searchQuery" id="searchQuery" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md py-2">
    @include('livewire.includes.error-field', ['field' => 'searchQuery'])
</div>
@if (@$searchReturn['data'][0] != null) 
<div id="searchTable" class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach (@$searchReturn['data'][0] as $column => $value)
                    @php if (in_array(strtolower($column),['approved','taxcalc','void_'])) continue; @endphp
                    <th scope="col" class="px-6 py-3">
                        {{$column}}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach (@$searchReturn['data'] as $keyRow => $row)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    @foreach ($row as $column => $value)
                        @php if (in_array(strtolower($column),['approved','taxcalc','void_'])) continue; @endphp
                        <th wire:click="setTrno(`{{@$row['trno']}}`)" onclick="document.getElementById('trno').value='{{@$row['trno']}}';document.getElementById('cari').classList.add('hidden');document.getElementById('searchTable').classList.add('hidden'); " scope="row" class="px-6 py-4 cursor-pointer @if (in_array(strtolower($column),['trno'])) font-medium text-gray-900 whitespace-nowrap dark:text-white @else font-normal @endif ">
                            {{@$value}}
                        </th>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{-- @dump(@$transactionData) --}}
@if( @$transactionData['trno'] == @$trno)
<div class="col-span-full mb-4">
  <label for="remarks" class="block text-sm font-medium leading-6 text-gray-900">Detail Transaction</label>
  <div class="mt-2 p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
    text-xs  
  ">
  <div class="flex flex-col">
    <!-- Header with Tailwind CSS -->
    <div class=" overflow-hidden  mb-4">
        <table class="border-collapse w-full">
            <tbody>
                @if (is_array(@$transactionData))
                @foreach ($transactionData as $key => $value)
                    @php
                    if (in_array(strtolower($key),[
                      'sys','catrsys','trno','siteid','entityid','approved','void_'
                    ])) continue;
                    if (in_array(strtolower($key),[
                      'amt','netamt','amount'
                    ])) $value = number_format($value);


                      
                    @endphp
                    @if (!is_array($value) && !is_object($value))
                        <tr>
                            <td class="py-2 px-4 font-semibold min-w-32 w-1/4 uppercase" >{{ $key }}</td>
                            <td class="py-2 px-4">{{ $value }}</td>
                        </tr>
                    @endif
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Detail with Tailwind CSS -->
    <div class="shadow overflow-hidden sm:rounded-lg border mb-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        @if (is_array(@$transactionData) and @$transactionData['detail']['data'][0] != null )
                        @foreach (array_keys($transactionData['detail']['data'][0]) as $header)
                        @php
                          $alignClass = null;
                          if (in_array(strtolower($header),[
                                'amt','netamt','amount'
                              ])) { $alignClass = 'text-right';}
                        @endphp
                            <th scope="col" class="px-6 py-3 text-left {{ $alignClass }} text-xs font-medium text-gray-500 uppercase tracking-wider">{{ ucfirst($header) }}</th>
                        @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if (is_array(@$transactionData))
                    @foreach ($transactionData['detail']['data'] as $detail)
                        <tr>
                          @foreach ($detail as $key => $value)
                          @php
                              $alignClass = null;
                              // Cek panjang nilai
                              $length = strlen($value);
                              // Jika panjang lebih dari 10 karakter, terapkan wrap
                              $wrapClass = $length > 100 ? 'whitespace-wrap' : '';

                              if (in_array(strtolower($key),[
                                'amt','netamt','amount'
                              ])) {$value = number_format($value); $alignClass = 'text-right';}
                          @endphp
                          <td class="px-6 py-4 max-w-[300px] {{ $alignClass??'' }} {{ $wrapClass }}">{{ $value }}</td> <!-- Atur lebar maksimum dan terapkan wrap -->
                            @endforeach
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            
          
        </div>
        
    </div>

    @php
                $first = (($transactionData['detail']['meta']['page'] ?? 1) - 1) == 0 ? null : 1;
                $previous = (($transactionData['detail']['meta']['page'] ?? 1) - 1) == 0 ? null : (($transactionData['detail']['meta']['page'] ?? 1) - 1);
                $next = (($transactionData['detail']['meta']['page'] ?? 1) == ($transactionData['detail']['meta']['lastpagenumber'] ?? 1)) ? null : (($transactionData['detail']['meta']['page'] ?? 1) + 1);
                $last = (($transactionData['detail']['meta']['page'] ?? 1) == ($transactionData['detail']['meta']['lastpagenumber'] ?? 1)) ? null : ($transactionData['detail']['meta']['lastpagenumber'] ?? 1);
            @endphp


            <div class="flex justify-between mb-2">
              <div>
                  <div class="flex items-center justify-center space-x-0 text-sm">
                      <button @if ($first !== null) wire:click='setpage({{$first}})' @else disabled @endif class="@if ($first == null) text-gray-200 @endif px-3 py-1 border w-12 my-0 rounded-l-md rounded-r-none" onclick="goToFirstPage()">
                          <<
                      </button>
                      <button @if ($previous !== null) wire:click='setpage(`{{$previous}}`)' @else disabled @endif class="@if ($previous == null) text-gray-200 @endif px-3 py-1 border-y w-12 my-0 rounded-none" onclick="goToPreviousPage()">
                          <
                      </button>
                      <span class="px-3 py-1 border rounded-none"><span class="text-gray-400">Page: </span>{{$transactionData['detail']['meta']['page'] ?? null}} / {{@$transactionData['detail']['meta']['lastpagenumber']}}</span>
                      <button @if ($next !== null) wire:click='setpage(`{{$next}}`)' @else disabled @endif class="@if ($next == null) text-gray-200 @endif px-3 py-1 border-y w-12 my-0 rounded-none" onclick="goToNextPage()">
                          >
                      </button>
                      <button @if ($last !== null) wire:click='setpage(`{{$last}}`)' @else disabled @endif class="@if ($last == null) text-gray-200 @endif px-3 py-1 border w-12 my-0 rounded-r-md" onclick="goToLastPage()">
                          >>
                      </button>
                  </div>
              </div>
              {{-- <div>
                  <span class="text-sm font-medium text-gray-700 mr-2">Total Rows:</span>
                  <span>{{ @$transactionData['detail']['meta']['totalrow'] }}</span>
              </div> --}}
          </div>
</div>

    
  </div>
    

</div>
@endif


<div class="col-span-full mb-4">
  <label for="remarks" class="block text-sm font-medium leading-6 text-gray-900">Remarks</label>
  <div class="mt-2">
    <textarea @if (@$id != null AND @$response!=3) disabled @endif  wire:model='remarks' id="remarks" name="remarks" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
    @include('livewire.includes.error-field', ['field' => 'remarks'])
    
  </div>
</div>

@if (is_array(@$attachments) ) @if (count($attachments) > 0)
<div class="col-span-full mb-4">
  <label class="block text-sm font-medium leading-6 text-gray-900">Attachments</label>

<ul class="space-y-2 mt-2">
  @foreach($attachments as $attachment)
  <li class="flex items-center bg-white p-4 border rounded-md shadow-sm">
    <a href="{{ $attachment['public'] }}" target="_blank" class="flex-grow flex items-center">
      <div class="flex-shrink-0">
        @if ($attachment['filetype'] === 'image/png')
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
@endif

      </div>
      <div class="ml-4">
        <p class="text-lg font-medium text-gray-800 break-all">{{ 
          strlen($attachment['originalname']) > 50 
          ? substr($attachment['originalname'], 0, 50) . ' ... ' . pathinfo($attachment['originalname'], PATHINFO_EXTENSION)
          :  $attachment['originalname'] }}</p>
        <p class="text-gray-500 text-sm">{{ $attachment['notes'] }}</p>
      </div>
    </a>
    
    <div class="ml-auto">
      
      <button 
      type="button"
      @if (@$response != 3 )
        disabled
      @endif 
      wire:click='deleteAttachment(`{{@$attachment['id']}}`)' class="
      @if (@$response === 3 || @$response === null )
      text-red-500 hover:text-red-700 cursor-pointer
      @else
      text-gray-500 
      @endif
       focus:outline-none">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
      </button>
    </div>
  </li>
  @endforeach
</ul>
{{-- @dump($attachment) --}}
</div>
@endif
@endif

@if (@$newAttachmentField === true)
@include('livewire.includes.upload-field',['uploadfieldName'=>'newattachment','uploadfieldCaption'=>'New Attachment'])
<div class="col-span-full mb-4">
  <label for="notes" class="block text-sm font-medium leading-6 text-gray-900">Attachment Notes</label>
  <div class="mt-2">
    <textarea wire:model='notes' id="notes" name="notes" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
    @include('livewire.includes.error-field', ['field' => 'notes'])
    
  </div>
</div>
@endif

@if(@$response === null || @$response === 3)
@if (@$newAttachmentField !== true)
    <a href="#!/" type="button" wire:click='newAttachment' class="text-indigo-600 text-sm font-semibold mt-4">
        Tambahkan Lampiran <span class="text-lg">+</span>
    </a>
@else


<a href="#!/" type="button" @if (@$newattachment == null) disabled @else wire:click='attachmentSave()'  @endif class="@if (@$newattachment != null) text-indigo-600 cursor-pointer @else text-gray-600 cursor-not-allowed @endif  text-sm font-semibold mt-4">
  Upload 
</a>
    
    |
    <a href="#!/" type="button" wire:click='cancelAttachment(`yes`)' class="text-red-600 text-sm font-semibold mt-4">
        Cancel Upload 
    </a>
@endif
@endif



<div class="mt-6 flex items-center justify-between gap-x-6">
  @if (@$trno != null)
    <a href="#" onclick="(function(navigator) {
    if (navigator.share) {
        navigator.share({
            title: '{{@$title}}', 
            text: '{{@$title}}*\n{{@$remarks}}\n\n', 
            url: '{{@$urltoshare}}',
        }).then(() => console.log('Successful share')).catch((error) => console.log('Error sharing', error));
    } else {
        // Fallback for browsers that do not support .share()
        alert('Sharing not supported in this browser or device!');
    }
    })(window.navigator);return false;" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-paper-plane"></i>
    </a>

    <a href="#" onclick="(function() {
        let textArea = document.createElement('textarea');
        textArea.value = '*{{@$title}}*\n{{@$remarks}}\n\n{{@$urltoshare}}';
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('Copy');
        textArea.remove();
        alert('URL copied to clipboard');
    })();return false;" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-copy"></i>
    </a>
    @endif

  <div class="ml-auto flex flex-wrap items-center justify-end gap-4">
    
  @if (@$isRequestor !== false)
   @if(@$response === 0 || @$response===3)
   <button
      type="button"
      class="border border-gray-300 bg-white rounded-md px-4 py-2 text-red-500 text-sm font-semibold hover:bg-gray-100 focus:outline-none" 
      wire:click='save(4)'
      wire:loading.class.remove="cursor-pointer" 
      wire:loading.class="cursor-not-allowed"
    >Cancel</button>
   @endif

   @if(@$response === null || @$response===0 || @$response === 3)
   <button
      type="button"
      class="border border-gray-300 bg-white rounded-md px-4 py-2 text-yellow-500 text-sm font-semibold hover:bg-gray-100 focus:outline-none" 
      wire:click='save(3)'
      wire:loading.class.remove="cursor-pointer" 
      wire:loading.class="cursor-not-allowed"
    >
    @if($response === 3)
        Save and Stay Hold
        @else
        Hold
    @endif
  </button>
   @endif

   @if(@$response === null || @$response===3)
   <button
      type="button"
      class="border-indigo-600 border rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-600" 
      wire:click='save(0)'
      wire:loading.class.remove="cursor-pointer" 
      wire:loading.class="cursor-not-allowed"
    >
    @if($response === 3)
    Save and Ajukan
    @else
    Ajukan
@endif</button>
   @endif
   @endif
   @if (@$isResponser === true)
   @if (@$response === 0)
   <button
      type="button"
      class="border-green-600 border rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-green-600" 
      wire:click='save(1)'
      wire:loading.class.remove="cursor-pointer" 
      wire:loading.class="cursor-not-allowed"
    >
    Approve
   </button>
   <button
      type="button"
      class="border-red-600 border rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-red-600" 
      wire:click='save(2)'
      wire:loading.class.remove="cursor-pointer" 
      wire:loading.class="cursor-not-allowed"
    >
    Reject
   </button>
   @endif
     
   @endif
</div>
</div>


@include('livewire.includes.error-popup')
@include('livewire.includes.success-popup')




</form>