<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::with(['publishers','authors'])->get();
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','unique:books','max:255'],
            'publisher_id' => ['required','exists:publishers,id'],
            'authors' => ['array','required'],
            'authors.*' => 'exists:authors,id',
        ]);

        $book = new Book;
        $book->title = $request->title;
        $book->save();

        $book->publishers()->attach($request->publisher_id);
        $book->authors()->attach($request->authors);

        return $book;
    }


    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => [
                'max:255',
                Rule::unique('books')->ignore($book->id)
            ],
            'authors' => 'array',
            'authors.*' => 'exists:authors,id',
        ]);

        $book->update($request->all());

        $book->authors()->sync($request->authors);

        return $book;
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        return $book->delete();
    }
}
