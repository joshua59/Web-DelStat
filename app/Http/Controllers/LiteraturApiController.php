<?php

namespace App\Http\Controllers;

use App\Models\Literatur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LiteraturApiController extends Controller
{
    /**
     * Get all Literatur.
     * If any query parameter is passed, it will be used to filter the result.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $judul = null;
        $tag = null;
        $literatur = null;
        $message = null;

        if ($request->has('judul')) {
            $judul = $request->judul;
        }
        if ($request->has('tag')) {
            $tag = $request->tag;
        }

        if($judul != null && $tag != null) {
            $literatur = Literatur::getLiteraturByJudulAndTag($judul, $tag);
            $message = 'Literatur dengan judul ' . $judul . ' dan tag ' . $tag . ' diambil.';
        }
        if($judul != null && $tag == null) {
            $literatur = Literatur::getLiteraturByJudul($judul);
            $message = 'Literatur dengan judul ' . $judul . ' diambil.';
        }
        if($judul == null && $tag != null) {
            $literatur = Literatur::getLiteraturByTag($tag);
            $message = 'Literatur dengan tag ' . $tag . ' diambil.';
        }
        if($judul == null && $tag == null) {
            $literatur = Literatur::getAllLiteratur();
            $message = 'Semua literatur berhasil diambil.';
        }

        return response()->json([
            'code' => 200,
            'message' => $message,
            'literatur_list' => $literatur,
        ]);
    }

    /**
     * Get one data of Literatur by its id.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $literatur = Literatur::getLiteraturById($id);

        if (!$literatur) {
            return response()->json([
                'code' => 404,
                'message' => 'Literatur tidak ditemukan.',
                'literatur' => null,
            ]);
        }

        $user = User::find($literatur->id_user);
        $literatur->user = $user;
        return response()->json([
            'code' => 200,
            'message' => 'Literatur berhasil diambil.',
            'literatur' => $literatur,
        ]);
    }

    /**
     * Store a new Literatur.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == 'Siswa') {
            return response()->json([
                'code' => 401,
                'message' => 'You are not authorized to access this resource.',
                'literatur' => null,
            ]);
        }

        $validation = Validator::make($request->all(), [
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|numeric|digits:4',
            'tag' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,7z',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Validasi literatur gagal.',
                'errors' => $validation->errors(),
                'literatur' => null,
            ]);
        }

        /* Saving data */
        $literatur = new Literatur();
        $literatur->judul = $request->judul;
        $literatur->penulis = $request->penulis;
        $literatur->tahun_terbit = $request->tahun_terbit;
        $literatur->tag = $request->tag;
        $literatur->id_user = Auth::user()->id;

        /* Saving file to directory */
        $this->extracted($request, $literatur);
        /* End of saving file to directory */

        $literatur->save();
        /* End of saving data */

        /* Creating notification for Siswa to inform new Literatur added */
        NotifikasiApiController::newLiteratur($literatur);
        /* End of creating notification */

        return response()->json([
            'code' => 201,
            'message' => 'Literatur berhasil dibuat.',
            'literatur' => $literatur,
        ]);
    }

    /**
     * Update data of existing Literatur.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, Request $request)
    {
        if (Auth::user()->role == 'Siswa') {
            return response()->json([
                'code' => 401,
                'message' => 'You are not authorized to access this resource.',
                'literatur' => null,
            ]);
        }

        $validation = Validator::make($request->all(), [
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|numeric|digits:4',
            'tag' => 'required',
            'file' => 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,7z|nullable',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Validasi literatur gagal.',
                'errors' => $validation->errors(),
                'literatur' => null,
            ]);
        }

        $literatur = Literatur::find($id);

        if (!$literatur) {
            return response()->json([
                'code' => 404,
                'message' => 'Literatur tidak ditemukan.',
                'literatur' => null,
            ]);
        }

        $literatur->judul = $request->judul;
        $literatur->penulis = $request->penulis;
        $literatur->tahun_terbit = $request->tahun_terbit;
        $literatur->tag = $request->tag;
        $literatur->id_user = Auth::user()->id;

        // If user sends a new file, then the old file will be deleted and replaced with the new one
        if ($request->file('file')) {
            // Delete old file
            unlink($literatur->file);

            // Save new file
            // A thing that is known regards to updating file
            // It seems like that Laravel actually checks whether the file is the same or not
            // If it turns out to be the same file - even with different name - then it will not update the file
            $this->extracted($request, $literatur);
        }

        $literatur->save();

        return response()->json([
            'code' => 204,
            'message' => 'Literatur berhasil di-update.',
            'literatur' => $literatur,
        ]);
    }

    /**
     * Delete data of existing Literatur permanently.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        if (Auth::user()->role != 'Dosen') {
            return response()->json([
                'code' => 401,
                'message' => 'You are not authorized to access this resource.',
                'literatur' => null,
            ]);
        }

        $literatur = Literatur::find($id);

        if (!$literatur) {
            return response()->json([
                'code' => 404,
                'message' => 'Literatur tidak ditemukan.',
                'literatur' => null,
            ]);
        }

        unlink($literatur->file);
        $literatur->delete();

        return response()->json([
            'code' => 204,
            'message' => 'Literatur berhasil dihapus.',
            'literatur' => null,
        ]);
    }

    /**
     * This function is used to extract the file from the request and save it to a directory
     * Directory is /public/uploaded/literatur/{name_of_file}
     *
     * @param Request $request
     * @param $literatur
     * @return void
     */
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
