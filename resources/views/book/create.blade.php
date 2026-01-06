@extends('layouts.app')
@section('title', 'Ajouter livre')
@section('content')

    <!-- Main Content -->
    <main class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold text-gray-900">Ajouter un nouveau livre.</h2>
            </div>
            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Form -->
            <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-lg max-w-[800px] mx-auto">
                <form class="space-y-6" action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="designation" class="sr-only">Désignation</label>
                            <input type="text" name="designation" id="designation" class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Désignation">
                        </div>
                        <div>
                            <label for="type" class="sr-only">Type</label>
                            <input type="text" name="type" id="type" class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="langue" class="sr-only">Langue</label>
                            <input type="text" name="langue" id="langue" class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Langue">
                        </div>
                        <div>
                            <label for="editeur" class="sr-only">Editeur</label>
                            <input type="text" name="editeur" id="editeur" class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Editeur">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="categorie" class="sr-only">Catégorie</label>
                            <input type="text" name="categorie" id="categorie" class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Catégorie">
                        </div>
                        <div>
                            <label for="prix" class="sr-only">Prix</label>
                            <input type="text" name="prix" id="prix" class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Prix">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="auteur" class="sr-only">Auteur</label>
                            <input type="text" name="auteur" id="auteur" class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Auteur">
                        </div>
                        <div>
                            <label for="cover" class="sr-only">Cover</label>
                            <input type="file" name="cover" id="cover" class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="description" class="sr-only">Description</label>
                        <textarea id="description" name="description" rows="8" class="w-full px-4 py-3 rounded-md bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Description ..."></textarea>
                    </div>
                    <div>
                        <button type="submit" class="px-6 py-3 cursor-pointer border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection