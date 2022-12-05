<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;


class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // dd($row);
        if($row['name_en'] != '' && $row['name_ar'] != '' && $row['description_en'] != '' && $row['description_ar'] != ''){
            return new Product([
                'uuid'       => (string) Str::uuid(),
                'name_en'     => $row['name_en'],
                'name_ar'    => $row['name_ar'], 
                'description_en' => $row['description_en'],
                'description_ar' => $row['description_ar'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name_en' => 'required|string',
           // '*.name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ];
    }
}
