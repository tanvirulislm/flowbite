<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    @include('components.admin.sidebar')

    <div class="p-4 sm:ml-64 mt-14">
        <div class="p-4 border-1 border-default border-dashed rounded-base">
            @yield('content')
        </div>
    </div>

    {{--
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script> --}}
    {{-- Flowbite JS --}}
    {{--
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script> --}}
</body>

</html>