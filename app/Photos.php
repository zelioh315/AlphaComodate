<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $table = 'photo';

    public $primaryKey ='id';

    public $timestamps = true;

    public function properties(){
        return $this->belongsTo('App\properties');
       // return $this->hasMany(properties::class);
    }
}
