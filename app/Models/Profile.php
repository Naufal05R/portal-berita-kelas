<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company',
        'job',
        'country',
        'address',
        'phone',
        'image',
    ];

    protected function image() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/profiles' .$value)
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
