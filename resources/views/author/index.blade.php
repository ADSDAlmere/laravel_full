<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('authors') }}
        </h2>
        <x-auth-session-status :status="session('status')" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                
                @if (session('message') !== '')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 4000)"
                        class="text-sm text-red-600"
                    >{{ session('message') }}</p>
                @endif

                <x-button class="mt-3"
                    onclick="location.href='{{ route('author.create') }}';">
                    {{ __('Create author') }}
                </x-button>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th style="width: 200px;">Action</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->title }}</td>
                                <td>{{ $author->author }}</td>
                                <td>{{ $author->ISBN }}</td>
                                <td style="display:flex; flex-direction:row; justify-content: center;">
                                    <x-button onclick="location.href='{{ route('author.edit', $author) }}'">Edit</x-button>
                                    &nbsp;
                                    <form action="{{ route('author.destroy', $author) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit">Delete</x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
                {{ $authors->links() }}
            </div>
            </div>
        </div>
    </div>
</x-app-layout>

