<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FormTemplate;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function formcreate()
    {
        $categories = Category::all();
        return view('user.form_create', compact('categories'));
    }


    // public function formcategory(Request $request)
    // {

    //     // Get the selected category ID from the request
    //     $categoryId = $request->category_id;

    //     // Find the category and load form templates and their associated form fields
    //     $category = Category::with(['formTemplates.formFields'])
    //     ->where('id', $categoryId)
    //     ->first();
    //     return $category;
    // }

    // public function formcategory(Request $request)
    // {
    //     // Get the selected category ID from the request
    //     $categoryId = $request->category_id;

    //     // Find the category and load form templates and their associated form fields
    //     $category = Category::with(['formTemplates.formFields'])
    //         ->where('id', $categoryId)
    //         ->first();

    //     // Check if category exists
    //     if (!$category) {
    //         return redirect()->back()->with('error', 'Category not found.');
    //     }

    //     // Pass the category data to the view
    //     return view('formcategory', compact('category'));
    // }

    public function formcategory(Request $request)
    {
        // Get the selected category ID from the request
        $categoryId = $request->category_id;

        // Find the category and load form templates and their associated form fields
        $category = Category::with(['formTemplates.formFields'])
            ->where('id', $categoryId)
            ->first(); // Use first() instead of get()

        // Debugging to check the category data
        // Check if category exists
        if (!$category) { // Change this condition to check for null
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Get all categories for the dropdown or other purposes
        $categories = Category::all();

        // Pass the category data to the view
        return view('user.form', compact('category'));
    }
    public function store(Request $request){
        dd($request->all());
    }
}
