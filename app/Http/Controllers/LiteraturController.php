<?php

namespace App\Http\Controllers;

use App\Models\Literatur;
use Exception;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('page.literatur.modal', ['literatur' => new Literatur]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'judul' => 'required|string',
                'penulis' => 'required',
                'tahun_terbit' => 'required|numeric|digits:4',
                'tag' => 'required',
                'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,7z'
            ]);
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada yang salah, silahkan coba lagi.',
            ]);
        }
        try {
            $literatur = new Literatur;
            $literatur->judul = $request->judul;
            $literatur->penulis = $request->penulis;
            $literatur->tahun_terbit = $request->tahun_terbit;
            $literatur->tag = $request->tag;
            $literatur->id_user = Auth::user()->id;
            $this->extracted($request, $literatur);
            $literatur->save();
            NotifikasiApiController::newLiteratur($literatur);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Literatur $literatur)
    {
        try {
            if(request()->file('file')){
                if(file_exists($literatur->file)){
                    unlink($literatur->file);
                }
                $this->extracted($request, $literatur);
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
     * @return \Illuminate\Http\JsonResponse
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

    public function extracted(Request $request, $literatur): void
    {
        $file = $request->file('file');
        $fileExtension = $file->getClientOriginalExtension();
        $judulWithoutSpace = preg_replace('/\s+/', '', $request->judul);
        $fileName = $judulWithoutSpace . '-' . date("d-m-Y_H-i-s") . '.' . $fileExtension;
        $file->move(Literatur::$FILE_DESTINATION, $fileName);

        $literatur->file = Literatur::$FILE_DESTINATION . '/' . $fileName;
    }
}
