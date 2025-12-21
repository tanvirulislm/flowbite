@extends('layout.admin')

@section('content')
    <!-- Breadcrumb -->
    <x-ui.breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Variations']
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
                Create Variation
            </a>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="variation-datatable" class="w-full text-sm text-left text-body">
                <thead class="text-sm bg-white border-y border-default-medium">
                    <tr>
                        <th class="px-6 py-3 font-medium">#</th>
                        <th class="px-6 py-3 font-medium">Variation</th>
                        <th class="px-6 py-3 font-medium">Attribute</th>
                        <th class="px-6 py-3 font-medium text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($variations as $key => $variation)
                        <tr class="border-b border-default hover:bg-white">
                            <td class="px-6 py-4">{{ $key + 1 }}</td>

                            <td class="px-6 py-4 font-medium text-heading">
                                {{ $variation->name }}
                            </td>

                            <td class="px-6 py-4 font-medium text-heading">
                                @forelse($variation->attributes as $attr)
                                    <span
                                        class="bg-neutral-secondary-medium ml-1.5 border border-default-medium text-xs px-2 py-0.5 rounded">
                                        {{ $attr->name }}
                                    </span>
                                @empty
                                    <span class="text-body-subtle text-xs">No attributes</span>
                                @endforelse

                                <br>
                                <button class="edit-btn text-sm underline text-fg-brand cursor-pointer mt-1.5"
                                    data-id="{{ $variation->id }}" data-name="{{ $variation->name }}"
                                    data-attributes="{{ $variation->attributes->pluck('name')->implode(', ') }}"
                                    data-route="{{ route('update-variation', ':id') }}" data-modal-target="edit-modal"
                                    data-modal-toggle="edit-modal">
                                    Configure Attributes
                                </button>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-3">
                                    <button class="edit-btn" data-id="{{ $variation->id }}" data-name="{{ $variation->name }}"
                                        data-attributes="{{ $variation->attributes->pluck('name')->implode(', ') }}"
                                        data-route="{{ route('update-variation', ':id') }}" data-modal-target="edit-modal"
                                        data-modal-toggle="edit-modal">
                                        <x-icons.edit class="text-fg-brand" />
                                    </button>

                                    <button class="delete-btn" data-id="{{ $variation->id }}"
                                        data-route="{{ route('delete-variation', ':id') }}" data-modal-target="delete-modal"
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
                Create New Variation
            </h3>

            <form action="{{ route('create-variation') }}" method="POST">
                @csrf

                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Variation</label>
                        <input type="text" required name="variation_name" placeholder="Color" id="create-name"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Attribute</label>
                        <input type="text" name="attributes" id="create-attribute" placeholder="Red, Green, Blue"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                        <p id="helper-text-explanation" class="mt-2.5 text-sm text-body">Comma separated values, e.g. Red,
                            Blue, Green</p>

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
                Delete Variation with Attributes?
            </h3>
            <p class="text-sm text-body mb-4">
                Are you sure you want to delete this variation? This action cannot be undone.
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
                Edit Variation
            </h3>

            <form id="editForm" method="POST">
                @csrf

                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Name</label>
                        <input type="text" name="variation_name" id="edit-name"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Attribute</label>
                        <input type="text" name="attributes" id="edit-attribute"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                        <p id="helper-text-explanation" class="mt-2.5 text-sm text-body">Comma separated values, e.g. Red,
                            Blue, Green</p>

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
                const attributes = editBtn.dataset.attributes;
                const route = editBtn.dataset.route;

                document.getElementById('edit-name').value = name ?? '';
                document.getElementById('edit-attribute').value = attributes ?? '';

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