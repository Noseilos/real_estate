<?php

namespace App\Imports;

use App\Models\BlogPost;
use Maatwebsite\Excel\Concerns\ToModel;

class BlogPostImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BlogPost([
            'blogcat_id'     => $row[0],
            'post_title'     => $row[1],
            'post_slug'   => $row[2],
        ]);
    }
}
