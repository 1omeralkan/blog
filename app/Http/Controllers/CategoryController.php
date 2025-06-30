<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
{
    // Sadece üst (parent'ı olmayan) kategorileri alıyoruz
    $categories = Category::whereNull('parent_id')->with('children')->get();

    
    return view('categories.index', compact('categories'));
}


    public function create()
{
    $categories = \App\Models\Category::whereNull('parent_id')->with('children')->get();
    return view('categories.create', compact('categories'));
}



    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|unique:categories',
        'parent_id' => 'nullable|exists:categories,id',
    ]);

    Category::create($validated);

    return redirect()->route('categories.index')->with('success', 'Kategori eklendi!');
}


    public function edit(Category $category)
{
    $categories = Category::where('id', '!=', $category->id)->get(); // Kendisini listeden çıkar
    return view('categories.edit', compact('category', 'categories'));
}


    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Kategori güncellendi!');
    }

    public function destroy(Category $category)
{
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Kategori silindi!');
}


}
