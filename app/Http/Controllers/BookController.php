<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBookRequest;

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

        $data = $request->validated();
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $image = $request->file('cover');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('covers'), $imageName);
            $data['cover'] = $imageName;
        }

        Book::create($data);

        return redirect()->route('book.index')->with('success', 'Livre ajoute avec succes.');


        // $book = new Book();

        // $book->designation = $request->input('designation');
        // $book->auteur = $request->input('auteur');
        // $book->prix = $request->input('prix');
        // $book->type = $request->input('type');
        // $book->description = $request->input('description');
        // $book->editeur = $request->input('editeur');
        // $book->annee = $request->input('annee');

        // if($request->hasFile('cover') && $request->file('cover')->isValid()){
        //     $image = $request->file('cover');
        //     $imageName = time() . '_' . $image->getClientOriginalName();
        //     $image->move(public_path('covers'), $imageName);
        //     $book->cover = $imageName;
        // }


        // $book->save();

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
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            if($book->cover && file_exists(public_path('covers/'.$book->cover))){
                @unlink(public_path('covers/'. $book->cover));
            }
            $image = $request->file('cover');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('covers'), $imageName);
            $data['cover'] = $imageName;
        }

        $book->update($data);

        return redirect()->route('book.index')->with('success', 'Livre ajoute avec succes.');
        
        // $book->update([
        //     $request->input('designation'),
        //     $request->input('auteur'),
        //     $request->input('prix'),
        //     $request->input('type'),
        //     $request->input('description'),
        //     $request->input('editeur'),
        //     $request->input('annee')
        // ]);

        // if($request->hasFile('cover') && $request->file('cover')->isValid()){
        //     $image = $request->file('cover');
        //     $imageName = time() . '_' . $image->getClientOriginalName();
        //     $image->move(public_path('covers'), $imageName);
        //     $book->cover = $imageName;
        // }


        // $book->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if($book == null){
            return redirect()->back()->with('error', 'le livre n\'existe pas.');
        };
        if($book->cover && $book->cover != 'no_cover.jpg'){
            if(file_exists(public_path('covers/'.$book->cover)))
                unlink(public_path('covers/'. $book->cover));
        }
        $book->delete();
        return redirect()->route('book.index')->with('success','Livre supprime avec succes.');
    }
}
