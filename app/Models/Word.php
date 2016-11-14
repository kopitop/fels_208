<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function lessonWords()
    {
        return $this->hasMany('App\Models\LessonWord');
    }
    
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function delete()
    {
        // delete all associated answers
        $this->answers()->delete();

        // delete the word
        return parent::delete();
    }

}
