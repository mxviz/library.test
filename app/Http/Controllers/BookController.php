<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['publishers','authors'])->paginate(5);

        return view('books_list',['books' => $books]);
    }
}
