<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $primaryKey = 'Studentid';
    public $incrementing = false;

    public function classes()
    {
    return $this->belongsToMany(course_student::class);
    }


}
