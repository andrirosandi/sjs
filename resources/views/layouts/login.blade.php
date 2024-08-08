<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		@vite('resources/js/app.js')
        <title>{{ $title ?? 'Sahabat Jaya Sukses' }}</title>
        <script src="https://kit.fontawesome.com/f985998339.js" crossorigin="anonymous"></script>
        @livewireStyles

    </head>
    <body>
        {{ $slot }}

        

    @livewireScripts

    
    </body>

</html>
