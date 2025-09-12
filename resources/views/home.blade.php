<x-app-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    <h1 class="text-xl font-bold mb-10">Welcome to the home page!</h1>
    <p class="indent-8">{{ fake()->text(1000) }}</p>
</x-app-layout>
