<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class properties extends Model
{
    use Uuids;
    //Table Name
    protected $table = 'properties';

    public $primaryKey ='id';

    public $timestamps = true;


    public function user(){
        return $this->belongsTo(User::class);
       // return $this->hasMany(properties::class);
    }

    public function photos(){
        return $this->hasMany('App\Photos');
    }

}
