<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Script;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Http\Request;

class ScriptController extends Controller
{
    //

    public function generatePDF($id=1)
    {
        $script = Script::with(['patient', 'medical_consultation', 'treatment_detail', 'treatment_detail.medicare_card_detail'])->find($id);


        $pdf = PDF::loadView('pdf.script', compact('script'))->setPaper('a4', 'landscape');

//        return $pdf;
        return $pdf->download('script_' . $script->id . '_'. $script->patient->last_name .'_'. $script->patient->first_name .'_'. date('m_d_Y_his').'.pdf');
//        return view('pdf.script', compact(['script']));
    }

    public function approval($id){
       $script = Script::find($id);
       $script->update('approved', 1);
       $script->save();


    }

    public function reject($id){
        $script = Script::find($id);
        $script->save();


    }
}
