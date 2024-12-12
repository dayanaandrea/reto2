<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    //Este clase modelo en un futuro podría borrarse(OPCIONAL) 
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function module()
    {
        return $this->hasMany(Module::class, 'module_id');
    }

    public function cycle()
    {
        return $this->hasMany(Cycle::class, 'cycle_id');
    }
}