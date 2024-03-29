<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    CONST YES = 'Yes';    
    CONST NO = 'No';    

    CONST MALE = 'Male';
    CONST FEMALE = 'Female';

    CONST BOY = 'boy';
    CONST GIRL = 'girl';  

    CONST TAGS = 'tags';
    CONST ORIGINS = 'origins';

    CONST SEARCH_ENDS = 'ends';

    CONST SEARCH_BEGINS = 'begins';

    CONST SEARCH_CONTAINS = 'contains';

    CONST SEARCH_MEANING = 'meaning';


    protected $perPage = 50;

    protected $fillable = [
     'name','slug','gender','published'
    ];

   
    public function meanings(){
    	return $this->hasMany(Meaning::class);
    }

    public function origins(){
    	return $this->belongsToMany(Country::class,'country_name')->withTimestamps();
    }

    public function tags(){
    	return $this->belongsToMany(Tag::class,'name_tag')->withTimestamps();
    } 

    public function categories(){
        return $this->belongsToMany(Category::class,'category_name')->withTimestamps();
    }

}
