<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Script extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'scripts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = ['patient_id', 'medicine_category_id', 'approved'];
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

    public function medical_consultation(){
        return $this->hasOne(MedicalConsultation::class);
    }

    public function treatment_detail(){
        return $this->hasOne(TreatmentDetail::class);
    }

    public function medicine_category(){
        return $this->belongsTo(MedicineCategory::class);
    }

    public function script_products(){
        return $this->hasMany(ScriptProduct::class);
    }

    public function getAgeAtConsultationAttribute()
    {
        // Ensure the necessary relations and fields are available
        if ($this->medical_consultation && $this->medical_consultation->consultation_date && $this->patient && $this->patient->date_of_birth) {
            $consultationDate = Carbon::parse($this->medical_consultation->consultation_date);
            $dateOfBirth = Carbon::parse($this->patient->date_of_birth);
            return $consultationDate->diffInYears($dateOfBirth);
        }

        return null; // Or 'N/A' if you prefer
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
