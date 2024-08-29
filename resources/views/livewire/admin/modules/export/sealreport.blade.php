<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        a {
        margin: 0;
        padding: 0;
        display: inline-block; /* Sesuaikan dengan kebutuhan */
    }

        /* Style for header table */
        .header-table {
            border-collapse: separate;
            border-spacing: 10px 0; /* Horizontal gap only */
            margin-bottom: 20px;
            max-width: 100%;
            width: auto; /* Auto width based on content */
        }
        .header-table td {
            padding: 8px;
            font-size: 13px;
            vertical-align: top;
        }
        .header-table td:first-child {
            font-weight: bold;
            padding-right: 10px; /* Add padding-right to the first column */
        }

        /* Style for main table */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .main-table th, .main-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #dddddd;
            vertical-align: top;
        }
        .main-table th {
            background-color: #f8f9fa;
            color: #333333;
            text-transform: uppercase;
            font-size: 14px;
        }
        .main-table td {
            font-size: 14px;
            color: #555555;
        }
        .main-table tr:hover {
            background-color: #eef1f5;
        }

        /* Image styles */
        .main-table img {
            max-width: 100px; /* Adjust the max width as needed */
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Badge styles */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 12px; /* Rounded edges */
            color: white;
            text-transform: uppercase;
        }
        /* Yellow for info (Sealed) */
        .sealed {
            background-color: #ffc107; /* Bootstrap 'info' color (yellow) */
        }
        /* Green for success (Unsealed) */
        .unsealed {
            background-color: #28a745; /* Bootstrap 'success' color (green) */
        }

        /* Center align the title */
        .title {
            text-align: center;
            font-size: 28px; /* Adjust the font size */
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Title -->
    <h3 class="title">{{ $data['title'] }}</h3>

    <table class="header-table">
        <!-- Print Date -->
        <tr>
            <td>Print Date</td>
            <td>:</td>
            <td colspan="3">{{ \Carbon\Carbon::now()->format('d M Y H:i') }}</td>
        </tr>

        @if ($data['code'])
        <tr>
            <td>Code</td>
            <td>:</td>
            <td colspan="3">{{ $data['code'] }}</td>
        </tr>
        @endif

        @if ($data['sealid'])
        <tr>
            <td>Sealid</td>
            <td>:</td>
            <td colspan="3">{{ $data['sealname'] }}</td>
        </tr>
        @endif

        @if ($data['sealed_at_from'] || $data['sealed_at_to'])
        <tr>
            <td>Sealed At</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($data['sealed_at_from'])->format('d M Y H:i') }}</td>
            <td>to</td>
            <td>{{ \Carbon\Carbon::parse($data['sealed_at_to'])->format('d M Y H:i') }}</td>
        </tr>
        @endif

        @if ($data['unsealed_at_from'] || $data['unsealed_at_to'])
        <tr>
            <td>Unsealed At</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($data['unsealed_at_from'])->format('d M Y H:i') }}</td>
            <td>to</td>
            <td>{{ \Carbon\Carbon::parse($data['unsealed_at_to'])->format('d M Y H:i') }}</td>
        </tr>
        @endif

        @if ($data['sealed_by'])
        <tr>
            <td>Sealed By</td>
            <td>:</td>
            <td colspan="3">{{ Str::title($data['sealed_by']) }}</td>
        </tr>
        @endif

        @if ($data['unsealed_by'])
        <tr>
            <td>Unsealed By</td>
            <td>:</td>
            <td colspan="3">{{ Str::title($data['unsealed_by']) }}</td>
        </tr>
        @endif

        @if ($data['blocked'])
        <tr>
            <td>Blocked</td>
            <td>:</td>
            <td colspan="3">{{ $data['blocked'] }}</td>
        </tr>
        @endif

        @if ($data['status'])
        <tr>
            <td>Status</td>
            <td>:</td>
            <td colspan="3">{{$data['status'] == 2 ? 'unsealed' : ($data['status'] == 1 ? 'sealed' : 'unused')}}</td>
        </tr>
        @endif

        @if ($data['showUnusedBarcode'])
        {{-- <tr>
            <td>Show Unused Barcode</td>
            <td colspan="3">{{ $data['showUnusedBarcode'] }}</td>
        </tr> --}}
        @endif
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Seal Type</th>
                <th>Status</th>
                <th colspan="2">Sealed</th>
                <th colspan="2">Unsealed</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['content'] as $item)
            <tr>
                <td>{{ $item['barcode'] }}</td>
                <td>{{ $item['sealname'] }}</td>
                <td><span class="badge {{$item['status'] == 2 ? 'unsealed' : ($item['status'] == 1 ? 'sealed' : 'unused')}}">{{$item['status'] == 2 ? 'unsealed' : ($item['status'] == 1 ? 'sealed' : 'unused')}}</span></td>
                <td>
                    <a href="{{ env('APP_URL', 'http://localhost').'/storage/pictures/'.$item['sealed_picture'] }}" target="_blank">
                        <img src="{{ env('APP_URL', 'http://localhost').'/storage/pictures/thumbnail/'.$item['sealed_picture'] }}" >
                    </a>
                </td>
                <td>
                    {{ Str::title($item['sealed_by']) }} <br>
                    {{ (!empty($item['sealed_at']))? \Carbon\Carbon::parse($item['unsealed_at'])->format('d M Y H:i') : '' }} <br>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item['sealed_location']) }}" target="_blank">{{ $item['sealed_location'] }}</a>
                </td>
                <td>
                    <a href="{{ env('APP_URL', 'http://localhost').'/storage/pictures/'.$item['unsealed_picture'] }}" target="_blank">
                        <img src="{{ env('APP_URL', 'http://localhost').'/storage/pictures/thumbnail/'.$item['unsealed_picture'] }}" >
                    </a>
                </td>
                <td>
                    {{ Str::title($item['unsealed_by']) }} <br>
                    {{ (!empty($item['unsealed_at']))? \Carbon\Carbon::parse($item['unsealed_at'])->format('d M Y H:i') : '' }} <br>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item['unsealed_location']) }}" target="_blank">{{ $item['unsealed_location'] }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
