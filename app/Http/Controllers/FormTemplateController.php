<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FormField;
use App\Models\FormTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormTemplateController extends Controller
{
    public function formtemplate()
    {
        $formtemplates = FormTemplate::orderBy('id', 'desc')->get();
        return view('admin.form_template', compact('formtemplates'));
    }
    public function create()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('admin.formtemplate_create', compact('user', 'categories'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'category_id' => 'required|exists:categories,id',
        //     'user_name' => 'required|string|max:255',
        //     'user_id' => 'required|exists:users,id',
        //     'description' => 'nullable|string',
        // ]);

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'field_label' => 'required|array',
            'field_type' => 'required|array',
            'field_label.*' => 'required|string',
            'field_type.*' => 'required|string|in:text,textarea,checkbox,radio,select,file',
        ]);

        $store = FormTemplate::create([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'user_name' => $request->input('user_name'),
            'assigne_by' => $request->input('user_id'),
            'description' => $request->input('description'),
        ]);
        $formTemplate = $store->id;

        foreach ($request->field_label as $index => $label) {
            $fieldOptions = null;
            if (in_array($request->field_type[$index], ['select', 'radio', 'checkbox'])) {
                $fieldOptions = json_encode(explode(',', $request->input("field_options.$index", '')));
            }

            FormField::create([
                'form_template_id' => $formTemplate,
                'field_label' => $label,
                'field_type' => $request->field_type[$index],
                'field_options' => $fieldOptions,
                'is_required' => $request->has("is_required.$index"),
                'file_path' => null,
            ]);
        }

        return redirect()->route('admin.formtemplate')->with('success', 'Form template created successfully!');
    }
    public function edit($id)
    {
        $formtemplate = FormTemplate::findOrFail($id);
        $user = Auth::user();
        $categories = Category::all();
        return view('admin.formtemplate_edit', compact('formtemplate', 'user', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $formtemplate = FormTemplate::findOrFail($id);

        $formtemplate->update([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id'],
            'status' => $validatedData['status'],
            'description' => $validatedData['description'],
            'assigne_by' => $validatedData['user_id'],
        ]);

        return redirect()->route('admin.formtemplate')->with('success', 'Form template updated successfully');
    }
    public function destroy($id)
    {
        $formtemplate = FormTemplate::findOrFail($id);

        $formtemplate->delete();

        return redirect()->route('admin.formtemplate')->with('success', 'Form Template deleted successfully.');
    }
}
