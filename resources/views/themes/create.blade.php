<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Theme') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('themes.store') }}">
                        @csrf

                        <!-- Theme Name -->
                        <div class="mb-4">
                            <x-input-label for="theme_name" :value="__('Theme Name')" />
                            <x-text-input id="theme_name" class="block mt-1 w-full" type="text" name="theme_name" :value="old('theme_name')" required autofocus autocomplete="theme_name" />
                            <x-input-error :messages="$errors->get('theme_name')" class="mt-2" />
                        </div>

                        <!-- Theme Description -->
                        <div class="mb-4">
                            <x-input-label for="theme_description" :value="__('Theme Description')" />
                            <x-textarea id="theme_description" class="block mt-1 w-full" name="theme_description" rows="4" :value="old('theme_description')" autocomplete="theme_description"></x-textarea>
                            <x-input-error :messages="$errors->get('theme_description')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>