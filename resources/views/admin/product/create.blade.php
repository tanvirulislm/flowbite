@extends('layout.admin')

@section('content')

    <x-ui.breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Products', 'url' => route('product')],
            ['label' => 'Create Product']
        ]" />

    <div class="bg-white border border-default rounded-lg p-6 mt-4">

        <form method="POST" action="{{ route('create-product') }}" enctype="multipart/form-data">
            @csrf

            <!-- ================= PRODUCT INFO ================= -->
            <h3 class="text-lg font-semibold mb-4">Product Information</h3>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="text-sm font-medium">Product Name *</label>
                    <input name="title" required class="w-full mt-1 input">
                </div>

                <div>
                    <label class="text-sm font-medium">Category *</label>
                    <select name="category_id" required class="w-full mt-1 input">
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium">Brand</label>
                    <select name="brand_id" class="w-full mt-1 input">
                        <option value="">None</option>
                        @foreach($brands as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-medium">Short Description</label>
                    <textarea name="short_des" rows="2" class="w-full mt-1 input"></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-medium">Cover Image</label>
                    <input type="file" name="cover_image" class="w-full mt-1">
                </div>
            </div>

            <!-- ================= TYPE TOGGLE ================= -->
            <div class="mt-6 border-t pt-4">
                <label class="flex items-center gap-3">
                    <input id="isVariable" type="checkbox" class="w-4 h-4">
                    <span class="font-medium">This is a variable product</span>
                </label>
            </div>

            <!-- ================= SIMPLE PRODUCT ================= -->
            <div id="simpleBox" class="mt-6">
                <h4 class="font-medium mb-2">Pricing & Stock</h4>

                <div class="grid md:grid-cols-4 gap-4">
                    <input name="variants[0][price]" placeholder="Price *" required class="input">
                    <input name="variants[0][discount_price]" placeholder="Discount Price" class="input">
                    <input name="variants[0][stock]" placeholder="Stock *" required class="input">
                    <input name="variants[0][sku]" placeholder="SKU" class="input">
                    <input type="file" name="variants[0][image]" class="md:col-span-2">
                </div>
            </div>

            <!-- ================= VARIABLE PRODUCT ================= -->
            <div id="variableBox" class="hidden mt-6">
                <h4 class="font-medium mb-3">Variants</h4>

                <div id="variantContainer"></div>

                <button type="button" onclick="addVariant()" class="mt-3 px-4 py-2 border rounded">
                    + Add Variant
                </button>
            </div>

            <!-- ================= ACTION ================= -->
            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('product') }}" class="btn-outline">Cancel</a>
                <button class="btn-primary">Save Product</button>
            </div>

        </form>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        let variantIndex = 0;

        document.getElementById('isVariable').addEventListener('change', e => {
            document.getElementById('simpleBox').classList.toggle('hidden', e.target.checked);
            document.getElementById('variableBox').classList.toggle('hidden', !e.target.checked);
            if (e.target.checked && variantIndex === 0) addVariant();
        });

        function addVariant() {
            const html = `
        <div class="border rounded p-4 mb-4">
            <div class="grid md:grid-cols-4 gap-3">
                <input name="variants[${variantIndex}][price]" placeholder="Price *" required class="input">
                <input name="variants[${variantIndex}][discount_price]" placeholder="Discount" class="input">
                <input name="variants[${variantIndex}][stock]" placeholder="Stock *" required class="input">
                <input name="variants[${variantIndex}][sku]" placeholder="SKU" class="input">

                <select name="variants[${variantIndex}][variations][0][variation_id]" class="input">
                    <option value="">Variation</option>
                    @foreach($variations as $v)
                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                    @endforeach
                </select>

                <input name="variants[${variantIndex}][variations][0][option_id]"
                       placeholder="Option ID"
                       class="input">

                <input type="file" name="variants[${variantIndex}][image]" class="md:col-span-2">
            </div>

            <button type="button"
                onclick="this.parentElement.remove()"
                class="text-red-600 text-sm mt-2">
                Remove
            </button>
        </div>`;
            document.getElementById('variantContainer').insertAdjacentHTML('beforeend', html);
            variantIndex++;
        }
    </script>

@endsection