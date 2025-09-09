<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Home Page</title>
    @vite(['resources/js/app.js'])
</head>
<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                                <x-nav-link href="/users" :active="request()->is('users')">Users</x-nav-link>
                                <x-nav-link href="/companies" :active="request()->is('companies')">Companies</x-nav-link>
                                <x-nav-link href="/products" :active="request()->is('products')">Products</x-nav-link>
                                <x-nav-link href="/recipients" :active="request()->is('recipients')">Recipients</x-nav-link>
                                <x-nav-link href="/orders" :active="request()->is('orders')">Orders</x-nav-link>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            @guest
                                <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
                                <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
                            @endguest

{{--                            @auth--}}
{{--                                <form method="POST" action="/logout">--}}
{{--                                    @csrf--}}
{{--                                    <x-form-button>Log Out</x-form-button>--}}
{{--                                </form>--}}
{{--                            @endauth--}}
                        </div>

                    </div>
                </div>
            </div>
        </nav>
        <header class="relative bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>

            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>
</html>
