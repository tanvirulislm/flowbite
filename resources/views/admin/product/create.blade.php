@extends('layout.admin')

@section('content')

    <x-ui.breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Products', 'url' => route('product')],
            ['label' => 'Create Product']
        ]" />

    <div class="bg-neutral-primary-soft border border-default rounded-lg p-6 mt-4">

        <form method="POST" action="{{ route('create-product-post') }}" enctype="multipart/form-data">
            @csrf

            <!-- ================= PRODUCT INFO ================= -->
            <h3 class="text-lg font-semibold mb-4">Product Information</h3>

            <div class="grid md:grid-cols-4 gap-4">
                <div class="md:col-span-4">
                    <label class="block mb-1 text-sm font-medium">Product Name *</label>
                    <input name="title" required placeholder="Product Name *"
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Category *</label>
                    <select name="category_id" required
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Brand</label>
                    <select name="brand_id"
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                        <option value="">None</option>
                        @foreach($brands as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Remark</label>
                    <select name="remark"
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
                    <select name="status"
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                        <option value="active">Active</option>
                        <option value="draft">Draft</option>
                        <option value="archived" default>Archived</option>

                    </select>
                </div>

                <div class="md:col-span-4">
                    <label class="block mb-1 text-sm font-medium">Short Description</label>
                    <textarea name="short_des" rows="2" placeholder="Short Description"
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded"></textarea>
                </div>

                <div class="md:col-span-4">
                    <label class="block mb-1 text-sm font-medium">Long Description</label>
                    <textarea name="long_des" rows="3" placeholder="Long Description"
                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded"></textarea>
                </div>

                <div class="md:col-span-4">
                    <label class="block md-1 text-sm font-medium">Cover Image</label>
                    <input type="file" name="cover_image"
                        class="w-full px-3 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
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
                        <label class="mb-1 text-sm font-medium">Price *</label>
                        <input name="variants[0][price]" placeholder="Price *" required
                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>

                    <div>
                        <label class="mb-1 text-sm font-medium">Discount Price</label>
                        <input name="variants[0][discount_price]" placeholder="Discount Price"
                            class="w-full px-3 py-2 text-sm  bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>
                    <div>
                        <label class="mb-1 text-sm font-medium">Stock *</label>
                        <input name="variants[0][stock]" placeholder="Stock *" required
                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>
                    <div>
                        <label class="mb-1 text-sm font-medium">SKU</label>
                        <input name="variants[0][sku]" placeholder="SKU"
                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>
                    <div class="md:col-span-4">
                        <label class="mb-1 text-sm font-medium">Image</label>
                        <input type="file" name="variants[0][image]"
                            class="w-full px-3 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                    </div>
                </div>
            </div>

            <!-- ================= VARIABLE PRODUCT ================= -->
            <div id="variableBox" class="hidden mt-6">
                <h4 class="font-medium mb-3">Pricing and Stock with Variants</h4>

                <div id="variantContainer"></div>

                <button type="button" onclick="addVariant()"
                    class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded text-sm px-4 py-2.5 focus:outline-none">
                    + Add Variant
                </button>
            </div>

            <!-- ================= ACTION ================= -->
            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('product') }}" class="px-4 py-2 border rounded">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-brand text-white rounded">Save Product</button>
            </div>

        </form>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        /* ===============================
           VARIATIONS DATA FROM BACKEND
        ================================ */
        const VARIATIONS = @json($variations);

        /* ===============================
           SIMPLE / VARIABLE TOGGLE
        ================================ */
        let variantIndex = 0;

        document.getElementById('isVariable').addEventListener('change', e => {
            document.getElementById('simpleBox').classList.toggle('hidden', e.target.checked);
            document.getElementById('variableBox').classList.toggle('hidden', !e.target.checked);

            if (e.target.checked && variantIndex === 0) {
                addVariant();
            }
        });

        /* ===============================
           ADD VARIANT
        ================================ */
        function addVariant() {
            const html = `
                                                                            <div class="mb-6">

                                                                                <div class="grid md:grid-cols-4 gap-3">
                                                                                    <div>
                                                                                        <label class="mb-1 font-medium text-sm">Price *</label>
                                                                                        <input name="variants[${variantIndex}][price]" required placeholder="Price *"
                                                                                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                                                                                    </div>

                                                                                    <div>
                                                                                        <label class="mb-1 font-medium text-sm">Discount Price</label>
                                                                                        <input name="variants[${variantIndex}][discount_price]" placeholder="Discount Price"
                                                                                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                                                                                    </div>

                                                                                    <div>
                                                                                        <label class="mb-1 font-medium text-sm">Stock *</label>
                                                                                        <input name="variants[${variantIndex}][stock]" required placeholder="Stock *"
                                                                                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                                                                                    </div>

                                                                                    <div>
                                                                                        <label class="mb-1 font-medium text-sm">SKU</label>
                                                                                        <input name="variants[${variantIndex}][sku]" placeholder="SKU"
                                                                                            class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="mt-3 md:col-span-4">
                                                                                    <label class="mb-1 font-medium text-sm">Image</label>
                                                                                    <input type="file" class="w-full px-3 text-sm bg-neutral-secondary-medium border border-default-medium rounded" name="variants[${variantIndex}][image]">
                                                                                </div>

                                                                                <div id="variationBox_${variantIndex}" class="mt-4"></div>

                                                                                <button type="button"
                                                                                    onclick="addVariation(${variantIndex})"
                                                                                    class="text-blue-600 text-sm mt-2">
                                                                                    + Add Variation
                                                                                </button>

                                                                                <button type="button"
                                                                                    onclick="this.parentElement.remove()"
                                                                                    class="text-red-600 text-sm mt-2 ml-4">
                                                                                    Remove Variant
                                                                                </button>

                                                                            </div>
                                                                            `;

            document.getElementById('variantContainer')
                .insertAdjacentHTML('beforeend', html);

            variantIndex++;
        }

        /* ===============================
           ADD VARIATION (PER VARIANT)
        ================================ */
        function addVariation(vIndex) {
            const box = document.getElementById(`variationBox_${vIndex}`);
            const rowIndex = box.children.length;

            const html = `
                                                                            <div class="grid md:grid-cols-3 gap-3 mt-2 items-end">

                                                                                <div>
                                                                                    <label class="mb-1 font-medium text-sm">Variation</label>
                                                                                    <select
                                                                                        name="variants[${vIndex}][variations][${rowIndex}][variation_id]"
                                                                                        onchange="loadAttributes(this, ${vIndex}, ${rowIndex})"
                                                                                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                                                                                        <option value="">Select</option>
                                                                                        ${VARIATIONS.map(v => `<option value="${v.id}">${v.name}</option>`).join('')}
                                                                                    </select>
                                                                                </div>

                                                                                <div>
                                                                                    <label class="mb-1 font-medium text-sm">Attribute</label>
                                                                                    <select
                                                                                        id="attr_${vIndex}_${rowIndex}"
                                                                                        name="variants[${vIndex}][variations][${rowIndex}][option_id]"
                                                                                        class="w-full px-3 py-2 text-sm bg-neutral-secondary-medium border border-default-medium rounded">
                                                                                        <option value="">Select</option>
                                                                                    </select>
                                                                                </div>

                                                                                <button type="button"
                                                                                    onclick="this.parentElement.remove()"
                                                                                    class="text-red-600 text-sm flex items-start mb-2">
                                                                                    <x-icons.delete class="inline w-4 h-4 mr-1" />
                                                                                </button>

                                                                            </div>
                                                                            `;

            box.insertAdjacentHTML('beforeend', html);
        }

        /* ===============================
           FILTER ATTRIBUTES BY VARIATION
        ================================ */
        function loadAttributes(select, vIndex, rowIndex) {
            const variationId = select.value;
            const attrSelect = document.getElementById(`attr_${vIndex}_${rowIndex}`);

            attrSelect.innerHTML = `<option value="">Select</option>`;
            if (!variationId) return;

            const variation = VARIATIONS.find(v => v.id == variationId);
            if (!variation) return;

            variation.attributes.forEach(attr => {
                attrSelect.innerHTML +=
                    `<option value="${attr.id}">${attr.name}</option>`;
            });
        }
    </script>



@endsection