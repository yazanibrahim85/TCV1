<?php

namespace App\Exports;

use App\Trainer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrainersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Trainer::all();
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */

 /*    public function actions(Request $request)
    {
    return [
        (new DownloadExcel)->withHeadings(),
    ];
    } */

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Area_id',
            'Address',
            'Phone_no',
            'Major',
            'Email',
            'Role_id',
            'Deleted_at',
            'Created_at',
            'Updated_at',
            'User_id',
        ];
    }

}
