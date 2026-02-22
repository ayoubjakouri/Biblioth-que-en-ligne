@extends('layouts.app')
@section('title', 'Ajouter livre')
@section('content')

    <!-- Main Content -->
    <main class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold text-gray-900">Ajouter un nouveau livre.</h2>
            </div>
            <!-- Form -->
            <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-lg max-w-[800px] mx-auto">
                <form class="space-y-6" action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="designation" class="sr-only">Désignation</label>
                            <input type="text" name="designation" id="designation"
                                class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Désignation">
                            @error('designation')
                                <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <select name="type_id"
                                class="w-full bg-gray-50 border border-gray-300 rounded-md text-gray-800 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5">
                                <option value="">Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="langue" class="sr-only">Langue</label>
                            <input type="text" name="langue" id="langue"
                                class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Langue">
                            @error('langue')
                                <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="editeur" class="sr-only">Editeur</label>
                            <input type="text" name="editeur" id="editeur"
                                class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Editeur">
                            @error('editeur')
                                <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <select name="category_id"
                                class="w-full bg-gray-50 border border-gray-300 rounded-md text-gray-800 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5">
                                <option value="">Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="prix" class="sr-only">Prix</label>
                            <input type="text" name="prix" id="prix"
                                class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Prix">
                            @error('prix')
                                <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="auteur" class="sr-only">Auteur</label>
                            <input type="text" name="auteur" id="auteur"
                                class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Auteur">
                            @error('auteur')
                                <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                            @enderror

                        </div>
                        <div>
                            <div class="flex flex-wrap items-center border border-gray-300 rounded-md p-2 space-x-2">
                                <div id="tags-container" class="flex flex-wrap items-center gap-2">
                                    <!-- Tags will be dynamically added here -->
                                </div>
                                <input id="tag-input" type="text" placeholder="Add a tag..."
                                    class="flex-1 border-none outline-none focus:ring-0" />
                                <input id="hidden-input" type="hidden" name="tags" />
                            </div>
                            <p id="error-message" class="mt-2 text-sm text-red-500 hidden">You can only add up to 5 tags.
                            </p>
                        </div>

                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="cover" class="sr-only">Cover</label>
                            <input type="file" name="cover" id="cover"
                                class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        @error('cover')
                            <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <label for="description" class="sr-only">Description</label>
                        <textarea id="description" name="description" rows="8"
                            class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Description ..."></textarea>
                        @error('description')
                            <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="px-6 py-3 cursor-pointer border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const input = document.getElementById('tag-input');
            const tagsContainer = document.getElementById('tags-container');
            const errorMessage = document.getElementById('error-message');
            const hiddenInput = document.getElementById('hidden-input');
            let tags = [];

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' && input.value.trim() !== '') {
                    event.preventDefault();
                    const newTag = input.value.trim();
                    if (tags.length >= 5) {
                        // Show error if the tag limit is exceeded
                        errorMessage.classList.remove('hidden');
                        return;
                    } else {
                        errorMessage.classList.add('hidden');
                    }

                    if (!tags.includes(newTag)) {
                        tags.push(newTag);
                        renderTags();
                    }
                    input.value = '';
                }
            });

            const renderTags = () => {
                tagsContainer.innerHTML = '';
                tags.forEach((tag, index) => {
                    const tagElement = document.createElement('div');
                    tagElement.className = 'flex items-center bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-sm';
                    tagElement.innerHTML = `
                                        <span>${tag}</span>
                                        <button
                                          type="button"
                                          class="ml-2 text-blue-500 hover:text-blue-700"
                                          onclick="removeTag(${index})"
                                        >
                                          &times;
                                        </button>
                                      `;
                    tagsContainer.appendChild(tagElement);

                });
                hiddenInput.value = tags.join(',');

            };

            const removeTag = (index) => {
                tags.splice(index, 1);
                renderTags();
                errorMessage.classList.add('hidden'); // Hide error message if a tag is removed
            };



        </script>
    </main>

@endsection