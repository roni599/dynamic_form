<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category', compact('categories'));
    }
    public function create(Request $request)
    {
        $user = Auth::user();
        return view('admin.category_create', compact('user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->assigne_by = $request->user_id;
        $category->save();

        return redirect()->route('admin.category')->with('success', 'Category created successfully!');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $user = Auth::user();
        return view('admin.category_edit', compact('category', 'user'));
    }
    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $category = Category::findOrFail($request->id);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->assigne_by = $request->user_id;

        $category->save();

        return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Category deleted successfully.');
    }
}
