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
        $script = Script::with(['patient', 'medical_consultation', 'treatment_detail', 'treatment_detail.medicare_card_detail'])->find(1);


        $pdf = PDF::loadView('pdf.script', compact('script'));

        return $pdf->download('script_' . $script->id . '.pdf');
    }
}
