<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    protected $primaryKey = 'readingid';

    protected $fillable = ['userid', 'key', 'value', 'client_created'];
}
