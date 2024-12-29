<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($author->id !== null)
                {{ __('Edit author') }}
            @else
                {{ __('Create author') }}
           @endif
        </h2>
        <x-auth-session-status :status="session('status')" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
                    <form method="post" action="{{ route('author.update').(($author->id !== null)?'/'.$author->id:'') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $author->title)" required :autofocus="$errors->isEmpty()" autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $author->description)" required autocomplete="description" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <div>
                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $author->author)" required autocomplete="author" />
                            <x-input-error class="mt-2" :messages="$errors->get('author')" />
                        </div>

                        <div>
                            <x-input-label for="ISBN" :value="__('ISBN')" />
                            <x-text-input id="ISBN" name="ISBN" type="text" class="mt-1 block w-full" :value="old('ISBN', $author->ISBN)" required autocomplete="ISBN" :autofocus="$errors->get('ISBN')" />
                            <x-input-error class="mt-2" :messages="$errors->get('ISBN')" />
                        </div>

                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" type="text" class="form-control @error('category_id') is-invalid @enderror" name="category_id" value="{{ old('category_id') }}" required autocomplete="category">                                        
                                <option value=""></option>
                                @foreach ($categories as $category)                                        
                                    <option value="{{ $category->id }}" {{ ($author->category_id==$category->id)?"selected":"" }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('message') !== '')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 4000)"
                                    class="text-sm text-red-600"
                                >{{ session('message') }}</p>
                            @endif
                        </div>
                    </form>
                </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

