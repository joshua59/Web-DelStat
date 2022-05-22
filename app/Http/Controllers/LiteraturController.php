<?php

namespace App\Http\Controllers;

use App\Models\Literatur;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LiteraturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $literatur = Literatur::
            where('judul','like','%'.$request->keywords.'%')->
            paginate(10);
            return view('page.literatur.list', compact('literatur'));
        }
        return view('page.literatur.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.literatur.modal', ['literatur' => new Literatur]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'judul' => 'required|string',
                'penulis' => 'required',
                'tahun_terbit' => 'required|numeric|digits:4',
                'tag' => 'required',
                'file' => 'required|mimes:pdf'
            ]);
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada yang salah, silahkan coba lagi.',
            ]);
        }
        try {
            $file = request()->file('file')->store("file_literatur");
            $literatur = new Literatur;
            $literatur->judul = $request->judul;
            $literatur->penulis = $request->penulis;
            $literatur->tahun_terbit = $request->tahun_terbit;
            $literatur->tag = $request->tag;
            $literatur->id_user = Auth::user()->id;
            $literatur->file = $file;
            $literatur->save();
            return response()->json([
                'alert' => 'success',
                'message' => 'File '. $request->judul . ' telah ditambahkan',
            ]);
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada yang salah, silahkan coba lagi.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Literatur  $literatur
     * @return \Illuminate\Http\Response
     */
    public function show(Literatur $literatur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Literatur  $literatur
     * @return \Illuminate\Http\Response
     */
    public function edit(Literatur $literatur)
    {
        return view('page.literatur.modal', ['literatur' => $literatur]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Literatur  $literatur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Literatur $literatur)
    {
        try {
            if(request()->file('file')){
                Storage::delete($literatur->file);
                $file = request()->file('file')->store("file_literatur");
                $literatur->file = $file;
            }
            $literatur->judul = $request->judul;
            $literatur->penulis = $request->penulis;
            $literatur->tahun_terbit = $request->tahun_terbit;
            $literatur->tag = $request->tag;

            $literatur->update();
            return response()->json([
                'alert' => 'success',
                'message' => 'File '. $request->judul . ' telah di Update',
            ]);
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada kesalahan, silahkan coba lagi.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Literatur  $literatur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Literatur $literatur)
    {
        try {
            Storage::delete($literatur->file);
            $literatur->delete();
            return response()->json([
                'alert' => 'success',
                'message' => 'File '. $literatur->judul . ' Dihapus',
            ]);
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada kesalahan, silahkan coba lagi.',
            ]);
        }
    }
}
