<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TreatmentDetail extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'treatment_details';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['patient_id',
        'script_id',
        'quantity',
        'location',
        'extra_notes',
        'deposit_details',
        'deposit_refund',
        'follow_up_payment',
        'possible_expenses',
        'treatment_photos',
        'before_treatment_photos',
        'after_treatment_photos',
        'consent_to_photographs',
        'consent_to_treatment',
        'patient_signature',
        'medicare_card_details_id',
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

    public function scripts(){
        return $this->belongsTo(Script::class);
    }
    public function medicare_card_detail(){
        return $this->belongsTo(MedicareCardDetails::class);
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
    public function setBeforeTreatmentPhotosAttribute($value)
    {
        if (is_string($value) && strpos($value, 'data:image/') === 0) {
            // Process the base64 string to store the image
            $imageName = 'before_treatment_photos_' . time() . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            $imagePath = 'images/' . $imageName;

            // Save the image
            Storage::disk('public')->put($imagePath, base64_decode(substr($value, strpos($value, ',') + 1)));

            $this->attributes['before_treatment_photos'] = $imagePath;
        } else {
            $this->attributes['before_treatment_photos'] = $value;
        }
    }

    public function getBeforeTreatmentPhotosAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }

    public function setAfterTreatmentPhotosAttribute($value)
    {
        if (is_string($value) && strpos($value, 'data:image/') === 0) {
            // Process the base64 string to store the image
            $imageName = 'after_treatment_photos_' . time() . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            $imagePath = 'images/' . $imageName;

            // Save the image
            Storage::disk('public')->put($imagePath, base64_decode(substr($value, strpos($value, ',') + 1)));

            $this->attributes['after_treatment_photos'] = $imagePath;
        } else {
            $this->attributes['after_treatment_photos'] = $value;
        }
    }

    public function getAfterTreatmentPhotosAttribute($value)
    {

        return $value ? Storage::url($value) : null;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
