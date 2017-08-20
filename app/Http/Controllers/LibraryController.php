<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Camera;

class LibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('library.main');
    }


    public function camera($id)
    {
        return view('library.cam')->with('cam',Camera::find($id));
    }
}
