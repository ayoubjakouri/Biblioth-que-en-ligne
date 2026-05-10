@extends('emails.layout')
@section('title', 'Bibliothèque en ligne - Détails du livre')
@section('content')
    <div class="header">
        <h1 style="color: #4f46e5;">Bibliothèque en ligne - Détails du livre</h1>
    </div>
    <div class="content">
        <aside class="col-span-1">
            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md">
                <h4 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-4">Aperçu du livre</h4>
                <ul class="mt-4 space-y-3 text-gray-600">
                    <li class="flex justify-between"><span>{{ __('messages.book_title') }}:</span> <span class="font-medium text-gray-900">{{ $book->designation }}</span></li>
                    <li class="flex justify-between"><span>{{ __('messages.book_author') }}:</span> <span class="font-medium text-gray-900">{{ $book->auteur }}</span></li>
                    <li class="flex justify-between"><span>{{ __('messages.book_editor') }}:</span> <span class="font-medium text-gray-900">{{ $book->editeur }}</span></li>
                    <li class="flex justify-between"><span>{{ __('messages.book_category') }}:</span> <span class="font-medium text-gray-900">{{ optional($book->category)->name ?? 'Not specified' }}</span></li>
                    <li class="flex justify-between"><span>{{ __('messages.book_price') }}:</span> <span class="font-medium text-gray-900">${{ $book->prix }}</span></li>
                </ul>
            </div>
        </aside>
    </div>
@endsection