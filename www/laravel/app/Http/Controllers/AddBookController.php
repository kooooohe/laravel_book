<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use DB;


class AddBookController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addbook(Request $request)
    {
        Book::create([
                       'name'   => $request->name,
                       'author' => $request->author
                    ]);
        return ["isSccess" => true];
    }
}
