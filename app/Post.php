<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'content', 'image', 'published_at', 'category_id', 'user_id',
    ];

    public function deleteImage(){
        Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($id){
        return in_array($id, $this->tags->pluck('id')->toArray());
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query){
        return $query->where('published_at', '<=' , Carbon::now());
    }

    public function scopeAccepted($query){
        return $query->where('accepted', true);
    }

    public function scopeSearched($query){
        $search = request()->query('search');
        if(!$query){
            return $query;
        }

        return $query->published()->accepted()->where('title', 'LIKE', "%{$search}%");
    }


}
