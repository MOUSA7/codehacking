<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use Sluggable;
    protected $fillable = ['user_id','category_id','photo_id','title','body'];
    //

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'save_to' => 'slug',
                'onUpdate'  => true,
            ]
        ];
    }


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function photo(){
        return $this->belongsTo('App\photo');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
