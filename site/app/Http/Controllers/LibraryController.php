<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Camera;
use App\Video;
use App\Frame;
use App\VideoComment;

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

    public function camera($id, Request $request)
    {
        $vids = Video::where('camera_id','=',$id);
        if ($request['month']) {
            $vids = $vids->whereRaw("strftime('%m', `datetime`) = ?",[$request['month']]);
        }
        $vids->orderBy('datetime');
        return view('library.cam')->with('vids',$vids->get());
    }

    public function video($id)
    {
        return view('library.vid')->with('vid',Video::find($id));
    }

    public function videoSeq($id)
    {
        return Frame::where('video_id','=',$id)->orderBy('seq')->get(['id'])->pluck('id');
    }

    public function comment($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/library/video/' . $id);
        }
        VideoComment::create([
            'user_id' => Auth::user()->id,
            'video_id' => $id,
            'text' => $request['comment'],
        ]);
        return redirect('/library/video/' . $id);
    }

    public function delete_comment($id)
    {
        $c = VideoComment::find($id);
        if (Auth::user() == $c->user)
            VideoComment::destroy($id);

        return redirect('/library/video/' . $c->video_id);
    }
}
