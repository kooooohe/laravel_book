<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Auth;
use DB;


class AddJobController extends Controller {
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
    public function index(Request $request)
    {
        Job::create([
                       'title'          => $request->title,
                       'description'    => $request->description,
                       'deadline'      => $request->dead_line,
                       'yen'            => $request->yen,
                       'created_user_id' => Auth::id(),
                    ]);
        return ["isSccess" => true];
    }
}
