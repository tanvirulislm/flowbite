<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function BrandPage()
    {
        $brands = Brand::All();
        return view('admin.brand.index', compact('brands'));
    }

    public function CreateBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/brands'), $imageName);
            $image = 'uploads/brands/' . $imageName;
        }

        Brand::create([
            'name' => $request->input('name'),
            'image' => $image,
        ]);

        return redirect()->back()->with('success', 'Brand created successfully.');
    }

    public function DeleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->image && file_exists(public_path($brand->image))) {
            @unlink(public_path($brand->image));
        }

        $brand->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully.');
    }

    public function UpdateBrand(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $brand->image;

        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                @unlink(public_path($imagePath));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/brands'), $imageName);
            $imagePath = 'uploads/brands/' . $imageName;
        }

        $brand->update([
            'name' => $request->input('name'),
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Brand updated successfully.');
    }
}
