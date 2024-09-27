<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalConsultation extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'medical_consultations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'patient_id', 'consultation_date', 'serious_health_problems', 'epilepsy_seizures_fainting',
        'autoimmune_disease', 'surgery_history', 'medications_supplements', 'myasthenia_gravis',
        'cold_sores', 'pregnant_breastfeeding', 'allergic_anything', 'sensitive_bees',
        'numbing_injection', 'keloid_scarring', 'intend_to_surgical_invasive', 'implants',
        'vaccination', 'tropical_treatment', 'anti_wrinkle', 'dermal_fillers', 'stimulatory_fillers',
        'injectable_procedure', 'smoke', 'travel', 'appearance', 'affected_daily_life',
        'avoid_gatherings', 'thinking_look', 'life_adversely', 'before_after', 'fully_consent',
        'understand', 'notes'
    ];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function script(){
        return $this->belongsTo(Script::class);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
