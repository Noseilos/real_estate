<?php

namespace App\Imports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\ToModel;

class PropertyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Property([
            'ptype_id'     => $row[0],
            'amenities_id'     => $row[1],
            'property_name'   => $row[2],
            'property_slug'     => $row[3],
            'property_code'   => $row[4],
            'property_status'     => $row[5],
            'lowest_price'     => $row[6],
            'max_price'   => $row[7],
            'city'   => $row[8],
        ]);
    }
}
