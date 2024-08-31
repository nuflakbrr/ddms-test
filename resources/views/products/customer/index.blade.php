<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="grid grid-cols-1 gap-3 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($products as $product)
                        <div class="w-full col-span-1 lg:cols-span-4">
                            <div class="bg-white border rounded-lg shadow-sm border-neutral-200/60 text-neutral-700">
                                <div class="p-7">
                                    <h2 class="mb-2 text-lg font-bold leading-none tracking-tight">
                                        {{ $product->name }}
                                    </h2>
                                    <p id="price" class="mb-2 truncate text-neutral-500">
                                        {{ $product->price }}
                                    </p>
                                    <p class="mb-5 truncate text-neutral-500">
                                        {{ $product->description }}
                                    </p>
                                    <div class="flex items-center justify-between gap-3">
                                        <a href="{{ route('customer.products.show', $product->id) }}"
                                            class="inline-flex items-center justify-center w-full h-10 px-4 py-2 text-sm font-medium text-black transition-colors bg-transparent border rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none hover:bg-neutral-100/90">
                                            View
                                        </a>

                                        <button
                                            class="inline-flex items-center justify-center w-40 h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
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

<script>
    $(document).ready(function() {
        // Cart logic here, and save cart data to local storage

        // Add to cart
        $('button').click(function() {
            // Get product id
            var productId = $(this).closest('.col-span-1').find('a').attr('href').split('/').pop();

            // Get cart data from local storage
            var cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Check if product already in cart
            var productIndex = cart.findIndex(function(item) {
                return item.id == productId;
            });

            if (productIndex == -1) {
                // Add product to cart
                cart.push({
                    id: productId,
                    name: $(this).closest('.col-span-1').find('h2').text(),
                    description: $(this).closest('.col-span-1').find('p').text(),
                    quantity: 1,
                    price: $(this).closest('.col-span-1').find('#price').text(),
                });
            } else {
                // Increase product quantity
                cart[productIndex].quantity++;
            }

            // Save cart data to local storage
            localStorage.setItem('cart', JSON.stringify(cart));
        });
    });
</script>
