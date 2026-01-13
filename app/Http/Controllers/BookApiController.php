<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Book;

class BookApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('Books list requested');

        return response()->json(Book::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Create book request', $request->all());


        $book = Book::create($request->all());

        Log::info('Book created', ['book_id' => $book->id]);

        return response()->json([
            'message' => 'Book created',
            'data' => $book
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Log::info('Show book', ['id' => $id]);

        $book = Book::findOrFail($id);

        if (!$book) {
            Log::warning('Book not found', ['id' => $id]);
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('Update book request', [
            'id' => $id,
            'data' => $request->all()
        ]);

        $book = Book::find($id);

        if (!$book) {
            Log::error('book not found', ['id' => $id]);

            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->all());

        Log::info('Book updated', ['id' => $book->id]);

        return response()->json([
            'message' => 'Book updated',
            'data' => $book
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Log::info('Delete book request', ['id' => $id]);

        $book = Book::find($id);

        if (!$book) {
            Log::warning('Delete failed - book not found', ['id' => $id]);

            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        Log::info('Book deleted', ['id' => $id]);

        return response()->json(['message' => 'Book deleted']);
    }
}
