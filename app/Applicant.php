<?php

namespace App;

use App\Room;
use App\User;
use App\Owner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Applicant extends Model
{
    use Notifiable;

    protected $guarded = [];

    public $timestamps = false;

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifications()
    {
        return $this->morphTo();
    }

    /* APPLICANT
                                                            id, room_id 
                                                        ROOMS
                                                            id,  user_id
                                                        USER
                                                            email, id 
                                                        TRY TO APPLY Polymorphic relationship
                                                    */
    public function applicationOwner()
    {
        return $this->hasManyThrough(User::class, Room::class, 'user_id', 'id');
    }
}
