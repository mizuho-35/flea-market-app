<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_list',
        'item_image',
        'condition',
        'item_name',
        'brand',
        'description',
        'price',
        'status',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function scopeKeywordSearch($query, $keyword) {
        if (!empty($keyword)) {
            $query->where('item_name', 'like', "%{$keyword}%")->orWhere('description', 'like', "%{$keyword}%");
        }
        return $query;
    }

    public function getCategoryIdsAttribute() {
        return explode(',', $this->category_list);
    }

    public function getCategoriesAttribute() {
        return Category::whereIn('id', $this->category_ids)->get();
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function order() {
        return $this->hasOne(Order::class);
    }

}
