<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
     protected $table='bills';
      public function billdetail()
    {
    	return $this->hasMany('App\Bill_detail','id_bill','id');
    }
      public function customer()
    {
    	return $this->belongsTo('App\Customer','id_customer','id');
    }
}
