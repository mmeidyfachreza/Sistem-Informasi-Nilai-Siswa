<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kepsek extends Model
{
    protected $table = "kepsek";

    protected $fillable = ['nama','nip'];
}
