<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class propertiesForRent extends Model
{
    protected $table = 'properties_for_rent';

    public $primaryKey ='id';

    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);

    }
}
