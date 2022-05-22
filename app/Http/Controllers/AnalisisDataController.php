<?php

namespace App\Http\Controllers;

use App\Models\AnalisisData;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AnalisisDataController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $analisisdata = AnalisisData::
            where('judul','like','%'.$request->keywords.'%')->
            paginate(10);
            return view('page.analisis.list', compact('analisisdata'));
        }
        return view('page.analisis.main');
    }

    public function update(Request $request, AnalisisData $analisisdata)
    {
        try {
            $analisisdata->status = $request->status;

            $analisisdata->update();
            return redirect()->route('analisisdata.index');
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada kesalahan, silahkan coba lagi.',
            ]);
        }
    }
}
