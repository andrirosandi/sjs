<div>
    @if(@$errorsInput[$field][0])
    @foreach($errorsInput[$field] as $error)
    <div class="text-red-500 mt-2 text-sm">
        {{ $error }}
    </div>
    @endforeach
    @endif

    @php
        try {
            @endphp
            @error($field)
            <div class="text-red-500 mt-2 text-sm">
            {{ $message }}
            </div>
            @enderror
            @php
        } catch (\Throwable $th) {
            //throw $th;
        }
    @endphp
    
</div>
