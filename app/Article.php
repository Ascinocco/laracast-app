<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //only these fields can be updated
    //for security
    protected $fillable = [
        'title',
        'body',
        'published_at',
        'user_id' //temporary
    ];

    //this converts are published_at dats to Carbon instances
    //we specify the date we want as a carbon instance in this array
    protected $dates = ['published_at'];


    //MUST FOLLOW THIS NAMING CONVENTION
    //pass in our query
    public function scopePublished($query)
    {
        //published_at is the field we want to check
        //<= is our type of check
        //Carbon now is the parameter we want to check against
        $query->where('published_at', '<=', Carbon::now());
    }

    //this would be nice for an admin panel
    public function scopeUnpublished($query)
    {
        //published_at is the field we want to check
        //<= is our type of check
        //Carbon now is the parameter we want to check against
        $query->where('published_at', '>=', Carbon::now());
    }

    //MUST FOLLOW THIS NAMING CONVENTION
    //here we're using mutators to adjust data before its pushed to the db
    //and in some cases after its retrieved from the db
    //Also, I think this method is implicitly called when you create a new
    //Article. not sure though
    public function setPublishedAtAttribute($date)
    {
        //sets the objects published at attribute to the newly formatted
        //date by using the createFromFormat function
        //$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);

        //if for some reason we want to set the date in the future we can
        //format the date by doing the following that will allow the time stamp
        //to be midnight on the future date
        $this->attributes['published_at'] = Carbon::parse($date);
    }

    //an article has one user
    //this function defines that relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

}
