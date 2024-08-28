<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/js/app.js')
        <title>{{ @$data['title'] != null ? 'Sukses Group - ' . @$data['title'] : 'Sukses Group' }}</title>
        @livewireStyles
        <style>
            /* Custom styles for report layout */
            body {
                font-family: 'Nunito', sans-serif;
                margin: 0;
                padding: 20px;
                background: white;
            }

            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
<body>
<div class="report-content">
       
    <div class="content-body">
        {{ $slot }}
    </div>

    
</div>

@livewireScripts

</body>
</html>
