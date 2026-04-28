<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Type;
use App\Models\Tag;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        Log::info("Livres : $books");

        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $types = Type::all();
        return view('book.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {


        $data = $request->validated();

        $data['cover'] = $this->uploadCover($request);

        $book = Book::create($data);

        $tagsId = $this->saveTags($request->input('tags', ''));

        $book->tags()->sync($tagsId);

        Log::info('Livre ajouté', [
            'designation' => $request->designation
        ]);

        return redirect()
            ->route('book.index')
            ->with('success', 'Livre ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        $types = Type::all();
        return view('book.edit', compact('book', 'categories', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        $data['cover'] = $this->uploadCover($request, $book->cover);

        $book->update($data);

        $tagsId = $this->saveTags($request->input('tags', ''));

        $book->tags()->sync($tagsId);


        Log::info('Livre modifié', [
            'id' => $book->id,
            'designation' => $book->designation
        ]);

        return redirect()
            ->route('book.index')
            ->with('success', 'Livre modifié avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover && file_exists(public_path('covers/' . $book->cover))) {
            unlink(public_path('covers/' . $book->cover));
        }

        Log::info('Livre supprimé', [
            'id' => $book->id,
            'designation' => $book->designation
        ]);

        $book->delete();

        return redirect()
            ->route('book.index')
            ->with('success', 'Livre supprimé avec succès.');
    }

    public function catalog(Request $request)
    {
        $categories = Category::all();
        $types = Type::all();
        $tags = Tag::all();

        $query = Book::query()->with('tags');

         // Filter by category
        if ($request->input('text')) {
            $query->where('designation','like', "%{$request->input('text')}%");
        }

        // Filter by category
        if ($request->input('type')) {
            $query->where('type_id', $request->input('type'));
        }

        // Filter by category
        if ($request->input('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Filter by types
        if ($request->has('types') && is_array($request->input('types'))) {
            $query->whereIn('type_id', $request->input('types'));
        }

        // Filter by tags
        if ($request->has('tags') && is_array($request->input('tags'))) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->whereIn('tag_id', $request->input('tags'));
            });
        }

        // Sort
        if ($request->input('sort')) {
            switch ($request->input('sort')) {
                case "designation":
                    $query->orderBy('designation');
                    break;
                case "created_at":
                    $query->orderBy('created_at');
                    break;
                case "prix":
                    $query->orderBy('prix');
                    break;
            }
        }

        $books = $query->paginate(10)->withQueryString();

        return view('books', compact('books', 'categories', 'types', 'tags'));
    }

    public function home(Request $request)
    {
        $categories = Category::all();
        $types = Type::all();
        $tags = Tag::all();

        $query = Book::query()->with('tags');

        // Filter by category
        if ($request->input('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Filter by types
        if ($request->has('types') && is_array($request->input('types'))) {
            $query->whereIn('type_id', $request->input('types'));
        }


        return view('index', compact( 'categories', 'types'));
    }
    


    private function uploadCover(Request $request, $oldCover = null)
    {
        if ($request->hasFile('cover')) {

            $image = $request->file('cover');

            if ($image && $image->isValid()) {

                // Delete old cover (if exists and not default)
                if (
                    $oldCover && $oldCover !== 'no_cover.jpg' &&
                    file_exists(public_path('covers/' . $oldCover))
                ) {

                    unlink(public_path('covers/' . $oldCover));
                }

                $imageName = time() . '_' . uniqid() . '.' . $image->extension();

                $image->move(public_path('covers'), $imageName);

                return $imageName;
            }
        }

        return $oldCover ?? 'no_cover.jpg';
    }

    private function saveTags($tags)
    {
        // Handle both string and array inputs
        if (is_array($tags)) {
            $tagsArray = $tags;
        } else {
            $tagsArray = explode(",", $tags ?? '');
        }

        $tagsId = [];

        foreach ($tagsArray as $tag) {
            $tag = trim($tag);

            if (empty($tag)) {
                continue;
            }

            $tagSaved = Tag::firstOrCreate([
                "name" => $tag
            ]);

            $tagsId[] = $tagSaved->id;
        }

        return $tagsId;
    }
}
