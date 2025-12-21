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

            <div class="grid md:grid-cols-4 gap-4">
                <div class="md:col-span-4">
                    <label class="block mb-1 text-sm font-medium">Product Name *</label>
                    <input name="title" required
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Category *</label>
                    <select name="category_id" required
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium
                                                                                                                                                                                                                                                                                                                            border border-default-medium rounded">
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Brand</label>
                    <select name="brand_id"
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium
                                                                                                                                                                                                                                                                                                                    border border-default-medium rounded">
                        <option value="">None</option>
                        @foreach($brands as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Remark</label>
                    <select name="brand_id"
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                        <option value="Popular">Popular</option>
                        <option value="New">New</option>
                        <option value="Top">Top</option>
                        <option value="Special">Special</option>
                        <option value="Trending">Trending</option>
                        <option value="Regular" default>Regular</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Status</label>
                    <select name="brand_id"
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                        <option value="active">Active</option>
                        <option value="draft">Draft</option>
                        <option value="archived" default>Archived</option>

                    </select>
                </div>

                <div class="md:col-span-4">
                    <label class="block md-1 text-sm font-medium">Short Description</label>
                    <textarea name="short_des" rows="2"
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium
                                                                                                                                                                                                                                                                                                border border-default-medium rounded"></textarea>
                </div>

                <div class="md:col-span-4">
                    <label class="block md-1 text-sm font-medium">Cover Image</label>
                    <input type="file" name="cover_image"
                        class="w-full px-3 py-1 text-sm bg-neutral-secondary-medium                                                                  border border-default-medium rounded">
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
                    <div>
                        <label class="text-sm font-medium">Price *</label>
                        <input name="variants[0][price]" placeholder="Price *" required
                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Discount Price</label>
                        <input name="variants[0][discount_price]" placeholder="Discount Price"
                            class="w-full px-3 py-2 text-sm  bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Stock *</label>
                        <input name="variants[0][stock]" placeholder="Stock *" required
                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>
                    <div>
                        <label class="text-sm font-medium">SKU</label>
                        <input name="variants[0][sku]" placeholder="SKU"
                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>
                    <div class="md:col-span-4">
                        <label class="text-sm font-medium">Image</label>
                        <input type="file" name="variants[0][image]"
                            class="w-full px-3 py-1 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>
                </div>
            </div>

            <!-- ================= VARIABLE PRODUCT ================= -->
            <div id="variableBox" class="hidden mt-6">
                <h4 class="font-medium mb-3">Variants</h4>

                <div id="variantContainer"></div>

                <button type="button" onclick="addVariant()"
                    class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded text-sm px-4 py-2.5 focus:outline-none">
                    + Add Variant
                </button>
            </div>

            <!-- ================= ACTION ================= -->
            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('product') }}" class="px-4 py-2 border rounded">Cancel</a>
                <button class="px-4 py-2 bg-brand text-white rounded">Save Product</button>
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
                                                                                                                                                <div class="mb-4">
                                                                                                                                                                                                                                                                                                                                <div class="grid md:grid-cols-4 gap-3">
                                                                                                                                                                                                                                                                                                                                    <div>
                                                                                                                                                                                                                <label class="text-sm font-medium">Price *</label>
                                                                                                                                                                                                                <input name="variants[${variantIndex}][price]" placeholder="Price *" required
                                                                                                                                                                                                                        class="w-full px-3 py-3 bg-neutral-secondary-medium border border-default-medium rounded-base">
                                                                                                                                                                                                            </div>

                                                                                                                                                                                                            <div>
                                                                                                                                                                                                                <label class="text-sm font-medium">Discount Price</label>
                                                                                                                                                                                                                <input name="variants[${variantIndex}][discount_price]" placeholder="Discount Price"
                                                                                                                                                                                                                        class="w-full px-3 py-3 bg-neutral-secondary-medium border border-default-medium rounded-base">
                                                                                                                                                                                                            </div>
                                                                                                                          <div>
                                                                                                                                                                                                                <label class="text-sm font-medium">Stock *</label>
                                                                                                                                                                                                                <input name="variants[${variantIndex}][stock]" placeholder="Stock *" required
                                                                                                                                                                                                                        class="w-full px-3 py-3 bg-neutral-secondary-medium border border-default-medium rounded-base">
                                                                                                                                                                                                            </div>
                                                                                                                                                                                                            <div>
                                                                                                                                                                                                                <label class="text-sm font-medium">SKU</label>
                                                                                                                                                                                                                <input name="variants[${variantIndex}][sku]" placeholder="SKU"
                                                                                                                                                                                                                        class="w-full px-3 py-3 bg-neutral-secondary-medium border border-default-medium rounded-base">
                                                                                                                                                                                                            </div>
                                                                                                                                                                                                            <div>
                                                                                                                                                                                                                <label class="text-sm font-medium">Image</label>
                                                                                                                                                                                                                <input type="file" name="variants[${variantIndex}][image]"
                                                                                                                                                                                                                        class="w-full px-3 py-2 bg-neutral-secondary-medium
                                                                                                                                                                                                                        border border-default-medium rounded-base">
                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div>
                                                                                                                                                                                                                <label class="text-sm font-medium">Image</label>        
                                                                                                                                                                                                            <select name="variants[${variantIndex}][variations][0][variation_id]" class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">                                                                                                                                                                @foreach($variations as $v)
                                                                                                                                                                                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                                                                                                                                                                            @endforeach
                                                                                                                                                                                                                                                                                                                                    </select>
                                                                                                                                                                                                                                                                                                                                    </div>

                                                                                                                                                                                                                <div>
                                                                                                                                                                                                                <label class="text-sm font-medium">Attribute</label>
                                                                                                                                                                                                                <input name="variants[${variantIndex}][variations][0][option_id]" placeholder="SKU"
                                                                                                                                                                                                                        class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                                                                                                                                                                                                            </div>                                                                                                                                                                                             </div>

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