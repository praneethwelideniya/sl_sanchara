<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;

class Article extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['published_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->with('user')->orderBy('id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Written from the address
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'article_image')->withTimestamps()->withPivot('image_type');
    }

    public function coverImage()
    {
        return $this->belongsTo(Image::class,'cover_image_id');
    }
    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'article_keyword');
    }

    public function hits()
    {
        return $this->hasMany(HitLogger::class);
    }

    public function scopeNotDeleted(Builder $builder)
    {
        return $builder->where('is_deleted', 0);
    }

    public function scopePublished(Builder $builder)
    {
        return $builder->where('is_published', 1);
    }

    public function getPublishedAtHumanAttribute()
    {
        return $this->published_at->diffForHumans();
    }

    public function getCreatedAtHumanAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedAtHumanAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function getCategoryNameAttribute()
    {
        return optional($this->category)->name;
    }

    public function getContentAsHtmlAttribute()
    {
        $converter = new CommonMarkConverter();
        echo $converter->convertToHtml($this->content);
    }

    public static function getPaginate(Request $request)
    {
        // $perPage = config('view.item_per_page');
        $perPage =12;

        $categoryAlias = $request->route('categoryAlias');
        $keywordName = $request->route('keywordName');

        if (!is_null($categoryAlias)) {
            $category = Category::where('alias', $categoryAlias)->first();
            if (is_null($category)) {
                return collect([]);
            }
            $articleQuery = Article::where('category_id', $category->id);
        } elseif (!is_null($keywordName)) {
            $keyword = Keyword::where('name', $keywordName)->first();
            if (is_null($keyword)) {
                return collect([]);
            }
            $articleIds = $keyword->articles->pluck('id')->toArray();
            $articleQuery = Article::whereIn('id', $articleIds);
        } else {
            $articleQuery = Article::published()->notDeleted();
        }

        $paginateUrl = '';
        if ($request->has('lang')) {
            $articleQuery = $articleQuery->where('language', $request->lang);
            $paginateUrl = '?lang=' . $request->lang;
        }

        $articles = $articleQuery->latest()
            ->paginate($perPage)
            ->withPath($paginateUrl);

        return $articles;
    }
    
}
