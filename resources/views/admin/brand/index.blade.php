@extends('layout.admin')

@section('content')
    <!-- Breadcrumb -->
    <x-ui.breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Brand']
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
            <a href="#" data-modal-target="create-modal" data-modal-toggle="create-modal"
                class="px-4 py-2 bg-brand text-white rounded-base">
                Create Brand
            </a>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="brand-datatable" class="w-full text-sm text-left text-body">
                <thead class="text-sm bg-white border-y border-default-medium">
                    <tr>
                        <th class="px-6 py-3 font-medium">#</th>
                        <th class="px-6 py-3 font-medium">Image</th>
                        <th class="px-6 py-3 font-medium">Brand Name</th>
                        <th class="px-6 py-3 font-medium text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($brands as $key => $brand)
                                <tr class="border-b border-default hover:bg-white">
                                    <td class="px-6 py-4">{{ $key + 1 }}</td>

                                    <td class="px-6 py-4">
                                        <img src="{{ $brand->image
                        ? asset($brand->image)
                        : 'https://placehold.co/40' }}" class="w-10 h-10 rounded object-cover">
                                    </td>

                                    <td class="px-6 py-4 font-medium text-heading">
                                        {{ $brand->name }}
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="inline-flex items-center gap-3">
                                            <button class="edit-btn" data-id="{{ $brand->id }}" data-name="{{ $brand->name }}"
                                                data-route="{{ route('update-brand', ':id') }}" data-modal-target="edit-modal"
                                                data-modal-toggle="edit-modal">
                                                <x-icons.edit class="text-fg-brand" />
                                            </button>
                                            <button class="delete-btn" data-id="{{ $brand->id }}"
                                                data-route="{{ route('delete-brand', ':id') }}" data-modal-target="delete-modal"
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


    {{-- Create Modal --}}
    <div id="create-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40">

        <div class="bg-white rounded-base shadow-sm w-full max-w-md p-6">

            <h3 class="text-lg font-medium text-heading mb-4">
                Create New Brand
            </h3>

            <form action="{{ route('create-brand') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Brand Name</label>
                        <input type="text" name="name" id="create-name"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>
                   

                    <!-- Image -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Brand Logo</label>
                        <input type="file" name="image"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" data-modal-hide="create-modal" class="px-4 py-2 border rounded-base">
                        Cancel
                    </button>

                    <button type="submit" class="px-4 py-2 bg-brand text-white rounded-base">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- Delete modal--}}
    <div id="delete-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40">
        <div class="bg-white rounded-base p-6 w-full max-w-sm">

            <h3 class="text-lg font-semibold text-heading mb-2">
                Delete Brand
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

    {{-- Edit modal --}}
    <div id="edit-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40">

        <div class="bg-white rounded-base shadow-sm w-full max-w-md p-6">

            <h3 class="text-lg font-medium text-heading mb-4">
                Edit Brand
            </h3>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Brand Name</label>
                        <input type="text" name="name" id="edit-name"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Change Image</label>
                        <input type="file" name="image"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" data-modal-hide="edit-modal" class="px-4 py-2 border rounded-base">
                        Cancel
                    </button>

                    <button type="submit" class="px-4 py-2 bg-brand text-white rounded-base">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- =====================
    EDIT & DELETE BUTTON
    ====================== --}}

    <script>
        document.addEventListener('click', function (e) {

            /* =====================
               EDIT BUTTON
            ====================== */
            const editBtn = e.target.closest('.edit-btn');
            if (editBtn) {
                const id = editBtn.dataset.id;
                const name = editBtn.dataset.name;
                const route = editBtn.dataset.route;

                document.getElementById('edit-name').value = name ?? '';

                document.getElementById('editForm').action =
                    route.replace(':id', id);
            }

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