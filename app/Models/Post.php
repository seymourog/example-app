<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    protected $table = 'posts';
    protected $guarded = false;
    protected $withCount  = ['likedUsers'];
    protected $with = ['category'];
    public function tags(){
        return $this->belongsToMany(Tags::class,'post_tags','post_id','tag_id');
    }
    public function getDateAsCarbonAttribute(){
        return Carbon::parse($this->datestart);
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function userId(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function likedUsers(){
        return$this->belongsToMany(User::class, 'post_user_likes', 'post_id', 'user_id');
    }
    public function comments(){
        return $this->hasMany(Comments::class,'post_id','id');
    }
}
