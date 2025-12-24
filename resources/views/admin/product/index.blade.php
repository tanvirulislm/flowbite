@extends('layout.admin')

@section('content')
    <!-- Breadcrumb -->
    <x-ui.breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Products',]
        ]" />


    {{-- Alert Message --}}
    @if(session('success'))
        <x-ui.alert type="success" :message="session('success')" />
    @endif

    @if(session('error'))
        <x-ui.alert type="danger" :message="session('error')" />
    @endif

    @if(session('warning'))
        <x-ui.alert type="warning" :message="session('warning')" />
    @endif


    {{-- Main Page --}}

    <div class="relative bg-neutral-primary-soft overflow-x-auto mt-3 shadow-xs rounded-base border border-default">

        <!-- Top bar: Search + Create -->
        <div class="flex items-end justify-end p-4 gap-4">
            <!-- Create Button -->
            <a href="{{ route('create-product') }}"
                class="px-4 py-2 bg-brand text-white rounded hover:bg-brand-dark transition">
                Create Product
            </a>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="customer-datatable" class="w-full text-sm text-left text-body">
                <thead class="text-sm bg-white border-y border-default-medium">
                    <tr>
                        <th class="px-6 py-3 font-medium">#</th>
                        <th class="px-6 py-3 font-medium">Name</th>
                        <th class="px-6 py-3 font-medium">Brand</th>
                        <th class="px-6 py-3 font-medium">Remark</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $key => $product)
                        <tr class="border-b border-default hover:bg-white">
                            <td class="px-6 py-4">{{ $key + 1 }}</td>

                            <td class="px-6 py-4 font-medium text-heading">
                                {{ $product->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $product->brand_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->remark }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->status }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-3">
                                    <button class="see-btn">
                                        <x-icons.see class="text-fg-primary" />
                                    </button>

                                    <button>
                                        <x-icons.edit class="text-fg-brand" />
                                    </button>

                                    <button class="delete-btn" data-id="{{ $product->id }}"
                                        data-route="{{ route('delete-product', ':id') }}" data-modal-target="delete-modal"
                                        data-modal-toggle="delete-modal">
                                        <x-icons.delete class="text-danger" />
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


    {{-- Delete modal--}}
    <div id="delete-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40">
        <div class="bg-white rounded-base p-6 w-full max-w-sm">

            <h3 class="text-lg font-semibold text-heading mb-2">
                Delete Customer
            </h3>
            <p class="text-sm text-body mb-4">
                This action cannot be undone.
            </p>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-end gap-3">
                    <button type="button" data-modal-hide="delete-modal" class="px-4 py-2 text-sm border rounded-base">
                        Cancel
                    </button>

                    <button type="submit" class="px-4 py-2 text-sm bg-danger text-white rounded-base">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>



    {{-- =====================
    DELETE BUTTON
    ====================== --}}

    <script>
        document.addEventListener('click', function (e) {

            /* =====================
               DELETE BUTTON
            ====================== */
            const deleteBtn = e.target.closest('.delete-btn');
            if (deleteBtn) {
                const id = deleteBtn.dataset.id;
                const route = deleteBtn.dataset.route;

                document.getElementById('deleteForm').action =
                    route.replace(':id', id);
            }

        });
    </script>



    {{-- Hide Alert After 3s --}}
    <script>
        setTimeout(() => {
            document.querySelectorAll('[role="alert"]').forEach(alert => {
                alert.classList.add('opacity-0', 'transition');
                setTimeout(() => alert.remove(), 300);
            });
        }, 3000);
    </script>


@endsection