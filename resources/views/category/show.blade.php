<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form class="border rounded-lg shadow-sm bg-card text-neutral-900" method="POST"
                    action="{{ route('categories.update', $category->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="text-lg font-semibold leading-none tracking-tight">
                            Edit Data <i>{{ $category->name }}</i>
                        </h3>
                        <p class="text-sm text-neutral-500">
                            Fill the form below to edit data of category.
                        </p>
                    </div>
                    <div class="p-6 pt-0 space-y-2">
                        <div class="space-y-1">
                            <label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                for="name">Name</label>
                            <input type="text" placeholder="Name of Category" name="name" id="name"
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            @error('name')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center p-6 pt-0">
                        <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                            Edit Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
