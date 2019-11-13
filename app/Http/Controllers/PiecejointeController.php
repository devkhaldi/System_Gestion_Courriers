<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Piecejointe;
use App\Courrier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PiecejointeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        if (Auth::user()->type == "emp") {
            // update consultations status to 'vue'
            DB::table('consultations')
                ->where([['courrier_id', '=', $id], ['user_id', '=', Auth::user()->id]])
                ->update(['status' => 'vue']);
        }
        return Courrier::find($id)->piecejointes;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($courrier_id)
    {
        return view('admin.piecejointe', ['courrier_id' => $courrier_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        /*
        $file = $request->file('file');
        File::create([
            'title' => $file->getClientOriginalName(),
            'description' => 'Uploaded with dropzone',
            'path' => $file->store('public/storage/piecejointe')
        ]);
            
        $pj = new Piecejointe();
        $pj->user_id = $user_id;
        if ($request->hasFile('file')) {
            $pj->fichier = $request->file->store('piecejointe');
        }
        $pj->save();
*/

        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }

        $file = Input::file('file');

        $extension = File::extension($file['name']);
        $directory = path('public') . 'uploads/' . sha1(time());
        $filename = sha1(time() . time()) . ".{$extension}";

        $upload_success = Input::upload('file', $directory, $filename);

        if ($upload_success) {
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
