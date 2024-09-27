<?php

namespace App\Http\Controllers;

use App\Models\Script;
use Illuminate\Http\Request;

class DoctorApprovalController extends Controller
{
    //

    public function index()
    {
        $scripts = Script::with('patient', 'medical_consultation', 'treatment_detail')->get();



        return view('doctor.index', compact(['scripts']));
    }
}
