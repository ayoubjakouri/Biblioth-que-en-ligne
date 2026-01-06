<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // $imageName = $this->uploadCover($request);

        // Book::create([
        //     'designation' => $request->designation,
        //     'auteur' => $request->auteur,
        //     'editeur' => $request->editeur,
        //     'prix' => $request->prix,
        //     'type' => $request->type,
        //     'langue' => $request->langue,
        //     'categorie' => $request->categorie,
        //     'description' => $request->description,
        //     'cover' => $imageName
        // ]);

        $data = $request->validated();

        $data['cover'] = $this->uploadCover($request);

        Book::create($data);

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
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        $data['cover'] = $this->uploadCover($request, $book->cover);

        $book->update($data);

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


    private function uploadCover(Request $request, $oldCover = null)
    {
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {


            if ($oldCover && file_exists(public_path('covers/' . $oldCover))) {
                unlink(public_path('covers/' . $oldCover));
            }

            $image = $request->file('cover');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('covers'), $imageName);

            return $imageName;
        }

        return $oldCover;
    }
}
