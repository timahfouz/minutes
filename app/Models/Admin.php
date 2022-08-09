<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id')->withDefault();
    }
}




    