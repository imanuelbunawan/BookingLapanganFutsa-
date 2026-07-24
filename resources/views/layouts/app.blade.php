<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GOR Sport Center')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-900 flex h-screen overflow-hidden">

    <div class="w-64 flex-shrink-0">
        @yield('sidebar')
    </div>

    <div class="flex-1 flex flex-col h-screen overflow-y-auto">

        <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-bold text-gray-800">
                @yield('header_title', 'Dashboard')
            </h2>

            <div class="flex items-center space-x-3">
                <span class="text-sm font-medium text-gray-600">
                    {{ Auth::user()->nama_lengkap ?? 'Pengguna' }}
                </span>
                <div class="h-10 w-10 rounded-full bg-blue-600 text-white flex items-center justify-center">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </header>

        <main class="p-6 flex-1">
            @yield('content')
        </main>

    </div>

</body>

</html>