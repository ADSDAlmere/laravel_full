<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
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
                    onclick="location.href='{{ route('book.create') }}';">
                    {{ __('Create book') }}
                </x-button>
                <div>&nbsp;</div>
                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <th class="border-r">@sortablelink('title', 'Title', ['parameter' => 'smile'],  ['rel' => 'nofollow'])</th>
                            <th class="border-r">@sortablelink('author.lastname', 'Author', ['parameter' => 'smile'],  ['rel' => 'nofollow'])</th>
                            <th class="border-r">Category</th>
                            <th class="border-r">@sortablelink('ISBN', 'ISBN', ['parameter' => 'smile'],  ['rel' => 'nofollow'])</th>
                            <th style="width: 200px;">Action</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($books as $book)
                            <tr>
                                <td class="border-r">{{ $book->title }}</td>
                                <td class="border-r">
                                    {{ $book->author->firstname }} {{ $book->author->lastname }}
                                </td>
                                <td class="border-r">
                                    @foreach ($book->categories as $category)
                                        {{ $category->name }}<BR>
                                    @endforeach
                                </td>
                                <td class="border-r">{{ $book->ISBN }}</td>
                                <td style="display:flex; flex-direction:row; justify-content: center;">
                                    <x-button onclick="location.href='{{ route('book.edit', $book) }}'">Edit</x-button>
                                    &nbsp;
                                    <form action="{{ route('book.destroy', $book) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit">Delete</x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
                {{ $books->appends(\Request::except('page'))->render() }}
            </div>
            </div>
        </div>
    </div>
</x-app-layout>

