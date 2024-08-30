<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="mb-2 text-lg font-bold leading-none tracking-tight">
                        {{ $product->name }}
                    </h2>
                    <p class="mb-5 text-neutral-500 truncate">
                        {{ $product->description }}
                    </p>
                    <p class="mb-5 text-neutral-500 truncate">
                        Price: {{ $product->price }}
                    </p>
                    <a href="{{ route('customer.products.index') }}"
                        class="inline-flex items-center justify-center w-full h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
