<?php

namespace App\Imports;


use App\Models\Data;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class DataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Data([
        //     'name'     => $row[0],
        //     'dni'    => $row[1],
        //     'key' => rand(1111111111, 9999999999),
        // ]);

        // DB::table('data')->truncate();

        if(!Data::where('dni', '=', $row[1])->exists()) {

            return new Data([
                'name' => $row[0],
                'dni' => trim($row[1]),
                'observations' => $row[2],
                'key' => rand(1111111111, 9999999999),
            ]);
        }


    }

}
