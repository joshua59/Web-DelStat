<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MateriApiController extends Controller
{
    /**
     * Get a data of materi by its id.
     * The materi data ony stores link video of the related materi.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $materi = Materi::find($id);
        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'Link video retrieved successfully',
            ],
            'materi' => $materi,
        ]);
    }

    /**
     * Update existing materi data by its id.
     * Only updates the link video of the related materi.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        if(Auth::user()->role != 'Dosen') {
            return response()->json([
                'code' => 401,
                'message' => [
                    'value' => 'You are not authorized to access this resource.',
                ],
                'materi' => null,
            ]);
        }

        $validation = Validator::make($request->all(), [
            'link_video' => 'required|url',
        ]);

        if($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->errors(),
                'materi' => null,
            ]);
        }

        $materi = Materi::find($id);

        if(!$materi) {
            return response()->json([
                'code' => 404,
                'message' => [
                    'value' => 'Materi with that id is not found.',
                ],
                'materi' => null,
            ]);
        }

        $materi->link_video = $request->link_video;
        $materi->id_user = Auth::user()->id;
        $materi->save();

        return response()->json([
            'code' => 204,
            'message' => [
                'value' => 'Link video updated successfully',
            ],
            'materi' => $materi,
        ]);
    }
}
