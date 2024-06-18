<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;
	public $guarded = ['id'];
	protected $with = ['category','user'];
	
	public function scopeFilter($query, Array $filters)
	{
		// if (isset($filters['keyword']) ? $filters['keyword'] : false) {
		// 	return $query->where('title', 'like', '%'.$keyword.'%')->orWhere('body', 'like', '%'.$keyword.'%');
		// }
		
		$query->when($filters['keyword'] ?? false, function($query, $keyword){
			return $query->where('title', 'like', '%'.$keyword.'%')->orWhere('body', 'like', '%'.$keyword.'%');
		})->when($filters['category'] ?? false, function($query, $category){
			return $query->whereHas('category', function($query) use($category){
				$query->where('category_id', $category);
			});
		})->when($filters['user'] ?? false, function($query, $user){
			return $query->whereHas('user', function($query) use ($user){
				$query->where('user_id', $user);
			});
		});
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
