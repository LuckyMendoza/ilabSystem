<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class PdfController extends Controller
{
    public function result(Request $request)
    {
        $services = null;
        $data = DB::table('schedule_lists')->where('id',$request->data_id)->first();
        
        $user = DB::table('users')->where('id',$data->user_id)->first();
        $doc  = DB::table('users')->where('id',$data->doctor)->first();
        $resultData = DB::table('prescription_records')->where('appointment_id',$data->id)->first();
        $result = 
        [
            'pangalan' => $user->fname. ' ' .$user->lname,
            'araw'   => $data->schedule_date,
            'gender' => $user->gender,
            'age'    => 'N/A',
            'doc'    => $doc->fname. ' ' .$doc->lname,
            'status' => 'N/A',
            'result' => json_decode($resultData->result)
        ];  
        if($request->data_service == 1){
            $services = "urinalysis";
        }elseif($request->data_service == 2)
        {
            $services = "cbc";
        }
        $pdf = Pdf::loadView('pdf.'.$services,$result)->setPaper('a4', 'landscape');
        return $pdf->download('MedResult.pdf');
    }
}
