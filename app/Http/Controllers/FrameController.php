<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Frame;

class FrameController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function show($id)
    {
        $response = response(Frame::find($id)->video->first_frame->data, 200);
        $response->header('Content-Type', 'image/png');
        return $response;
    }
}
