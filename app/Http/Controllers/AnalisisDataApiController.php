<?php

namespace App\Http\Controllers;

use App\Models\AnalisisData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnalisisDataApiController extends Controller
{
    /**
     * Get all Analisis Data by authenticating user's role
     * If user is Dosen, get all Analisis Data that exists.
     * If user is Siswa, get all Analisis Data that exists and belongs to that user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (Auth::user()->role == 'Dosen') {
            $analisisData = AnalisisData::getAllAnalisisData();
            return response()->json([
                'code' => 200,
                'message' => 'Semua analisis data berhasil diambil',
                'listAnalisisData' => $analisisData,
            ]);
        }

        $analisisData = AnalisisData::getAllAnalisisDataPrivate(Auth::user()->id);
        return response()->json([
            'code' => 200,
            'message' => 'Semua analisis data berhasil diambil',
            'listAnalisisData' => $analisisData,
        ]);
    }

    /**
     * Create new Analisis Data
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            /* 'file' => 'required|file|mimes:pdf,xlsx,xls,doc,docx,ppt,pptx,zip,rar,7z,r,txt,csv', */
            'file' => 'required|file|mimes:pdf,xlsx,xls,doc,docx,zip,rar,txt,csv',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Validasi analisis data gagal.',
                'errors' => $validation->errors(),
                'analisisData' => null,
            ]);
        }

        /* Saving data */
        $analisisData = new AnalisisData();
        $analisisData->judul = $request->judul;
        $analisisData->deskripsi = $request->deskripsi;
        $analisisData->id_user = Auth::user()->id;

        /* Saving file */
        $this->extracted($request, $analisisData);
        /* End of saving file */

        $analisisData->save();
        /* End of saving data */

        /* Creating notification for Dosen */
        NotifikasiApiController::newAnalisisData($analisisData);
        /* End of creating notification for Dosen */

        return response()->json([
            'code' => 200,
            'message' => 'Analisis data berhasil ditambahkan.',
            'analisisData' => $analisisData,
        ]);
    }

    /**
     * Show detail of certain Analisis Data by its id
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $analisisData = AnalisisData::getAnalisisDataById($id);

        // If the data doesn't exist then return 404
        if (!$analisisData) {
            return response()->json([
                'code' => 404,
                'message' => 'Analisis data tidak ditemukan.',
                'analisisData' => null,
            ]);
        }

        // If the data exists but the user doesn't have access to it then return 403
        if (Auth::user()->role == 'Siswa' && $analisisData->id_user != Auth::user()->id) {
            return response()->json([
                'code' => 403,
                'message' => 'Forbidden',
                'analisisData' => null,
            ]);
        }

        $user = User::find($analisisData->id_user);
        $analisisData->user = $user;
        // If the data exists and the user has access to it then return 200 with the data
        return response()->json([
            'code' => 200,
            'message' => 'Analisis data berhasil diambil.',
            'analisisData' => $analisisData,
        ]);
    }

    /**
     * Update Analisis Data by its id
     * The field that can be updated is only deskripsi field.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $validation = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'file' => 'file|mimes:pdf,xlsx,xls,doc,docx,zip,rar,txt,csv|nullable',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Validasi analisis data gagal.',
                'errors' => $validation->errors(),
                'analisisData' => null,
            ]);
        }

        $analisisData = AnalisisData::find($id);

        // If the data doesn't exist then return 404
        if (!$analisisData) {
            return response()->json([
                'code' => 404,
                'message' => 'Analisis data tidak ditemukan.',
                'analisisData' => null,
            ]);
        }

        // If the data exists but the user doesn't have access to it then return 403
        if (Auth::user()->role == 'Siswa' && $analisisData->id_user != Auth::user()->id) {
            return response()->json([
                'code' => 403,
                'message' => 'Forbidden',
                'analisisData' => null,
            ]);
        }

        // If the data exists and the user has access to it then update the data
        $analisisData->judul = $request->judul;
        $analisisData->deskripsi = $request->deskripsi;

        // If user sends a new file, then the old file will be deleted and replaced with the new one
        if ($request->hasFile('file')) {
            // Delete the old file
            unlink($analisisData->file);

            // Save the new file
            $this->extracted($request, $analisisData);
        }

        $analisisData->save();

        return response()->json([
            'code' => 204,
            'message' => 'Analisis data berhasil di-update.',
            'analisisData' => $analisisData,
        ]);
    }

    /**
     * Update Status of Analisis Data by its id
     * This can only by done by User with role Dosen and Admin.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, int $id)
    {
        if(Auth::user()->role == 'Siswa') {
            return response()->json([
                'code' => 403,
                'message' => 'Forbidden',
                'analisisData' => null,
            ]);
        }

        // Role 'Dosen' and 'Admin' can update status
        $analisisData = AnalisisData::find($id);
        if (!$analisisData) {
            return response()->json([
                'code' => 404,
                'message' => 'Analisis data tidak ditemukan.',
                'analisisData' => null,
            ]);
        }

        $analisisData->status = $request->status;
        $analisisData->save();

        return response()->json([
            'code' => 204,
            'message' => 'Status analisis data berhasil di-update.',
            'analisisData' => $analisisData,
        ]);
    }

    /**
     * Change the status of the Analisis Data by its id
     * Change the status from "Dipesan" to "Dibatalkan"
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelOrderAnalisisData(int $id)
    {
        $analisisData = AnalisisData::find($id);

        // If the data doesn't exist then return 404
        if (!$analisisData) {
            return response()->json([
                'code' => 404,
                'message' => 'Analisis data tidak ditemukan.',
                'analisisData' => null,
            ]);
        }

        // If the data exists but the user doesn't have access to it then return 403
        if (Auth::user()->role == 'Siswa' && $analisisData->id_user != Auth::user()->id) {
            return response()->json([
                'code' => 403,
                'message' => 'Forbidden',
                'analisisData' => null,
            ]);
        }

        // If the data exists and the user has access to it then update the data to cancel the order
        $analisisData->status = "Dibatalkan";
        $analisisData->save();

        return response()->json([
            'code' => 200,
            'message' => 'Analisis data berhasil dibatalkan.',
            'analisisData' => $analisisData,
        ]);
    }

    /**
     * This function is used to extract the file from the request and save it to a directory
     * Directory is /public/uploaded/analisis_data/{name_of_file}
     *
     * @param Request $request
     * @param $analisisData
     * @return void
     */
    public function extracted(Request $request, $analisisData): void
    {
        $file = $request->file('file');
        $fileExtension = $file->getClientOriginalExtension();
        $judulWithoutSpace = preg_replace('/\s+/', '', $request->judul);
        $fileName = $judulWithoutSpace . '-' . date("d-m-Y_H-i-s") . '.' . $fileExtension;
        $file->move(AnalisisData::$FILE_DESTINATION, $fileName);

        $analisisData->file = AnalisisData::$FILE_DESTINATION . '/' . $fileName;
    }
}
