<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;


class DashboardController extends Controller
{
    public function index()
{
     $totalUsers = User::count();
    $totalPosts = Post::count();
    $totalCategories = Category::count();
        $latestPosts = Post::latest()->take(5)->get();

     
    return view('admin.dashboard', [
        'totalUsers' => User::count(),
        'totalPosts' => Post::count(),
        'totalCategories' => Category::count(),
        'latestPosts' => $latestPosts
    ]);
}

}
