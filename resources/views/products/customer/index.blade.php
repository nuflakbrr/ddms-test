<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach ($products as $product)
                        <div class="col-span-1 lg:cols-span-4 w-full">
                            <div class="rounded-lg border border-neutral-200/60 bg-white text-neutral-700 shadow-sm">
                                <div class="p-7">
                                    <h2 class="mb-2 text-lg font-bold leading-none tracking-tight">
                                        {{ $product->name }}
                                    </h2>
                                    <p class="mb-5 text-neutral-500 truncate">
                                        {{ $product->description }}
                                    </p>
                                    <div class="flex items-center justify-between gap-3">
                                        <a href="{{ route('customer.products.show', $product->id) }}"
                                            class="inline-flex items-center justify-center w-full h-10 px-4 py-2 text-sm font-medium text-black transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none border bg-transparent hover:bg-neutral-100/90">
                                            View
                                        </a>

                                        <button
                                            class="w-40 inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                                            Add Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
