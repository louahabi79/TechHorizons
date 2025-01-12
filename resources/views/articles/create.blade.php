<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Article Title -->
                        <div class="mb-4">
                            <x-input-label for="article_title" :value="__('Article Title')" />
                            <x-text-input id="article_title" class="block mt-1 w-full" type="text" name="article_title" :value="old('article_title')" required autofocus autocomplete="article_title" />
                            <x-input-error :messages="$errors->get('article_title')" class="mt-2" />
                        </div>

                        <!-- Article Content -->
                        <div class="mb-4">
                            <x-input-label for="article_content" :value="__('Article Content')" />
                            <x-textarea id="article_content" class="block mt-1 w-full" name="article_content" rows="4" :value="old('article_content')" required autocomplete="article_content"></x-textarea>
                            <x-input-error :messages="$errors->get('article_content')" class="mt-2" />
                        </div>
                        <!-- Article Theme -->
                        <div class="mb-4">
                            <x-input-label for="theme_id" :value="__('Theme')" />
                            <select name="theme_id" id="theme_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Theme</option>
                                @foreach($themes as $theme)
                                <option value="{{ $theme->theme_id }}" {{ old('theme_id') == $theme->theme_id ? 'selected' : '' }}>{{ $theme->theme_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('theme_id')" class="mt-2" />
                        </div>

                        <!-- Thumbnail Image -->
                        <div class="mb-4">
                            <x-input-label for="article_thumbnail" :value="__('Article Thumbnail')" />
                            <input type="file" name="article_thumbnail" id="article_thumbnail" class="block mt-1 w-full" accept="image/*">
                            <x-input-error :messages="$errors->get('article_thumbnail')" class="mt-2" />
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