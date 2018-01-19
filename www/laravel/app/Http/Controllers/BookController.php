<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Book;
use App\Models\User;
use App\Models\BookLendHistory;

use Carbon\Carbon;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->name) {
            $books  = Book::where('name', 'like', '%'. $request->name . '%')->get();
        } else {
            $books  = Book::all();
        }
        return $books->toArray();
    }

    /**
     * update book and bookLendHistory table
     *
     * @param  int  $book_id
     * @return \Illuminate\Http\Response
     */
    public function lend(Request $request, $book_id)
    {
        $this->middleware('auth');

        $now         = Carbon::now();
        $user_id     = Auth::id();
        $target_book = Book::find($book_id);

        //if it is lend already, do nothing
        if (!$target_book->is_lend) {
            $target_book->is_lend   = true;
            $target_book->user_id   = $user_id;
            $target_book->lend_date = $now;
            $target_book->save();

            //recode
            BookLendHistory::create([
                'user_id'   => $user_id,
                'book_id'   => $book_id,
                'lend_date' => $now,
            ]);
        }
        return $book_id;
    }

    /**
     * update book and bookLendHistory table
     *
     * @param  int  $book_id
     * @return \Illuminate\Http\Response
     */
    public function returnBook($book_id)
    {
        $this->middleware('auth');

        $now         = Carbon::now();
        $user_id     = Auth::id();
        $target_book = Book::find($book_id);

        //if it is return already, do nothing
        if ($target_book->is_lend) {
            $target_book->is_lend   = false;
            $target_book->user_id   = null;
            $target_book->lend_date = null;
            $target_book->save();

            //recode
            $book_history = BookLendHistory::where([
                ['user_id', $user_id],
                ['book_id',  $book_id],
            ])
                ->whereNull('return_date')
                ->first();

                $book_history->return_date = $now;
                $book_history->save();
        }
        return $book_id;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
