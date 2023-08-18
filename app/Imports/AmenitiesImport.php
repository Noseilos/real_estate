<?php

namespace App\Imports;

use App\Models\Amenities;
use Maatwebsite\Excel\Concerns\ToModel;

class AmenitiesImport implements ToModel
{
/**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Amenities([
            'amenities_name'  => $row[0],
            'short_desc'   => $row[1], 
            'long_desc'   => $row[2], 
        ]);
    } //

}
