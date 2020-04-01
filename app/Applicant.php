<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $guarded = [];
    public $timestamps =false;

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
