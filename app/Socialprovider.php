<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socialprovider extends Model
{
    protected $table='socialprovider';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
