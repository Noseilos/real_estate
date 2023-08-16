<?php

namespace App\Imports;

use App\Models\PropertyType;
use Maatwebsite\Excel\Concerns\ToModel;

class PropertyTypeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PropertyType([
            'type_name'     => $row[0],
            'type_icon'   => $row[1], 
        ]);
    }
}
