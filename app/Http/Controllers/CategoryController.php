<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Categorypage()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function CreateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $imageName);
            $image = 'uploads/categories/' . $imageName;
        }

        Category::create([
            'name' => $request->input('name'),
            'image' => $image,
            'parent_id' => $request->input('parent_id')
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image && file_exists(public_path($category->image))) {
            @unlink(public_path($category->image));
        }

        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function UpdateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $imagePath = $category->image;

        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                @unlink(public_path($imagePath));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $imageName);
            $imagePath = 'uploads/categories/' . $imageName;
        }

        $category->update([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'parent_id' => $request->input('parent_id')
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }
}
