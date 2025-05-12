<header class="bg-green-600 text-white">
  <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

    <a href="/" class="text-2xl font-bold">WarungKampus</a>
    <nav class="inline-flex gap-2">
        @guest
        <a href="{{route('login')}}"><x-button type="button" color="primary">Login</x-button></a>
        <a href="{{route('register')}}"><x-button type="button" color="secondary">Register</x-button></a>
        @endguest

        @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-button type="submit" color="danger">Logout</x-button>
        </form>
        @endauth
    </nav>
  </div>
</header>