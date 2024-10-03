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
        'left_treatment_photos',
        'right_treatment_photos',
        'top_treatment_photos',
        'bottom_treatment_photos',
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

   /* public function setTreatmentPhotosAttribute($value)
    {
        if (is_string($value) && strpos($value, 'data:image/') === 0) {
            // Process the base64 string to store the image
            $imageName = 'treatment_photos_' . time() . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            $imagePath = 'images/' . $imageName;

            // Save the image
            Storage::disk('public')->put($imagePath, base64_decode(substr($value, strpos($value, ',') + 1)));

            $this->attributes['treatment_photos'] = $imagePath;
        } else {
            $this->attributes['treatment_photos'] = $value;
        }
    }*/

    /*public function setTreatmentPhotosAttribute($value)
    {
        $processedPhotos = [];

        foreach ($value as $position => $imageData) {
            if (is_string($imageData) && strpos($imageData, 'data:image/') === 0) {
                // Process the base64 string to store the image
                $imageName = 'treatment_photos_' . $position . '_' . time() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                $imagePath = 'images/' . $imageName;

                // Save the image
                Storage::disk('public')->put($imagePath, base64_decode(substr($imageData, strpos($imageData, ',') + 1)));

                $processedPhotos[$position] = $imagePath;
            } else {
                $processedPhotos[$position] = $imageData;
            }
        }

        $this->attributes['treatment_photos'] = json_encode($processedPhotos);
    }

    public function getTreatmentPhotosAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }*/

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

    public function setPatientSignatureAttribute($value)
    {
        if (is_string($value) && strpos($value, 'data:image/') === 0) {
            // Process the base64 string to store the image
            $imageName = 'patient_signature_' . time() . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            $imagePath = 'images/signatures' . $imageName;

            // Save the image
            Storage::disk('public')->put($imagePath, base64_decode(substr($value, strpos($value, ',') + 1)));

            $this->attributes['patient_signature'] = $imagePath;
        } else {
            $this->attributes['patient_signature'] = $value;
        }
    }

    public function getPatientSignatureAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }


    // Mutator: Convert the array back into a comma-separated string before saving
    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = is_array($value) ? implode(', ', $value) : $value;
    }

    // Accessor: Convert the stored comma-separated string into an array
    public function getLocationAttribute($value)
    {
        return $value;
    }




    public function setLeftTreatmentPhotosAttribute($value)
    {
        if (is_string($value) && strpos($value, 'data:image/') === 0) {
            // Process the base64 string to store the image
            $imageName = 'left_treatment_photos_' . time() . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            $imagePath = 'images/' . $imageName;

            // Save the image
            Storage::disk('public')->put($imagePath, base64_decode(substr($value, strpos($value, ',') + 1)));

            $this->attributes['left_treatment_photos'] = $imagePath;
        } else {
            $this->attributes['left_treatment_photos'] = $value;
        }
    }

    public function getLeftTreatmentPhotosAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }


    public function setRightTreatmentPhotosAttribute($value)
    {
        if (is_string($value) && strpos($value, 'data:image/') === 0) {
            // Process the base64 string to store the image
            $imageName = 'right_treatment_photos_' . time() . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            $imagePath = 'images/' . $imageName;

            // Save the image
            Storage::disk('public')->put($imagePath, base64_decode(substr($value, strpos($value, ',') + 1)));

            $this->attributes['right_treatment_photos'] = $imagePath;
        } else {
            $this->attributes['right_treatment_photos'] = $value;
        }
    }

    public function getRightTreatmentPhotosAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }

    public function setTopTreatmentPhotosAttribute($value)
    {
        if (is_string($value) && strpos($value, 'data:image/') === 0) {
            // Process the base64 string to store the image
            $imageName = 'top_treatment_photos_' . time() . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            $imagePath = 'images/' . $imageName;

            // Save the image
            Storage::disk('public')->put($imagePath, base64_decode(substr($value, strpos($value, ',') + 1)));

            $this->attributes['top_treatment_photos'] = $imagePath;
        } else {
            $this->attributes['top_treatment_photos'] = $value;
        }
    }

    public function getTopTreatmentPhotosAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }

    public function setBottomTreatmentPhotosAttribute($value)
    {
        if (is_string($value) && strpos($value, 'data:image/') === 0) {
            // Process the base64 string to store the image
            $imageName = 'bottom_treatment_photos_' . time() . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            $imagePath = 'images/' . $imageName;

            // Save the image
            Storage::disk('public')->put($imagePath, base64_decode(substr($value, strpos($value, ',') + 1)));

            $this->attributes['bottom_treatment_photos'] = $imagePath;
        } else {
            $this->attributes['bottom_treatment_photos'] = $value;
        }
    }

    public function getBottomTreatmentPhotosAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
