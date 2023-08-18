<?php

namespace App\Imports;

use App\Models\Testimonial;
use Maatwebsite\Excel\Concerns\ToModel;

class TestimonialImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Testimonial([
            'name'     => $row[0],
            'position'   => $row[1], 
            'message'   => $row[2], 
        ]);
    }
}
