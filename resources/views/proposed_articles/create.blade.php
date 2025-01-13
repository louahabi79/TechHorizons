<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Propose Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                     <form method="POST" action="{{ route('proposed_articles.store') }}" enctype="multipart/form-data">
                        @csrf
                          <!-- Article Title -->
                         <div class="mb-4">
                               <x-input-label for="title" :value="__('Article Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                             <x-input-error :messages="$errors->get('title')" class="mt-2" />
                           </div>
                          <!-- Article Content -->
                          <div class="mb-4">
                              <x-input-label for="content" :value="__('Article Content')" />
                               <x-textarea id="content" class="block mt-1 w-full" name="content"  rows="4" :value="old('content')" required autocomplete="content"></x-textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                          </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('Propose') }}
                                </x-primary-button>
                            </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>