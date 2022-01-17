<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_student extends Model
{
    /**
 *  (getting students of class)
 */
public function students()
{
    return $this->belongsToMany(Students::class);
}


}
