<?php

namespace App\Models;

use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;
    protected $fillable=['title','description','content','category_id','thumbnail'];
    use HasFactory;
    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function  category() {
        return $this->belongsTo(Category::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    //метод описывающий картинки, чтобы не указывать его сто раз везде
    public static function uploadImage(Request $request, $image=null) {
        if($request->hasFile('thumbnail')) {
            if($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
        return $request->file('thumbnail')->store("images/{$folder}");
        }
return null;
    }

public function getImage() {
        if(!$this->thumbnail) {
            //лежит в папке /public
            return asset('no-image.png');
        }
        return asset("uploads/{$this->thumbnail}");
}
public function getPostDate() {
        return Carbon::createFromFormat('Y-m-d H:i:s',$this->created_at)->format('d F, Y');

}
//метод scope сокращающий запрос
public function scopeLike($query,$s)
{
return $query->where('title','LIKE',"%{$s}%");


}

}