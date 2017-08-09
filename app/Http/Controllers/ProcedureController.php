<?php

namespace App\Http\Controllers;

use App\Procedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProcedureController extends Controller
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
        return view('procs.list')->with('procs',Procedure::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('procs.create');
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
            'name' => 'required|unique:procedures,name|string|max:255',
            'price' => 'required|numeric|between:0,1000000000',
        ]);
        if ($validator->fails()) {
            return redirect('procedures/create')->withErrors($validator)->withInput();
        }
        Procedure::create([
            'name' => $request['name'],
            'price' => $request['price']
        ]);
        return redirect('/procedures');
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
        $proc = Procedure::find($id);
        if (Auth::user()->type == 1)
            Procedure::destroy($id);

        return redirect('/procedures');
    }
}
