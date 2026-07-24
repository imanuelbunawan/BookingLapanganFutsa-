<aside class="bg-gray-900 text-gray-300 flex flex-col h-full transition-all duration-300 shadow-xl">

    <div class="h-16 flex items-center justify-center bg-gray-950 border-b border-gray-800">
        <i class="fa-solid fa-circle-user text-blue-500 text-xl mr-3"></i>
        <span class="text-white font-bold text-lg tracking-wider">USER PANEL</span>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors hover:bg-gray-800 hover:text-white {{ request()->routeIs('user.dashboard') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa-solid fa-house w-6 text-center mr-2"></i> <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('user.booking.create') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors hover:bg-gray-800 hover:text-white {{ request()->routeIs('user.booking.*', 'user.pembayaran.*') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa-solid fa-futbol w-6 text-center mr-2"></i> <span class="font-medium">Booking Lapangan</span>
        </a>

        <a href="{{ route('user.bookings.history') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors hover:bg-gray-800 hover:text-white {{ request()->routeIs('user.riwayat') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa-solid fa-clock-rotate-left w-6 text-center mr-2"></i> <span class="font-medium">Riwayat Order</span>
        </a>

        <!-- Tambahan Menu Pengumuman -->
        <a href="{{ route('user.announcements.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors hover:bg-gray-800 hover:text-white {{ request()->routeIs('user.announcements.*') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa-solid fa-bullhorn w-6 text-center mr-2"></i> <span class="font-medium">Pengumuman</span>
        </a>
    </nav>

    <div class="p-4 bg-gray-950 border-t border-gray-800">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors shadow-md">
                <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
            </button>
        </form>
    </div>
</aside>