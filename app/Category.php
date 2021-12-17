<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    CONST DEFAULT_PARENT = 0;

    CONST HOME_PAGE_CATEGORY = 2;

    CONST MORE = 'more';

    public function names(){
        return $this->belongsToMany(Name::class,'category_name')->withTimestamps();
    }

    public function childern() {
        return $this->hasMany(static::class,'parent')->orderBy('name');
     }
}
