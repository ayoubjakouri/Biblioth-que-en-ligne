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

        // $data = $request->validated();
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $image = $request->file('cover');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('covers'), $imageName);
            // $data['cover'] = $imageName;
        }

        // Book::create($data);
        Book::create([
            'designation' => $request->designation,
            'auteur' =>$request->auteur,
            'editeur' =>$request->editeur,
            'prix' => $request->prix,
            'type' =>$request->type,
            'description' => $request->description,
            'cover' => $imageName
        ]);

        Log::info('Livre ajouter', ['Designation de Livre' => $request->designation]);

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
                unlink(public_path('covers/'. $book->cover));
            }
            $image = $request->file('cover');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('covers'), $imageName);
            $data['cover'] = $imageName;
        }

        $book->update($data);

        Log::info('Livre modifier', ['Designation de Livre' => $request->designation]);

        return redirect()->route('book.index')->with('success', 'Livre modifier avec succes.');
        

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
        $designation = $book->designation;
        $book->delete();

        Log::info('Livre supprime', ['Designation de Livre' => $designation]);

        return redirect()->route('book.index')->with('success','Livre supprime avec succes.');
    }
}
