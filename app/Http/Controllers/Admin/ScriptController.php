<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Script;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;

class ScriptController extends Controller
{
    //

    public function generatePDF($id=1)
    {
        $script = Script::with(['patient', 'medical_consultation', 'treatment_detail', 'treatment_detail.medicare_card_detail'])->find($id);


        $pdf = PDF::loadView('pdf.script', compact('script'))->setPaper('a4', 'landscape');
        Alert::success('Script Generated!')->flash();
//        return $pdf;
        return $pdf->download('script_' . $script->id . '_'. $script->patient->last_name .'_'. $script->patient->first_name .'_'. date('m_d_Y_his').'.pdf');
//        return view('pdf.script', compact(['script']));
    }

    public function approval($id) {
        $script = Script::find($id);

        if ($script) {
            $script->update(['approved' => 1]);

            // Show success message
            Alert::success('Script approved successfully!')->flash();

            // Redirect to the Script List page
            return redirect()->route('doctor-approval.view', ['id' => $id]);
        } else {
            // Show error message if script not found
            Alert::error('Script not found!')->flash();

            // Redirect to the Script List page
            return redirect()->route('doctor-approval.view', ['id' => $id]);
        }
    }

    public function reject($id) {
        $script = Script::find($id);

        if ($script) {
            $script->update(['approved' => 2]);

            // Show success message
            Alert::success('Script rejected successfully!')->flash();

            // Redirect to the Script List page
            return redirect()->route('doctor-approval.view', ['id' => $id]);
        } else {
            // Show error message if script not found
            Alert::error('Script not found!')->flash();

            // Redirect to the Script List page
            return redirect()->route('doctor-approval.view', ['id' => $id]);
        }
    }
}
