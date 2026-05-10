<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendBookMail;
use App\Models\Book;

class SendBookMailController extends Controller
{
    public function sendBook(Book $book)
    {
        $user = auth()->user();
    
        $book->load('category');
        Mail::to($user->email)->send(new SendBookMail($user->name, $book));
        return back()->with("success", "The Book Send Successfully");
    }
}