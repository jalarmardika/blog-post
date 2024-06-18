<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
	public function index()
	{
		$title = '';
		if (request('category')) {
			$category = Category::find(request('category'));
			$title .= ' In '. $category->name;
		}
		if (request('user')) {
			$user = User::find(request('user'));
			$title .= ' By '. $user->name;
		}

		return view('home', [
			'title' => 'All Posts'. $title,
			'posts' => Post::latest()->filter(request(['keyword', 'category', 'user']))->simplePaginate(5)->withQueryString(),
			'categories' => Category::all()
		]);
	}

	public function detail(Post $post)
	{
		return view('detail', [
			'post' => $post
		]);
	}
}
