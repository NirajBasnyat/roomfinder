<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Room extends Model
{
    protected $guarded = [];

    public function upload_groups(){
        return $this->hasMany(UploadGroups::class, 'group_id', 'images');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class,'user_id','user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }

    public function applicants()
    {
        return $this->belongsToMany(Applicant::class);
    }

    //accessors ->manipulates the incoming data from DB before showing it to view

    public function getTitleAttribute()
    {
        return $this->attributes['title'];
    }

    public function getTitleLimitAttribute()
    {
        return Str::limit($this->title,20);
    }

    public function getCreatedAtAttribute($value)
    {
       // return \Carbon\Carbon::parse($value)->toFormattedDateString();
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
