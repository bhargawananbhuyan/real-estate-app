<header class="bg-teal-500 text-white py-4 shadow-xl">
    <div class="container flex items-center justify-between gap-x-5 flex-wrap">
        <a href="{{ route('home') }}" class="font-semibold">{{ config('app.name') }}</a>

        <nav class="flex items-center gap-x-5 flex-wrap text-sm">
            <a href="{{ route('home') }}" @class(['underline' => Route::is('home')])>
                Home
            </a>

            @guest
                <a href="{{ route('login') }}" @class(['underline' => Route::is('login')])>
                    Login
                </a>
            @endguest

            @auth
                @if (Auth::user()->role === 'buyer')
                    <a href="{{ route('buyer.properties') }}" @class(['underline' => Route::is('buyer.properties')])>
                        Properties
                    </a>
                    <a href="{{ route('buyer.bookings') }}" @class(['underline' => Route::is('buyer.bookings')])>
                        Bookings
                    </a>
                @endif

                @if (Auth::user()->role === 'seller')
                    <a href="{{ route('seller.properties') }}" @class(['underline' => Route::is('seller.properties')])>
                        Properties
                    </a>
                    <a href="{{ route('seller.add_property_view') }}" @class(['underline' => Route::is('seller.add_property_view')])>
                        Add property
                    </a>
                @endif

                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.properties') }}" @class(['underline' => Route::is('admin.properties')])>
                        Properties
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="text-xs font-medium px-2.5 py-2 rounded-md bg-red-500 text-white">
                        Logout
                    </button>
                </form>
            @endauth
        </nav>
    </div>
</header>
