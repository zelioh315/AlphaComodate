<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'send_emails';

    public $primaryKey ='id';

    public $timestamps = true;

}
