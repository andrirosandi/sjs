<div>
  @php
    $first = (($contentData['meta']['page']??1) - 1) == 0 ? null : 1;
    $previous = (($contentData['meta']['page']??1) - 1) == 0 ? null : (($contentData['meta']['page']??1) - 1);
    $next = (($contentData['meta']['page']??1) == ($contentData['meta']['lastpagenumber']??1)) ? null : (($contentData['meta']['page']??1) + 1);
    $last = (($contentData['meta']['page']??1) == ($contentData['meta']['lastpagenumber']??1)) ? null : ($contentData['meta']['lastpagenumber']??1);
  @endphp
    {{-- @dump([$contentData,
    [$first,$previous,$next,$last,]
    ]) --}}
    <div class="container mx-auto">
        <div class="py-8">
            <h2 class="text-2xl font-semibold mb-4">Pengajuan Approval</h2>
            
            <div class="flex py-2">
              <input wire:model.live='q' type="text" id="search" name="search" placeholder="Cari" class="min-w-72 px-4 py-2 bg-white border border-gray-300 shadow-sm rounded-md text-sm leading-5 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
              <div class="flex ml-auto">
                <label for="orderby" class="text-sm flex-none px-4 py-2">Urutkan: </label>
                <select  wire:model.change='orderby' id="orderby" name="orderby" autocomplete="orderby-name" class="w-40 px-4 py-2 bg-white border border-gray-300 rounded-l-md shadow-sm text-sm leading-5 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                  <option @if ($orderby == 'title') selected @endif value="title">title</option> 
                  <option @if ($orderby == 'remarks') selected @endif value="remarks">remarks</option> 
                  <option @if ($orderby == 'trno') selected @endif value="trno">trno</option> 
                  {{-- <option @if ($orderby == 'transactiontype_id') selected @endif value="transactiontype_id">transactiontype_id</option>  --}}
                  {{-- <option @if ($orderby == 'requesttype_id') selected @endif value="requesttype_id">requesttype_id</option>  --}}
                  <option @if ($orderby == 'username') selected @endif value="username">requestor</option> 
                  <option @if ($orderby == 'response') selected @endif value="response">response</option> 
                  {{-- <option @if ($orderby == 'created_at') selected @endif value="created_at">created_at</option>  --}}
                  <option @if ($orderby == 'updated_at') selected @endif value="updated_at">date</option> 
                  {{-- <option @if ($orderby == 'username') selected @endif value="username">username</option>  --}}
                  <option @if ($orderby == 'orlansoft') selected @endif value="orlansoft">orlansoft</option> 
                </select>
                <select wire:model.change='ordermethod'  id="ordermethod" name="ordermethod" autocomplete="ordermethod-name" class="w-20 px-2 py-2 bg-white border border-l-0 border-gray-300 rounded-r-md shadow-sm text-sm leading-5 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  <option @if ($ordermethod == 'asc') selected @endif value="asc">Asc</option>
                  <option @if ($ordermethod == 'desc') selected @endif value="desc">Desc</option>
                </select>
              </div>
            </div>
            
            
          
                        
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider " colspan="">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider " colspan="3">Title</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider " colspan="2">Remarks</th>
                        
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($contentData['data'][0]??null != null)
                        
                    
                    @foreach($contentData['data'] as $data)
                    
                    <tr onclick="Livewire.navigate(`/pengajuan_approval_form?id={{$data['id']}}`)" class="cursor-pointer ">
                        
                        <td colspan="1" class="px-6 pt-2 pb-0.5 whitespace-nowrap">
                        
                        @switch($data['response'])
                        {{-- @switch($response) --}}
                        @case(0)
                          <span class="text-xs bg-green-300 text-white italic border p-1 rounded-lg border-green-200">
                            Diajukan
                          </span>
                          @break
                        @case(1)
                          <span class="text-xs bg-blue-300 text-white italic border p-1 rounded-lg border-blue-200">
                            Disetujui
                          </span>
                          @break
                        @case(2)
                          <span class="text-xs bg-red-300 text-white italic border p-1 rounded-lg border-red-200">
                            Ditolak
                          </span>
                          @break
                        @case(3)
                          <span class="text-xs bg-yellow-300 text-white italic border p-1 rounded-lg border-yellow-200">
                            Hold
                          </span>
                          @break
                        @case(4)
                          <span class="text-xs bg-gray-300 text-white italic border p-1 rounded-lg border-gray-200">
                            Dibatalkan
                          </span>
                          @break
                      @endswitch
                        
                            {{-- @default
                        @endswitch --}}
                         
                        
                        </td>
                        <td colspan="3" class="px-6 pt-2 pb-0.5 whitespace-nowrap">{{ $data['title'] }}</td>
                        <td colspan="2" class="px-6 pt-2 pb-0.5 whitespace-nowrap">{{ $data['remarks'] }}</td>
                    </tr>
                    <tr onclick="Livewire.navigate(`/pengajuan_approval_form?id={{$data['id']}}`)" 
                      class="cursor-pointer border-b-gray-200 border-b
                     ">
                      {{-- status --}}
                      <td class=" mb-2 mt-0 text-xs text-gray-400 italic px-6 pt-0.5 pb-3 whitespace-nowrap uppercase font-semibold">{{ $data['orlansoft'] }}</td> 
                      {{-- date and trno --}}
                      <td class=" mb-2 mt-0 text-xs text-gray-400 italic px-6 pt-0.5 pb-3 whitespace-nowrap">{{ date('d M y', strtotime($data['updated_at'])) }}</td>
                      <td class=" mb-2 mt-0 text-xs text-gray-400 italic px-6 pt-0.5 pb-3 whitespace-nowrap">{{ $data['trno'] }}</td>
                      <td class=" mb-2 mt-0 text-xs text-gray-400 italic px-6 pt-0.5 pb-3 whitespace-nowrap">{{ number_format($data['detail']['Netamt']??($data['detail']['Amount'] ?? null)) }}</td>
                      <td class=" mb-2 mt-0 text-xs text-gray-400 italic px-6 pt-0.5 pb-3 whitespace-nowrap">{{ $data['name'] }}</td> 
                      {{-- user and  --}}
                      <td class=" mb-2 mt-0 text-xs text-gray-400 italic px-6 pt-0.5 pb-3 whitespace-nowrap">{{ $data['username'] }}</td>
                      <td class=" mb-2 mt-0"></td>
                  </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
    
            <div class="py-4">
                <!-- Navigasi Halaman -->
                <div class="flex justify-between">
                    <div>
                      <div class="flex items-center justify-center space-x-0 text-sm">
                        <button @if ($first !== null) wire:click='setpage({{$first}})' @else disabled @endif class="@if ($first == null) text-gray-200 @endif px-3 py-1 border w-12 my-0 rounded-l-md rounded-r-none" onclick="goToFirstPage()">
                            <<
                        </button>
                        <button @if ($previous !== null) wire:click='setpage(`{{$previous}}`)' @else disabled @endif class="@if ($previous == null) text-gray-200 @endif px-3 py-1 border-y w-12 my-0 rounded-none" onclick="goToPreviousPage()">
                            <
                        </button>
                        <span class="px-3 py-1 border rounded-none"><span class="text-gray-400">Page: </span>{{$contentData['meta']['page']??null}}</span>
                        <button @if ($next !== null) wire:click='setpage(`{{$next}}`)' @else disabled @endif class="@if ($next == null) text-gray-200 @endif px-3 py-1 border-y w-12 my-0 rounded-none" onclick="goToNextPage()">
                            > 
                        </button>
                        <button @if ($last !== null) wire:click='setpage(`{{$last}}`)' @else disabled @endif class="@if ($last == null) text-gray-200 @endif px-3 py-1 border w-12 my-0 rounded-r-md" onclick="goToLastPage()">
                            >> 
                        </button>
                    </div>
                    
                    
                    
                    
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-700 mr-2">Total Rows:</span>
                        <span>{{ @$contentData['meta']['totalrow'] }}</span>
                    </div>
                    <!-- Tambahkan navigasi halaman berdasarkan kebutuhan -->
                </div>
            </div>
        </div>
    </div>
    
</div>
