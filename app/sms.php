<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sms extends Model
{
    protected $table = 'send_sms';

    public $primaryKey ='id';

    public $timestamps = true;
}
