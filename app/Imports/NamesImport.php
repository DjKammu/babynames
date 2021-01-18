<?php

namespace App\Imports;

use App\Name;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NamesImport implements ToModel, WithHeadingRow

// class NamesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Name([
           'name'       => $row['nvar'],
           'meanings'   => $row['ndfn'], 
        ]);
    }
}
