<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //黑名单
    // protected $guarded = [''];
    //白名单
    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'mobile',
        'company',
        'name',
        'email',
        'gallery',
        'back_province',
        'back_city',
        'back_district',
        'back_address',
    ];

    protected $casts = [
   //     'gallery' => 'json',
    ];


    public function setGalleryAttribute($gallery)
    {
        if (is_array($gallery)) {
            $this->attributes['gallery'] = json_encode($gallery);
        }
    }

    public function getGalleryAttribute($gallery)
    {
        return json_decode($gallery, true);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
