<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'published_at',
        'featured'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function scopePublished($query){
        $query->where('published_at', '<=', Carbon::now());
    }
    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }
    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }
    public function Excerpt(){
        return Str::limit(strip_tags($this->body, 150));
    }
    public function getReadingTime(){
        $mins = round(str_word_count($this->body) / 250);

        return ($mins< 1) ? 1 : $mins;
    }
    public function getThumbnailUrl()
    {
        $isUrl = str_contains($this->image, 'http');

        return ($isUrl) ? $this->image : Storage::disk('public')->url($this->image);
    }
    public function formatPublishedAt(){
        $date = $this->published_at;
        return date_format($date, "d-m-Y H:i:s");
    }
}
