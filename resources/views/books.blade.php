@extends("layouts.app")
@section("title", "Bibliothèque en ligne - Recherche")
@section("content")
    <!-- Main Content -->
    <main class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold text-gray-900">{{ __('messages.search_book') }}</h2>
            </div>

            <div class="mb-12">
                <livewire:book-filter />
            </div>
        </div>
    </main>
@endsection