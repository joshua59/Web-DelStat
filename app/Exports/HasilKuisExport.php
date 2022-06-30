<?php

namespace App\Exports;

use App\Models\HasilKuis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HasilKuisExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HasilKuis::all();
    }

    public function map($hasilKuis): array
    {
        return [
            $hasilKuis->id,
            $hasilKuis->nama_user,
            HasilKuis::getNamaKuisByIdKuis($hasilKuis->id_kuis),
            $hasilKuis->nilai_kuis,
            $hasilKuis->created_at,
        ];
    }

    public function headings(): array
    {
        return ["ID Hasil Kuis", "Nama User", "Nama Kuis", "Nilai Kuis", "Waktu Pengumpulan Kuis"];
    }

}
