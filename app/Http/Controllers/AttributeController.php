<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function AttributePage()
    {
        $attributes = Attribute::with('variation')
            ->get();
        $parentVariations = Variation::all();
        return view('admin.attribute.index', compact('attributes', 'parentVariations'));
    }

    public function CreateAttribute(Request $request)
    {
        $request->validate([
            'variation_id' => 'required|exists:variations,id',
            'name' => 'required|string|max:255',
        ]);

        Attribute::create([
            'variation_id' => $request->variation_id,
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Attribute created successfully.');
    }

    public function UpdateAttribute(Request $request, $id)
    {
        $request->validate([
            'variation_id' => 'required|exists:variations,id',
            'name' => 'required|string|max:255',
        ]);

        $attribute = Attribute::findOrFail($id);
        $attribute->update([
            'variation_id' => $request->variation_id,
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Attribute updated successfully.');
    }

    public function DeleteAttribute($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();
        return redirect()->back()->with('success', 'Attribute deleted successfully.');
    }
}
