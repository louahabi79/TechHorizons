<x-app-layout>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $article->article_title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <h2 class="font-bold text-2xl mb-4">
                         {{ $article->article_title }}
                      </h2>
                      @if($article->article_thumbnail)
                      <img src="{{ $article->article_thumbnail }}" alt="{{ $article->article_title }}" style="max-width: 200px;" class="mb-4"/>
                        @endif
                        <p> {{ $article->article_content }} </p>
                         @if($userRating)
                            <p class="mt-4">You rated this article: {{ $userRating->rating }} stars</p>
                        @endif
                        @if($averageRating)
                            <p class="mt-4">Average rating: {{ number_format($averageRating, 2) }} stars</p>
                         @endif
                     @if(auth()->check() && !$userRating)
                     <h3 class="mt-6 mb-2 font-semibold">Rate this article:</h3>
                    <form method="POST" action="{{ route('ratings.store') }}" class="mb-4">
                        @csrf
                         <input type="hidden" name="article_id" value="{{ $article->article_id }}">
                        <select name="rating" id="rating" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                           <option value="1">1 Star</option>
                             <option value="2">2 Stars</option>
                             <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                             <option value="5">5 Stars</option>
                       </select>
                      <x-primary-button class="ms-4">
                       Rate
                     </x-primary-button>
                   </form>
                @endif
                        <h3 class="mt-6 mb-2 font-semibold">Comments</h3>
                        <div id="messages-container">
                            @foreach ($article->comments as $comment)
                            <div class="p-4 border-gray-200 border-b relative">
                                <strong>{{ $comment->user->username }}:</strong>
                                <p> {{ $comment->content }} </p>
                                <small>{{ $comment->created_at }} </small>
                                @if(auth()->check())
                                    <button onclick="toggleMenu(this)" class="text-gray-600 hover:text-gray-900 focus:outline-none relative">
                                        ...
                                    </button>
                                    <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-md hidden options-menu">
                                        @if(auth()->user()->user_id === $comment->user_id)
                                            <a href="{{ route('comments.edit', ['comment' => $comment->id]) }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="block px-4 py-2 text-red-500 hover:bg-red-100 w-full text-left">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="#">
                                            @csrf
                                            <button class="block px-4 py-2 text-yellow-500 hover:bg-yellow-100 w-full text-left">
                                                Report
                                             </button>
                                         </form>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                     @if(auth()->check())
                     <h3 class="mt-6 mb-2 font-semibold">Add a comment</h3>
                     <form method="POST" action="{{ route('comments.store') }}"  class="mb-4" id="message-form">
                          @csrf
                             <input type="hidden" name="article_id" value="{{ $article->article_id }}">
                               <x-textarea id="content" class="block mt-1 w-full" name="content"  rows="4" required autocomplete="content"></x-textarea>
                               <x-input-error :messages="$errors->get('content')" class="mt-2" />
                              <x-primary-button class="ms-4">
                                    Comment
                              </x-primary-button>
                      </form>
                       @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>