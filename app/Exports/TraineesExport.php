<?php

namespace App\Exports;

use App\Trainee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TraineesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Trainee::all();
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
            'dob',
            'identification_no',
            'area_id',
            'Address',
            'gender',
            'Phone_no',
            'Major',
            'Email',
            'Deleted_at',
            'Created_at',
            'Updated_at',
            'User_id',
        ];
    }

}
