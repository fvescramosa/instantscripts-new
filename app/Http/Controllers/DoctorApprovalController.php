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

    public function show($id)
    {
        $script = Script::with('patient', 'medical_consultation', 'treatment_detail')->find($id);

        $medical_consultation_fields = [

            ['name' => 'serious_health_problems', 'label' => 'Do you have any serious health problems, including any blood borne diseases or blood disorders?'],
            ['name' => 'epilepsy_seizures_fainting', 'label' => 'Do you suffer from epilepsy, seizures or fainting?'],
            ['name' => 'autoimmune_disease', 'label' => 'Do you have a history of autoimmune disease?'],
            ['name' => 'surgery_history', 'label' => 'Have you had any surgery, including cosmetic surgery?'],
            ['name' => 'medications_supplements', 'label' => 'Are you currently taking any medications or health supplements (prescribed or otherwise)?'],
            ['name' => 'myasthenia_gravis', 'label' => 'Have you been diagnosed with myasthenia gravis, Eaton-Lambert (myasthenic) syndrome, or any conditions that cause weakness in the muscles?'],
            ['name' => 'cold_sores', 'label' => 'Do you suffer from cold sores?'],
            ['name' => 'pregnant_breastfeeding', 'label' => 'Are you currently pregnant / breastfeeding or planning a pregnancy in the next 3 months including IVF?'],
            ['name' => 'allergic_anything', 'label' => 'Are you allergic to anything (including anaesthetics, adrenaline, medications)?'],
            ['name' => 'sensitive_bees', 'label' => 'Do you have any sensitivities or reactions to bee/wasp stings?'],
            ['name' => 'numbing_injection', 'label' => 'Have you ever had a numbing injection at the dentist?'],
            ['name' => 'keloid_scarring', 'label' => 'Do you have a history of abnormal scarring or keloid scarring?'],
            ['name' => 'intend_to_surgical_invasive', 'label' => 'Do you intend to have any surgical invasive dental procedures within the next 4 weeks or have you had any procedures within the last 4 weeks?'],
            ['name' => 'implants', 'label' => 'Do you have any implants or metalwork?'],
            ['name' => 'vaccination', 'label' => 'Have you received any vaccinations in the past 14 days, or do you intend on getting any vaccination in the next 14 days?'],
            ['name' => 'tropical_treatment', 'label' => 'Are you currently being treated with isotretinoin capsules or topical treatment (brands include Roaccutane, Oratane, Rocta, Dermatane and Isotrex)?'],
            ['name' => 'anti_wrinkle', 'label' => 'Have you ever received Botulinum Toxin Type A or other anti-wrinkle treatments before?'],
            ['name' => 'dermal_fillers', 'label' => 'Have you ever received dermal fillers before?'],
            ['name' => 'stimulatory_fillers', 'label' => 'Have you ever received a treatment with stimulatory fillers such as Sculptra or Radiesse?'],
            ['name' => 'injectable_procedure', 'label' => 'Have you ever had any complications with your previous cosmetic injectable procedures?'],
            ['name' => 'smoke', 'label' => 'Do you smoke?'],
            ['name' => 'travel', 'label' => 'Do you intend to travel internationally in the following 2 weeks?'],
            ['name' => 'appearance', 'label' => 'Are you worried about the way you look, and do you think about your appearance a lot and wish you could think about it less?'],
            ['name' => 'affected_daily_life', 'label' => 'Has the way you feel about it affected your daily life activities such as school, work or other activities?'],
            ['name' => 'avoid_gatherings', 'label' => 'Are there things you avoid because of how you look, such as gatherings, going out etc?'],
            ['name' => 'thinking_look', 'label' => 'Do you spend more than 2-3 hours a day thinking about how you look?'],
            ['name' => 'life_adversely', 'label' => 'If you could not have a cosmetic treatment today, would this affect your life adversely?'],
            ['name' => 'before_after', 'label' => 'Do you consent to have your before and after photos taken for the purpose of medical records?'],
            ['name' => 'fully_consent', 'label' => 'Have you been advised of the risks and fully consented for this treatment?'],
            ['name' => 'understand', 'label' => 'Do you understand everything that is written above or do you require assistance or language interpretation?'],

        ];

        return view('doctor.script', compact(['script', 'medical_consultation_fields']));
    }
}
