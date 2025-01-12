<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Issue') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('issues.store') }}">
                        @csrf
                          <!-- Issue Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Issue Title')" />
                             <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                             <x-input-error :messages="$errors->get('title')" class="mt-2" />
                       </div>
                           <!-- Publication Date -->
                         <div class="mb-4">
                            <x-input-label for="publication_date" :value="__('Publication Date')" />
                            <x-text-input id="publication_date" class="block mt-1 w-full" type="date" name="publication_date" :value="old('publication_date')" autocomplete="publication_date" />
                                <x-input-error :messages="$errors->get('publication_date')" class="mt-2" />
                         </div>
                             <!-- Is Public -->
                         <div class="mb-4">
                           <label class="block font-medium text-sm text-gray-700" for="is_public">
                                  {{ __('Is Public') }}
                            </label>
                           <input type="checkbox" name="is_public" id="is_public"  value="1" {{ old('is_public') ? 'checked' : '' }} class="mt-1 border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            >
                           <x-input-error :messages="$errors->get('is_public')" class="mt-2" />
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