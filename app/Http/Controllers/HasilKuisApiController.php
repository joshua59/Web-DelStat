<?php

namespace App\Http\Controllers;

use App\Models\HasilKuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilKuisApiController extends Controller
{
    /**
     * The method will get data of Hasil Kuis depending of the role of user that requested it
     * If the role is 'Dosen' then it will get all the data of Hasil Kuis
     * Else it will get all the data of currently authenticated or logged-in user only
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (Auth::user()->role == 'Dosen') {
            $hasilKuis = HasilKuis::getAllHasilKuis();
            return response()->json([
                'code' => 200,
                'message' => [
                    'value' => 'All Hasil Kuis retrieved successfully',
                ],
                'hasilKuis' => $hasilKuis,
            ]);
        }

        $hasilKuis = HasilKuis::getAllHasilKuisPrivate(Auth::user()->id);
        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'All Hasil Kuis ' . Auth::user()->nama . ' retrieved successfully ',
            ],
            'hasilKuis' => $hasilKuis,
        ]);
    }

    /**
     * The method will get data of certain Hasil Kuis id, and data got depends on the role of user that requested it
     * If the role is 'Dosen' then it will get all the data of that Hasil Kuis id
     * Else it will get all the data of currently authenticated or logged-in user only
     *
     * @param int $id_kuis
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexByIdKuis(int $id_kuis)
    {
        if (Auth::user()->role == 'Dosen') {
            $hasilKuis = HasilKuis::getAllHasilKuisByIdKuis($id_kuis);

            return response()->json([
                'code' => 200,
                'message' => [
                    'value' => 'All Hasil Kuis with id ' . $id_kuis . ' retrieved successfully.',
                ],
                'hasilKuis' => $hasilKuis,
            ]);
        }

        $hasilKuis = HasilKuis::getAllHasilKuisByIdKuisPrivate($id_kuis, Auth::user()->id);
        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'All Hasil Kuis with id ' . $id_kuis . ' of user named ' . Auth::user()->nama . ' retrieved successfully.',
            ],
            'hasilKuis' => $hasilKuis,
        ]);
    }

    /**
     * Store Hasil Kuis or result of quiz that has been taken by users
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validation is not needed since the data sent within the request isn't filled manually by users
        $hasilKuis = HasilKuis::create([
            'nama_user' => Auth::user()->nama,
            'id_kuis' => $request->id_kuis,
            'nilai_kuis' => $request->nilai_kuis,
            'id_user' => Auth::user()->id,
        ]);

        return response()->json([
            'code' => 201,
            'message' => [
                'value' => 'Hasil kuis stored successfully',
            ],
            'hasilKuis' => $hasilKuis,
        ]);
    }
}
