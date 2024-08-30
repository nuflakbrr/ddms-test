<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div x-data="{
                    tabSelected: 1,
                    tabId: $id('tabs'),
                    tabButtonClicked(tabButton) {
                        this.tabSelected = tabButton.id.replace(this.tabId + '-', '');
                        this.tabRepositionMarker(tabButton);
                    },
                    tabRepositionMarker(tabButton) {
                        this.$refs.tabMarker.style.width = tabButton.offsetWidth + 'px';
                        this.$refs.tabMarker.style.height = tabButton.offsetHeight + 'px';
                        this.$refs.tabMarker.style.left = tabButton.offsetLeft + 'px';
                    },
                    tabContentActive(tabContent) {
                        return this.tabSelected == tabContent.id.replace(this.tabId + '-content-', '');
                    }
                }" x-init="tabRepositionMarker($refs.tabButtons.firstElementChild);" class="relative w-full">

                    <div x-ref="tabButtons"
                        class="relative inline-grid items-center justify-center w-full h-10 grid-cols-2 p-1 text-gray-500 bg-gray-100 rounded-lg select-none">
                        <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                            class="relative z-20 inline-flex items-center justify-center w-full h-8 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">
                            List Products
                        </button>
                        <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                            class="relative z-20 inline-flex items-center justify-center w-full h-8 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">
                            Add New Data
                        </button>
                        <div x-ref="tabMarker" class="absolute left-0 z-10 w-1/2 h-full duration-300 ease-out" x-cloak>
                            <div class="w-full h-full bg-white rounded-md shadow-sm"></div>
                        </div>
                    </div>
                    <div class="relative w-full mt-2 content bg-white">
                        <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative">
                            <div class="flex flex-col">
                                <div class="overflow-x-auto">
                                    <div class="inline-block min-w-full">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full divide-y divide-neutral-200">
                                                <thead>
                                                    <tr class="text-neutral-500">
                                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                                            Name
                                                        </th>
                                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                                            Description
                                                        </th>
                                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                                            Price
                                                        </th>
                                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                                            Category
                                                        </th>
                                                        <th class="px-5 py-3 text-xs font-medium text-right uppercase">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-neutral-200">
                                                    @if ($products->isEmpty())
                                                        <tr class="text-neutral-800">
                                                            <td class="px-5 py-4 text-center text-sm font-medium whitespace-nowrap"
                                                                colspan="5">No data available! Try to add new one.
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @foreach ($products as $product)
                                                        <tr class="text-neutral-800">
                                                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                                                {{ $product->name }}
                                                            </td>
                                                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                                                {{ $product->description }}
                                                            </td>
                                                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                                                {{ $product->price }}
                                                            </td>
                                                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                                                {{ $product->category->name }}
                                                            </td>
                                                            <td
                                                                class="flex items-center justify-end gap-2 px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                                <form
                                                                    action="{{ route('admin.products.destroy', $product->id) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <a class="text-blue-600 hover:text-blue-700"
                                                                        href="{{ route('admin.products.show', $product->id) }}">
                                                                        Edit
                                                                    </a>
                                                                    <button type="submit"
                                                                        class="text-red-600 hover:text-red-700">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative" x-cloak>
                            <form class="border rounded-lg shadow-sm bg-card text-neutral-900" method="POST"
                                action="{{ route('admin.products.store') }}">
                                @csrf
                                <div class="flex flex-col space-y-1.5 p-6">
                                    <h3 class="text-lg font-semibold leading-none tracking-tight">
                                        Add New Data of Product
                                    </h3>
                                    <p class="text-sm text-neutral-500">
                                        Fill the form below to add new data of product.
                                    </p>
                                </div>
                                <div class="p-6 pt-0 space-y-2">
                                    <div class="space-y-1">
                                        <label
                                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                            for="name">Name</label>
                                        <input type="text" placeholder="Name of Product" name="name"
                                            id="name"
                                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                        @error('name')
                                            <div class="text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="space-y-1">
                                        <label
                                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                            for="description">Description</label>
                                        <textarea x-data="{
                                            resize() {
                                                $el.style.height = '0px';
                                                $el.style.height = $el.scrollHeight + 'px'
                                            }
                                        }" x-init="resize()" @input="resize()" type="text"
                                            placeholder="Description of Product" name="description" id="description"
                                            class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                                        @error('description')
                                            <div class="text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="space-y-1">
                                        <label
                                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                            for="price">Price</label>
                                        <input type="text" placeholder="Price of Product" name="price"
                                            id="price"
                                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                        @error('price')
                                            <div class="text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="space-y-1">
                                        <label
                                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                            for="category_id">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex items-center p-6 pt-0">
                                    <button type="submit"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                                        Add New
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
