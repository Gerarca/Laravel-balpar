<?php

namespace App\Imports;
use App\Producto;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductosImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
    /**
     * @param array $row
     *
     * @return Model|null
     * @throws \Exception
     */
    public function model(array $row)
    {
      
        return new Producto([]);
    }

    public function sheets(): array
    {
        return [
            new self(),
        ];
    }
}
