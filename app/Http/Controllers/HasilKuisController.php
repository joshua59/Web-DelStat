<?php

namespace App\Http\Controllers;

use App\Models\HasilKuis;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use PDF;

class HasilKuisController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $hasilkuis = HasilKuis::
            where('nama_user','like','%'.$request->keywords.'%')->
            paginate(10);
            return view('page.report.list', compact('hasilkuis'));
        }
        return view('page.report.main');
    }

    public function export_pdf()
    {
        $hasilkuis = HasilKuis::all();
        $pdf = PDF::loadView('page.report.pdf', compact('hasilkuis'));
        return $pdf->download('hasil_kuis.pdf');
    }
}
