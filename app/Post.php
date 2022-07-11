<?php

namespace App;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function category(){
        return $this->belongsTo('App\Category');
    }


    public function tags(){
        return $this->belongsToMany("App\Tag");
    }

    protected $fillable =[
        'title',
        'slug',
        'content',
        'category_id'
    ];


    public static function generateSlug($title){
        $slug = Str::slug($title,'-');
        $slug_presente = Post::where("slug",$slug)->first();
        $slug_base = $slug;
        $i= 1;

        while ($slug_presente) {
            $slug = $slug_base . '-'. $i;
            $i++;
            $slug_presente = Post::where("slug",$slug)->first();
        }
        return $slug;
    }
}
