<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function ProductPage()
    {
        // Load products with all necessary relationships
        $products = Product::with([
            'category',
            'brand',
            'variants.options.variation', // This will work now with correct table names
        ])->get();

        // Get all variations with their options (for filtering/display)
        $variations = Variation::with('attributes')->get();

        // Optional: Get all used variation options
        $usedAttributes = Attribute::whereHas('productVariants')->with('variation')->get();

        return view('admin.product.index', compact('products', 'variations', 'usedAttributes'));
    }


    public function CreateProduct(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'short_des' => 'nullable|string|max:500',
            'long_des' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'remark' => 'nullable|in:Popular,New,Top,Special,Trending,Regular',
            'status' => 'nullable|in:active,draft,archived',
            'cover_image' => 'nullable|image|max:2048',

            // Variants validation
            'variants' => 'required|array|min:1',
            'variants.*.sku' => 'nullable|string|max:100',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.image' => 'nullable|image|max:2048',

            // Multiple variations per variant
            'variants.*.variations' => 'nullable|array',
            'variants.*.variations.*.variation_id' => 'required_with:variants.*.variations|exists:variations,id',
            'variants.*.variations.*.option_id' => 'required_with:variants.*.variations.*.variation_id|exists:variation_options,id',
        ]);

        try {
            DB::beginTransaction();

            // Upload cover image
            $coverImagePath = null;
            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $imageName = time() . '_cover.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);
                $coverImagePath = 'uploads/products/' . $imageName;
            }

            // Create product
            $product = Product::create([
                'title' => $request->title,
                'short_des' => $request->short_des,
                'long_des' => $request->long_des,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'remark' => $request->remark ?? 'Regular',
                'status' => $request->status ?? 'active', // Fixed: Use string instead of integer
                'cover_image' => $coverImagePath,
            ]);

            // Loop through variants
            foreach ($request->variants as $index => $variantData) {
                // Upload variant image - Fixed: Use proper file handling
                $variantImagePath = null;
                if ($request->hasFile("variants.{$index}.image")) {
                    $image = $request->file("variants.{$index}.image");
                    $imageName = time() . '_variant_' . $index . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/products'), $imageName);
                    $variantImagePath = 'uploads/products/' . $imageName;
                }

                // Create variant
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => $variantData['sku'] ?? null,
                    'price' => $variantData['price'],
                    'discount_price' => $variantData['discount_price'] ?? null,
                    'stock' => $variantData['stock'],
                    'image' => $variantImagePath,
                ]);

                // If the variant has variations, attach ALL of them
                if (!empty($variantData['variations']) && is_array($variantData['variations'])) {
                    foreach ($variantData['variations'] as $variation) {
                        // Validate that both variation_id and option_id are present
                        if (!empty($variation['variation_id']) && !empty($variation['option_id'])) {
                            ProductAttribute::create([
                                'product_variant_id' => $variant->id,
                                'attribute_id' => $variation['option_id'],
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Product created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Product Creation Validation Error:', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product Creation Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to create product: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function CreateProductPage()
    {
        $categories = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        $variations = Variation::with('attributes:id,variation_id,name')->get(['id', 'name']);

        return view('admin.product.create', compact('categories', 'brands', 'variations'));
    }


    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            // 1️⃣ Delete product cover image
            if ($product->cover_image && File::exists(public_path($product->cover_image))) {
                File::delete(public_path($product->cover_image));
            }

            // 2️⃣ Delete variant images
            foreach ($product->variants as $variant) {
                if ($variant->image && File::exists(public_path($variant->image))) {
                    File::delete(public_path($variant->image));
                }
            }

            // 3️⃣ Delete product (cascade deletes variants & pivots)
            $product->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(
                'error',
                'Failed to delete product: ' . $e->getMessage()
            );
        }
    }
}
