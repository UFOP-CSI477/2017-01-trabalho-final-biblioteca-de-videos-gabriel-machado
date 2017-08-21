<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Camera;
use App\Video;
use App\Frame;

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

    public function video($id)
    {
        return view('library.vid')->with('vid',Video::find($id));
    }

    public function videoSeq($id)
    {
        return Frame::where('video_id','=',$id)->orderBy('seq')->get(['id'])->pluck('id');
    }
}
