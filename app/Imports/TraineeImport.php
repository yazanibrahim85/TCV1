<?php

namespace App\Imports;

use App\Trainee;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Auth;

class TraineeImport implements ToModel, WithStartRow
{
      /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

     
        //$time = strtotime($row[1]);

        //$newformat = date('YYYY-mm-dd',$time);
       
        if($row[5] ='male')
        {
            $row[5]='Male';  
        }elseif($row[5] ='female')
        {
            $row[5]='Female'; 
        }

        if($row[3] =='ramallah' or $row[3] =='Ramallah' )
        {
            $row[3]=1;
        }elseif($row[3] =='Hebron' or $row[3] =='hebron' )
        {
            $row[3]=2;
        }elseif($row[3] =='Nablus' or $row[3] =='nablus' )
        {
            $row[3]=3;
        }elseif($row[3] =='Jenin' or $row[3] =='jenin' )
        {
            $row[3]=4;
        }elseif($row[3] =='Tulkarem' or $row[3] =='tulkarem' )
        {
            $row[3]=5;
        }elseif($row[3] =='Qalqilya' or $row[3] =='qalqilya' )
        {
            $row[3]=6;
        }elseif($row[3] =='Beitlahem' or $row[3] =='beitlahem' )
        {
            $row[3]=7;
        }elseif($row[3] =='Jericho' or $row[3] =='jericho' )
        {
            $row[3]=8;
        }elseif($row[3] =='Salfit' or $row[3] =='salfit' )
        {
            $row[3]=9;
        }elseif($row[3] =='Tubas' or $row[3] =='tubas' )
        {
            $row[3]=10;
        }elseif($row[3] =='Jerusalem' or $row[3] =='jerusalem' )
        {
            $row[3]=11;
        }

        if (!empty($row[0])){
            return new Trainee([

        
                'name'  => $row[0],
                'dob'   =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1])->format('Y-m-d'),
                'identification_no'   => $row[2],
                'area_id'    => $row[3],
                'address'  => $row[4],
                'gender'   => $row[5],
                'phone_no'   => $row[6],
                'major'   => $row[7],
                'email'   => $row[8],
                'user_id' =>Auth::id(),
            ]);}
            
        
        
        
    }
}
