<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Nurse extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'nurses';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = ['id', 'name', 'aphpra_registration_number', 'certificate'];
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
    public function setCertificateAttribute($value)
    {
        if (is_string($value) && strpos($value, 'data:image/') === 0) {
            // Process the base64 string to store the image
            $imageName = 'certificate_' . time() . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            $imagePath = 'images/nurse/' . $imageName;

            // Save the image
            Storage::disk('public')->put($imagePath, base64_decode(substr($value, strpos($value, ',') + 1)));

            $this->attributes['certificate'] = $imagePath;
        } else {
            $this->attributes['certificate'] = $value;
        }
    }

    public function getCertificateAttribute($value)
    {

        return $value ? Storage::url($value) : null;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
