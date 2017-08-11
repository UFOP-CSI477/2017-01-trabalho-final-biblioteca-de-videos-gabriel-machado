<?php

namespace App\Http\Controllers;

use App\Test;
use App\Procedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('tests.list')->with('tests',Test::get()->sortBy('date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('tests.create')->with('procs',Procedure::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'procedure_id' => 'required|numeric|exists:procedures,id',
            'user_id' => 'numeric|exists:users,id',
            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('tests/create')->withErrors($validator)->withInput();
        }
        Test::create([
            'user_id' => Auth::user()->id,
            'procedure_id' => $request['procedure_id'],
            'date' => $request['date'],
        ]);
        return redirect('/tests');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $test = Test::find($id);
        if (Auth::user()->type == 1 or Auth::user()->id == $test->user_id) {
            Test::destroy($id);
            }

        return redirect('/tests');
    }
}
