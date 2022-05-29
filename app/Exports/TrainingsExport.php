<?php

namespace App\Exports;

use App\Training;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;

class TrainingsExport implements FromCollection, WithHeadings
{
    //use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Training::all();
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */

    /* public function actions(Request $request)
    {
    return [
        (new DownloadExcel)->withHeadings(),
    ];
    } */

    public function headings(): array
    {
        return [
            'id',
            'Course_id',
            'Participants_no',
            'Expiration_date',
            'Area_id',
            'Location',
            'Course_date',
            'Deleted_at',
            'Created_at',
            'Updated_at',
            'User_id',
        ];
    }


}
