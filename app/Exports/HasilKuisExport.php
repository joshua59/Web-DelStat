<?php

namespace App\Exports;

use App\Models\HasilKuis;
use Maatwebsite\Excel\Concerns\FromCollection;

class HasilKuisExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HasilKuis::all();
    }
}
