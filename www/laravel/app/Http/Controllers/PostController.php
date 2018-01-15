<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;


class PostController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addbook(Request $request)
    {
        $book_model = new Book;
        $book_model->name = $request->name;
        $book_model->author = $request->author;
        $book_model->save();
        return [$request->name];
    }
}
