<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class article extends Model
{
    //
    protected $fillable=array(
        'title',
        'body',
        'published_at' 
    );
    //additional field to treat as Carbon instances
    protected $dates=['published_at'];

    /*
    Scope queries to show only published articles
    scopefunctionname($query)
    */
    public function scopepublished($query)
    {
    	$query->where('published_at','<=',Carbon::now());
    }
    public function scopeunpublished($query)
    {
    	$query->where('published_at','>',Carbon::now());
    }
    
    /*
    syntax of mutator=> setAttributeNameAttribute
    set the published_at attribute
    */
    public  function setPublishedAtAttribute($date)
    {
    	// $this->attributes['published_at']=Carbon::createFromFormat('Y-m-d',$date); 
    	$this->attributes['published_at']=Carbon::parse($date);
    	//if we want to publish article in future then it shows time 0:00 i.e. a type of check
    }

    /*
    An article is owned by a user
    @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo('App\User');

    }



}
