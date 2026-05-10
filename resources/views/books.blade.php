@extends("layouts.app")
@section("title", "Bibliothèque en ligne - Recherche")
@section("content")
    <!-- Main Content -->
    <main class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold text-gray-900">{{ __('messages.search_book') }}</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Left content (Filters) -->
                <aside class="col-span-1">
                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md space-y-8">
                        <h4 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-4">{{ __('messages.filter_books') }}</h4>

                        <div>
                            <h5 class="font-semibold text-gray-800 mb-3">{{ __('messages.categories') }}</h5>
                            <select id="category-filter"
                                    class="w-full bg-gray-50 border border-gray-300 rounded-md text-gray-800 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5"
                                >
                                <option value="">{{ __('messages.all_categories') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <h5 class="font-semibold text-gray-800 mb-3">Type</h5>
                            <div class="space-y-2">
                                @foreach ($types as $type)
                                    <label class="flex items-center text-gray-600">
                                        <input type="checkbox" value="{{ $type->id }}" name="types[]" class="type-filter"
                                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            {{ in_array($type->id, request('types', [])) ? 'checked' : '' }}>
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
                                        <input type="checkbox" value="{{ $tag->id }}" name="tags[]" class="tag-filter"
                                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            {{ in_array($tag->id, request('tags', [])) ? 'checked' : '' }}>
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
                            <select id="sort-filter"
                                class="bg-gray-50 border border-gray-300 rounded-md text-gray-800 focus:ring-blue-500 focus:border-blue-500 text-sm p-2">
                                <option value="">None</option>
                                <option value="designation" {{ request('sort') == 'designation' ? 'selected' : '' }}>{{ __('messages.book_title') }}</option>
                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date</option>
                                <option value="prix" {{ request('sort') == 'prix' ? 'selected' : '' }}>{{ __('messages.book_price') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @foreach ($books as $book)
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

                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        <nav class="flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <!-- Previous Button -->
                            @if ($books->onFirstPage())
                                <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $books->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif

                            <!-- Page Numbers -->
                            @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                                @if ($page == $books->currentPage())
                                    <span aria-current="page" class="relative z-10 inline-flex items-center px-4 py-2 border border-blue-500 bg-blue-50 text-sm font-medium text-blue-600">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach

                            <!-- Next Button -->
                            @if ($books->hasMorePages())
                                <a href="{{ $books->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const categoryFilter = document.getElementById('category-filter');
            const sortFilter = document.getElementById('sort-filter');
            const typeFilters = document.querySelectorAll('.type-filter');
            const tagFilters = document.querySelectorAll('.tag-filter');

            function updateFilters() {
                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                // Clear old filter params
                params.delete('category');
                params.delete('sort');
                params.delete('types[]');
                params.delete('tags[]');

                // Category
                if (categoryFilter.value) {
                    params.set('category', categoryFilter.value);
                }

                // Sort
                if (sortFilter.value) {
                    params.set('sort', sortFilter.value);
                }

                // Types (multiple)
                typeFilters.forEach(type => {
                    if (type.checked) {
                        params.append('types[]', type.value);
                    }
                });

                // Tags (multiple)
                tagFilters.forEach(tag => {
                    if (tag.checked) {
                        params.append('tags[]', tag.value);
                    }
                });

                // Reset page when filtering
                params.delete('page');

                window.location.search = params.toString();
            }

            // Events
            categoryFilter.addEventListener('change', updateFilters);
            sortFilter.addEventListener('change', updateFilters);

            typeFilters.forEach(type => {
                type.addEventListener('change', updateFilters);
            });

            tagFilters.forEach(tag => {
                tag.addEventListener('change', updateFilters);
            });

        });
    </script>
@endsection