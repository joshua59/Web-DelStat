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

        $materi->link_video_1 = $this->takeIdFromYoutubeLink($materi->link_video_1);
        $materi->link_video_2 == null ? $materi->link_video_2 = null : $materi->link_video_2 = $this->takeIdFromYoutubeLink($materi->link_video_2);
        $materi->link_video_3 == null ? $materi->link_video_3 = null : $materi->link_video_3 = $this->takeIdFromYoutubeLink($materi->link_video_3);
        $materi->link_video_4 == null ? $materi->link_video_4 = null : $materi->link_video_4 = $this->takeIdFromYoutubeLink($materi->link_video_4);

        return response()->json([
            'code' => 200,
            'message' => 'Link video materi berhasil diambil.',
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
        if (Auth::user()->role != 'Dosen') {
            return response()->json([
                'code' => 401,
                'message' => 'You are not authorized to access this resource.',
                'materi' => null,
            ]);
        }

        $validation = Validator::make($request->all(), [
            'link_video_1' => 'required|url',
            'link_video_2' => 'nullable|url',
            'link_video_3' => 'nullable|url',
            'link_video_4' => 'nullable|url',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Link video materi tidak valid.',
                'errors' => $validation->errors(),
                'materi' => null,
            ]);
        }

        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json([
                'code' => 404,
                'message' => 'Materi with that id is not found.',
                'materi' => null,
            ]);
        }

        $materi->link_video_1 = $request->link_video_1;
        $materi->link_video_2 = $request->link_video_2 == "" || null ? "" : $request->link_video_2;
        $materi->link_video_3 = $request->link_video_3 == "" || null ? "" : $request->link_video_3;
        $materi->link_video_4 = $request->link_video_4 == "" || null ? "" : $request->link_video_4;

        $materi->id_user = Auth::user()->id;
        $materi->save();

        return response()->json([
            'code' => 204,
            'message' => 'Link video materi berhasil di-update.',
            'materi' => $materi,
        ]);
    }

    public function takeIdFromYoutubeLink($link_video)
    {
        if (str_contains($link_video, 'youtu.be/')) {
            $link_video = str_replace('youtu.be/', 'youtube.com/watch?v=', $link_video);
        }
        $link_video_separated = explode('?v=', $link_video);
        // take all characters after 'v='
        $id = $link_video_separated[1];
        return $id;
    }
}
