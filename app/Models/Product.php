<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\UploaderTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes , UploaderTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'slug',
        'is_active',
    ];

    /**
     * Set the image path attribute.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setImageAttribute($value)
    {
        $path = 'product'; // Specify the desired path where the file will be stored

        if ($value) {
            $storedFile = $this->storeFile($value, $path);
            $this->attributes['image'] = $storedFile;
        } else {
            $this->attributes['image'] = null;
        }
    }

    public function priceModifiers()
    {
        return $this->hasMany(PriceModifier::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
