<x-app-layout>
    <script src="{{ asset('js/app.js') }}"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Themes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('themes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create Theme</a>

                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($themes as $theme)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap"> {{ $theme->theme_name }} </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap"> {{ $theme->theme_description }} </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                      Edit
                                     </a>
                                      <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                         Delete
                                      </a>
                                   <form method="POST" action="{{ route('subscriptions.store') }}" id="subscription-form-{{$theme->theme_id}}">
                                      @csrf
                                        <input type="hidden" name="theme_id" value="{{ $theme->theme_id }}" />
                                        <button type="submit" id="subscription-button-{{$theme->theme_id}}"
                                            class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded subscription-button" >
                                         @if (in_array($theme->theme_id, $subscribedThemeIds))
                                            Unsubscribe
                                          @else
                                           Subscribe
                                          @endif
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
</x-app-layout>