<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Issues') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <a href="{{ route('issues.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create Issue</a>

                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Title
                                </th>
                                 <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   Publication Date
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Is Public
                                </th>
                                 <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                     Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($issues as $issue)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                   <p class="text-gray-900 whitespace-no-wrap"> {{ $issue->title }} </p>
                                </td>
                                 <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                   <p class="text-gray-900 whitespace-no-wrap"> {{ $issue->publication_date }} </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap"> {{ $issue->is_public ? 'Public' : 'Private' }} </p>
                                </td>
                                 <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                       <a href="{{ route('issues.edit', ['issue' => $issue->issue_id]) }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                            Edit
                                       </a>
                                          <form method="POST" action="{{ route('issues.destroy', ['issue' => $issue->issue_id]) }}" class="inline-block">
                                               @csrf
                                              @method('DELETE')
                                              <button  class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this issue?');">
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
</x-app-layout>