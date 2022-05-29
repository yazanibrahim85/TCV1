<?php


namespace App\Http\Controllers;
use Arphp\src\Arabic;
use Illuminate\Http\Request;
use DB;
use PDF;
use TCPDF;

class DynamicPDFController extends Controller
{
    function index($id,$course_id)
    {
     $trainee_data = $this->get_trainee_data($id);
     $course_data = $this->get_course_data($course_id);
     //return view('dynamic_pdf')->with('trainee_data', $trainee_data);
     return view('dynamic_pdf',['trainee_data' => $trainee_data,'course_data'=>$course_data]);

    }

    function indextraining($id)
    {
     $training_data = $this->get_training_data($id);
        
     //return view('dynamic_pdf')->with('trainee_data', $trainee_data);
     return view('dynamicTraining_pdf',['training_data' => $training_data]);

    }

    function get_training_data($id)
    {
     $training_data = DB::table('trainings')
         ->whereIn('id', [$id])
         ->limit(10)
         ->get();
     return $training_data;
    }

    function get_trainee_data($id)
    {
     $trainee_data = DB::table('trainees')
         ->whereIn('id', [$id])
         ->limit(10)
         ->get();
     return $trainee_data;
    }

    function get_course_data($course_id)
    {
     $course_data = DB::table('courses')
         ->whereIn('id', [$course_id])
         ->limit(10)
         ->get();
     return $course_data;
    }

    

