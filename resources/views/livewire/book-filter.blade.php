<div>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        <!-- Left content (Filters) -->
        <aside class="col-span-1">
            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md space-y-8">
                <h4 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-4">{{ __('messages.filter_books') }}</h4>

                <!-- Search Input -->
                <div>
                    <h5 class="font-semibold text-gray-800 mb-3">{{ __('messages.search_book') }}</h5>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('messages.search_book') }}..."
                           class="w-full bg-gray-50 border border-gray-300 rounded-md text-gray-800 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5">
                </div>

                <div>
                    <h5 class="font-semibold text-gray-800 mb-3">{{ __('messages.categories') }}</h5>
                    <select wire:model.live="category" id="category-filter"
                            class="w-full bg-gray-50 border border-gray-300 rounded-md text-gray-800 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5"
                        >
                        <option value="">{{ __('messages.all_categories') }}</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <h5 class="font-semibold text-gray-800 mb-3">Type</h5>
                    <div class="space-y-2">
                        @foreach ($types as $type)
                            <label class="flex items-center text-gray-600">
                                <input type="checkbox" wire:model.live="selectedTypes" value="{{ $type->id }}" 
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2">{{ __("messages.$type->name") }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h5 class="font-semibold text-gray-800 mb-3">{{ __('messages.tags') }}</h5>
                    <div class="space-y-2">
                        @foreach ($tags as $tag)
                            <label class="flex items-center text-gray-600">
                                <input type="checkbox" wire:model.live="selectedTags" value="{{ $tag->id }}"
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

            </div>
        </aside>

        <!-- Right content (Book List) -->
        <div class="col-span-1 lg:col-span-3">
            <div
                class="flex items-center justify-between mb-6 bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <span class="text-gray-600">{{ $books->total() }} {{ __('messages.books_found') }}</span>
                <div class="flex items-center">
                    <span class="text-gray-600 mr-2">{{ __('messages.sort_by') }}:</span>
                    <select wire:model.live="sort" id="sort-filter"
                        class="bg-gray-50 border border-gray-300 rounded-md text-gray-800 focus:ring-blue-500 focus:border-blue-500 text-sm p-2">
                        <option value="">None</option>
                        <option value="designation">{{ __('messages.book_title') }}</option>
                        <option value="created_at">Date</option>
                        <option value="prix">{{ __('messages.book_price') }}</option>
                    </select>
                </div>
            </div>

            <div class="space-y-6" wire:loading.class="opacity-50">
                @forelse ($books as $book)
                    <!-- Single Book Item -->
                    <div
                        class="bg-white rounded-lg p-4 flex items-center justify-between border border-gray-200 shadow-sm hover:shadow-lg transition">
                        <div class="flex items-center">
                            <img src="{{ asset('covers/' . $book->cover) }}" alt="Book Cover"
                                class="w-20 h-auto object-cover rounded-md mr-4">
                            <div>
                                <a href="{{ route("book.show", $book) }}"
                                    class="text-lg font-semibold text-gray-900 hover:text-blue-600">{{ $book->designation }}</a>
                                <ul class="flex flex-wrap gap-x-4 text-sm text-gray-700 mt-1">
                                    <li>{{ $book->type->name }}</li>
                                    <li>{{ __('messages.by') }} {{ $book->auteur }}</li>
                                </ul>
                                <div class="mt-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($book->tags as $tag)
                                        <span class="inline-flex items-center bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route("book.show", $book) }}" class="text-blue-600 hover:underline">{{ __('messages.book_details') }}</a>
                            <span class="block text-lg font-semibold text-gray-900 mt-1">${{ $book->prix }}</span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-8 rounded-lg border border-gray-200 text-center text-gray-500">
                        {{ __('No books found.') }}
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>
