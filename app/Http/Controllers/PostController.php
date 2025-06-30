<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Post::with(['user', 'category']);

    // Başlıkta arama
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Kategori filtresi (recursive)
    if ($request->filled('category_id')) {
        $category = Category::with('children')->find($request->category_id);
        $ids = [$category->id];

        if ($category) {
            $ids = array_merge($ids, $category->allChildrenIds());
            $query->whereIn('category_id', $ids);
        }
    }

    $posts = $query->latest()->get();

    // Kategorileri recursive yükle
    $categories = Category::whereNull('parent_id')->with('children')->get();

    return view('posts.index', compact('posts', 'categories'));
}




    /**
     * Show the form for creating a new resource.
     */
    
    public function create()
{
    $categories = \App\Models\Category::whereNull('parent_id')->with('children')->get();
    return view('posts.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image|max:2048', // JPG, PNG vs.
    ]);

    // Görsel yüklendiyse klasöre kaydet
    if ($request->hasFile('image')) {
        $validated['image_path'] = $request->file('image')->store('images', 'public');
    }

    // Oturumdaki kullanıcıya ait post oluştur
    $request->user()->posts()->create($validated);

    return redirect()->route('posts.index')->with('success', 'Yazı oluşturuldu!');
}



    /**
     * Display the specified resource.
     */
    public function show(Post $post)
{
    return view('posts.show', compact('post'));
}


    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Post $post)
{
    $categories = \App\Models\Category::whereNull('parent_id')->with('children')->get();
    return view('posts.edit', compact('post', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id', // ✅ bunu ekle
    ]);

    $post->update($validated); // ✅ category_id otomatik dahil olacak

    return redirect()->route('posts.index')->with('success', 'Yazı güncellendi!');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
{
    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Yazı silindi.');
}

}
