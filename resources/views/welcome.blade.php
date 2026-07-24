<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOR Sport Center - Booking Lapangan Futsal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-900 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm py-4 px-6 md:px-12 flex justify-between items-center fixed w-full top-0 z-50">
        <div class="font-extrabold text-xl text-blue-600 flex items-center">
            <i class="fa-solid fa-futbol mr-2 text-2xl"></i> GOR Sport
        </div>
        <div class="space-x-2 md:space-x-4 flex items-center">
            @auth
            <a href="{{ Auth::user()->id_role == 1 ? route('admin.dashboard') : route('user.dashboard') }}" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                Ke Dashboard
            </a>
            @else
            <a href="{{ route('login') }}" class="font-bold text-gray-600 hover:text-blue-600 transition-colors px-3 py-2">Masuk</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors shadow-sm">Daftar Akun</a>
            @endauth
        </div>
    </nav>

    <main class="flex-1 flex flex-col items-center justify-center text-center px-6 mt-20 pt-16 pb-12 w-full">
        <div class="inline-block p-4 rounded-full bg-blue-50 text-blue-600 mb-6">
            <i class="fa-solid fa-stopwatch text-4xl"></i>
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight max-w-4xl">
            Booking Lapangan Futsal <br class="hidden md:block"> <span class="text-blue-600">Lebih Cepat & Mudah</span>
        </h1>
        <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
            Tidak perlu repot datang ke GOR atau antre panjang. Cek ketersediaan jadwal, booking lapangan favorit Anda, dan lakukan pembayaran langsung dari genggaman Anda.
        </p>

        @guest
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-24">
            <a href="{{ route('register') }}" class="px-8 py-4 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition-colors shadow-lg text-lg flex items-center justify-center">
                Mulai Booking Sekarang <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>
        @endguest

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto text-left mb-24 w-full">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="h-12 w-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4 text-xl">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Jadwal Real-time</h3>
                <p class="text-gray-500 text-sm">Cek ketersediaan lapangan secara akurat dan hindari bentrok jadwal permainan.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="h-12 w-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4 text-xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Pembayaran Praktis</h3>
                <p class="text-gray-500 text-sm">Upload bukti transfer dengan mudah dan tunggu verifikasi cepat dari admin kami.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="h-12 w-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center mb-4 text-xl">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Info & Promo</h3>
                <p class="text-gray-500 text-sm">Dapatkan pengumuman terbaru dan diskon sewa lapangan langsung di dashboard Anda.</p>
            </div>
        </div>

        <div class="w-full max-w-6xl mx-auto text-left mb-12 px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Pilihan Lapangan Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Tersedia berbagai pilihan jenis lapangan dengan kualitas terbaik untuk kenyamanan bermain Anda bersama tim.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($lapangan as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow group flex flex-col">

                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_lapangan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-300">
                            <i class="fa-solid fa-image text-4xl"></i>
                        </div>
                        @endif

                        <div class="absolute top-4 right-4 bg-gray-900/80 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full">
                            {{ $item->jenis_lapangan ?? 'Standar' }}
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="font-bold text-gray-900 text-xl mb-2">{{ $item->nama_lapangan }}</h3>

                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Harga Sewa</p>
                                <p class="text-blue-600 font-extrabold text-lg">Rp {{ number_format($item->harga_per_jam ?? 0, 0, ',', '.') }}<span class="text-sm font-normal text-gray-500"> / Jam</span></p>
                            </div>

                            <a href="{{ route('register') }}" class="h-10 w-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors tooltip" title="Booking Lapangan Ini">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                    <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500 font-medium">Belum ada data lapangan yang ditambahkan.</p>
                </div>
                @endforelse
            </div>
        </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-8 mt-auto text-center">
        <p class="text-gray-500 text-sm font-medium">
            &copy; {{ date('Y') }} GOR Sport Center. All rights reserved.
        </p>
    </footer>

</body>

</html>