    function pdfTraining($id)
    {
      $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_training_data_to_html($id));
     $pdf->setPaper('A4', 'landscape');
     return $pdf->stream(); 
    /*  $data = ['title' => 'PRCS'];
     $pdf = PDF::loadView('myPDF', $data);

     return $pdf->download('certificate.pdf'); */
    }

     function convert_training_data_to_html($id)
    {
            $training_data = $this->get_training_data($id);
            
            $course_data=DB::select('select course_id from trainings where id=?',[$id]);
            $course_data=DB::select('select * from courses where id=?',[$course_data[0]->course_id]);
            $trainee_data=DB::select('select trainee_id from courses_trainees where training_id=?',[$id]);
           
            //public_path(".  $imagePath .')
            

            $output = '
            
            ';  
            foreach($trainee_data as $traineed)
            {

            $trainee_datainfo=DB::select('select * from trainees where trainees.id=?',[$traineed->trainee_id]);
            
            foreach($trainee_datainfo as $trainee)
            {
                $course_data=DB::select('select * from courses where courses.id=?',[$course_data[0]->id]);
                $course_name=$course_data[0]->name_ar;
                $course_hours=$course_data[0]->hours;

                //$training_id=DB::select('select training_id from courses_trainees where courses.id=?',[$course_data[0]->id],' and trainee_id=?',[$trainee->id]);
                $training_id=$id;
                $training_data=DB::select('select course_begin_date,course_end_date from trainings where trainings.id=?',[$training_id]);
            $output .= '
            <html dir="rtl" lang="ar">
            
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <style>
            @font-face {
                font-family: myFirstFont;
                src: url("../fonts/JannaLTRegular.ttf");
              }
            div{
                font-family: myFirstFont;
              }

              
              </style>
              </head>
                <body>
               <!--  <div class="wrapper-page"> -->
            <h3 align="center">  Palestine Red Crescent Society  <img src="images/prcslogo.jpg" alt="PRCS" width="100px;" height="100px;"> جمعية الهلال الاحمر الفلسطيني</h3>
            
            
            
            
            
            <h2 align="center" style="color:Red; font-family:Dejavu sans ; " >شهادة مشاركة</h2>
            <h2 align="center" style="color:Black;">تمنح جميعة الهلال الأحمر الفلسطيني هذه الشهاده</h2>
            
            
            <h3 align="center" style="color: Black;">للأخ/ت  '. $trainee->name . ' الذي/التي شارك/ت في دورة في مجال '.$course_name.' بمعدل '. $course_hours .' ساعة <br>  في الفترة من '.$training_data[0]->course_begin_date.' الى '.$training_data[0]->course_end_date.' م <br> بناء عليه منح/ت هذه الشهادة <br> ملاحظة : هذه الشهادة لا تؤهل حاملها قيادة مركبة اسعاف بتاتا </h2>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <!-- </div> -->
            ';
            
        
        }
        }
        $output .= '</table>
        
        </body></html>';
            
            
  
        return $output;
    } 


    function pdf($id,$course_id)
    {
      $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_trainee_data_to_html($id,$course_id));
     $pdf->setPaper('A4', 'landscape');
     return $pdf->stream(); 
    /*  $data = ['title' => 'PRCS'];
     $pdf = PDF::loadView('myPDF', $data);

     return $pdf->download('certificate.pdf'); */
    }

    function convert_trainee_data_to_html($id,$course_id)
    {
        $trainee_data = $this->get_trainee_data($id);
            $course_data = $this->get_course_data($course_id);
            // create new PDF document
            require_once('..\vendor\TCPDF\tcpdf.php');

            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // set document information
        /*     $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('TCPDF Example 018');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide'); */
            
            // set default header data
            //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
            
            // set header and footer fonts
            //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            
            // set default monospaced font
            //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            
            // set margins
            //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            
            // set auto page breaks
            //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            
            // set image scale factor
            //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            
            // set some language dependent data:
            $lg = Array();
            $lg['a_meta_charset'] = 'UTF-8';
            $lg['a_meta_dir'] = 'rtl';
            $lg['a_meta_language'] = 'fa';
            $lg['w_page'] = 'page';
            
            // set some language-dependent strings (optional)
            $pdf->setLanguageArray($lg);
            
            // ---------------------------------------------------------
            
            // set font
            $pdf->SetFont('dejavusans', '', 12);
            
            // add a page
            $pdf->AddPage();
            
            // Persian and English content
           // $htmlpersian = '<span color="#660000">Persian example:</span><br />سلام بالاخره مشکل PDF فارسی به طور کامل حل شد. اینم یک نمونش.<br />مشکل حرف \"ژ\" در بعضی کلمات مانند کلمه ویژه نیز بر طرف شد.<br />نگارش حروف لام و الف پشت سر هم نیز تصحیح شد.<br />با تشکر از  "Asuni Nicola" و محمد علی گل کار برای پشتیبانی زبان فارسی.';
           // $pdf->WriteHTML($htmlpersian, true, 0, true, 0);
            
            // set LTR direction for english translation
            $pdf->setRTL(false);
            
            $pdf->SetFontSize(10);
            
         
            
            // Persian and English content
            //$htmlpersiantranslation = '<span color="#0000ff">Hi, At last Problem of Persian PDF Solved completely. This is a example for it.<br />Problem of "jeh" letter in some word like "ویژه" (=special) fix too.<br />The joining of laa and alf letter fix now.<br />Special thanks to "Nicola Asuni" and "Mohamad Ali Golkar" for Persian support.</span>';
           // $pdf->WriteHTML($htmlpersiantranslation, true, 0, true, 0);
            
            // Restore RTL direction
            //$pdf->setRTL(true);
            
            // set font
            $pdf->SetFont('aefurat', '', 15);
            
            // print newline
           // $pdf->Ln();
            
            // Arabic and English content
            //$pdf->Cell(0, 12, 'بِسْمِ اللهِ الرَّحْمنِ الرَّحِيمِ',0,1,'C');
            $htmlcontent = '<h3 align="center"> <br>جمعية الهلال الاحمر الفلسطيني<br> <img src="images/prcslogo.jpg" alt="PRCS" width="100px;" height="100px;">  <br>Palestine Red Crescent Society <br></h3> ';
               // print newline
               //$pdf->Ln();
            $pdf->WriteHTML($htmlcontent, true, 0, true, 0);
            
            // set LTR direction for english translation
            $pdf->setRTL(false);
            
            // print newline
            $pdf->Ln();
            
            $pdf->SetFont('aealarabiya', '', 18);
            
            // Arabic and English content
            $htmlcontent2 = '<h2 align="center" style="color:Red;" >شهادة مشاركة</h2>
            <h2 align="center" style="color:Black;">تمنح جميعة الهلال الأحمر الفلسطيني هذه الشهاده</h2>
            
            
            ';  
            $pdf->WriteHTML($htmlcontent2, true, 0, true, 0);
            foreach($trainee_data as $trainee)
            {
                $course_data=DB::select('select * from courses where courses.id=?',[$course_data[0]->id]);
                $course_name=$course_data[0]->name_ar;
                $course_hours=$course_data[0]->hours;

                $training_id=DB::select('select training_id from courses_trainees where course_id=?',[$course_data[0]->id],' and trainee_id=?',[$trainee->id]);
                $training_id=$training_id[0]->training_id;
                $training_data=DB::select('select course_begin_date,course_end_date from trainings where trainings.id=?',[$training_id]);
                $htmlcontent3  = '
            <h3 align="center" style="color: Black;">للأخ/ت  '. $trainee->name . ' الذي/التي شارك/ت في دورة في مجال '.$course_name.' بمعدل '. $course_hours .' ساعة <br>  في الفترة من '.$training_data[0]->course_begin_date.' الى '.$training_data[0]->course_end_date.' م <br> بناء عليه منح/ت هذه الشهادة <br> ملاحظة : هذه الشهادة لا تؤهل حاملها قيادة مركبة اسعاف بتاتا </h2>
            ';
            
        
        }
            $pdf->WriteHTML($htmlcontent3, true, 0, true, 0);
            
            // ---------------------------------------------------------
            
            //Close and output PDF document
            $pdf->Output('example_018.pdf', 'I');
            return $pdf;
//============================================================+
// END OF FILE
//============================================================+
    }
}