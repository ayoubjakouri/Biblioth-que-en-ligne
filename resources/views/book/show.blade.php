@extends("layouts.app")
@section("title", "Bibliothèque en ligne - Détails du livre")
@section("content")
    <!-- Main Content -->
    <main class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Content (Book Details) -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md">
                        <div class="md:flex items-start">
                            <div class="shrink-0 mr-6 mb-4 md:mb-0">
                                <img class="w-48 h-auto object-cover rounded-md shadow-lg mx-auto"
                                    src="{{ asset('covers/'. $book->cover) }}" alt="Book Cover">
                            </div>
                            <div class="grow">
                                <h3 class="text-3xl font-bold text-gray-900">
                                    {{ old('designation', $book->designation) }}
                                </h3>
                                <ul class="mt-2 flex flex-wrap gap-x-4 gap-y-2 text-gray-500">
                                    <li>
                                        by
                                        {{ old('auteur', $book->auteur) }}
                                    </li>
                                    <li class="list-disc list-inside">
                                        {{ optional($book->type)->name ?? 'Type not specified' }}
                                    </li>
                                </ul>
                                @if($book->tags->count() > 0)
                                    <div class="mt-4">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($book->tags as $tag)
                                                <span class="inline-flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="mt-6 border-t border-gray-200 pt-6">
                                    <h4 class="text-xl font-semibold text-gray-800">Description</h4>
                                    <p class="mt-4 text-gray-600 leading-relaxed">

                                        {{ old('description', $book->description) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Book Overview) -->
                <aside class="col-span-1">
                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md">
                        <h4 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-4">Aperçu du livre</h4>
                        <ul class="mt-4 space-y-3 text-gray-600">
                            <li class="flex justify-between"><span>Date de création:</span> <span
                                    class="font-medium text-gray-900">{{ old('created_at', $book->created_at) }}</span></li>
                            <li class="flex justify-between"><span>Auteur:</span> <span
                                    class="font-medium text-gray-900">{{ old('auteur', $book->auteur) }}</span></li>
                            <li class="flex justify-between"><span>Editeur:</span> <span
                                    class="font-medium text-gray-900">{{ old('editeur', $book->editeur) }}</span></li>
                            <li class="flex justify-between"><span>Catégorie:</span> <span
                                    class="font-medium text-gray-900">{{ optional($book->category)->name ?? 'Not specified' }}</span>
                            </li>
                            <li class="flex justify-between"><span>Prix:</span> <span
                                    class="font-medium text-gray-900">{{ old('prix', $book->prix) }}</span></li>
                        </ul>
                        <div class="mt-6">
                            <a href="#"
                                class="w-full flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Acheter
                            </a>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection