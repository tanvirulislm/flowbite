<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use Illuminate\Http\Request;
use App\Models\Attribute;

class VariationController extends Controller
{
    public function VariationPage()
    {
        $variations = Variation::with('attributes')->get();
        return view('admin.variation.index', compact('variations'));
    }


    public function CreateVariation(Request $request)
    {
        $request->validate([
            'variation_name' => 'required|string|max:255|unique:variations,name',
            'attributes' => 'required|string',
        ]);


        $variation = Variation::create([
            'name' => $request->variation_name,
        ]);

        $attributes = array_map(
            'trim',
            explode(',', $request->input('attributes'))
        );

        foreach ($attributes as $attr) {
            Attribute::create([
                'variation_id' => $variation->id,
                'name' => $attr,
            ]);
        }

        return back()->with('success', 'Variation created successfully.');
    }


    public function UpdateVariation(Request $request, $id)
    {
        $request->validate([
            'variation_name' => 'required|string|max:255',
            'attributes' => 'nullable|string',
        ]);

        // 🔒 Manual unique check
        $exists = Variation::where('name', $request->variation_name)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()->with('warning', 'Variation name already exists.');
        }

        $variation = Variation::findOrFail($id);

        // Update variation name
        $variation->update([
            'name' => $request->variation_name,
        ]);

        // Update attributes only if provided
        if ($request->filled('attributes')) {
            $variation->attributes()->delete();

            $attributes = array_map(
                'trim',
                explode(',', $request->input('attributes'))
            );

            foreach ($attributes as $attr) {
                Attribute::create([
                    'variation_id' => $variation->id,
                    'name' => $attr,
                ]);
            }
        }

        return back()->with('success', 'Variation updated successfully.');
    }



    public function DeleteVariation($id)
    {
        $variation = Variation::findOrFail($id);
        Variation::where('variation_id', $id)->delete();
        $variation->delete();
        return redirect()->back()->with('success', 'Variation deleted successfully.');
    }
}
