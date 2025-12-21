@extends('layout.admin')

@section('content')
    <!-- Breadcrumb -->
    <x-ui.breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Suppliers']
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
                Create Supplier
            </a>
        </div>

        <!-- Table -->
        <div class="p-4">
            <table id="supplier-datatable" class="w-full text-sm text-left text-body">
                <thead class="text-sm bg-white border-y border-default-medium">
                    <tr>
                        <th class="px-6 py-3 font-medium">#</th>
                        <th class="px-6 py-3 font-medium">Name</th>
                        <th class="px-6 py-3 font-medium">Email</th>
                        <th class="px-6 py-3 font-medium">Phone</th>
                        <th class="px-6 py-3 font-medium">City</th>
                        <th class="px-6 py-3 font-medium text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($parties as $key => $party)
                        <tr class="border-b border-default hover:bg-white">
                            <td class="px-6 py-4">{{ $key + 1 }}</td>

                            <td class="px-6 py-4 font-medium text-heading">
                                {{ $party->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $party->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $party->phone }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $party->city }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-3">
                                    <button class="see-btn" data-name="{{ $party->name }}" data-email="{{ $party->email }}"
                                        data-phone="{{ $party->phone }}" data-city="{{ $party->city }}"
                                        data-address="{{ $party->address }}" data-modal-target="view-modal"
                                        data-modal-toggle="view-modal">
                                        <x-icons.see class="text-fg-primary" />
                                    </button>

                                    <button class="edit-btn" data-id="{{ $party->id }}" data-name="{{ $party->name }}"
                                        data-email="{{ $party->email }}" data-phone="{{ $party->phone }}"
                                        data-city="{{ $party->city }}" data-address="{{ $party->address }}"
                                        data-route="{{ route('update-party', ':id') }}" data-modal-target="edit-modal"
                                        data-modal-toggle="edit-modal">
                                        <x-icons.edit class="text-fg-brand" />
                                    </button>

                                    <button class="delete-btn" data-id="{{ $party->id }}"
                                        data-route="{{ route('delete-party', ':id') }}" data-modal-target="delete-modal"
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
                Create New Supplier
            </h3>

            <form action="{{ route('create-party') }}" method="POST">
                @csrf

                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Name</label>
                        <input type="text" name="name" id="create-name"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Email</label>
                        <input type="email" name="email" id="create-email"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Phone</label>
                        <input type="tel" name="phone" id="create-phone"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">City</label>
                        <input type="text" name="city" id="create-city"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Address</label>
                        <input type="text" name="address" id="create-address"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div class="hidden">
                        <label class="block mb-1 text-sm font-medium">Type</label>
                        <input type="text" name="type" id="create-type" value="supplier"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>


                    <!-- Image -->
                    {{-- <div>
                        <label class="block mb-1 text-sm font-medium">Brand Logo</label>
                        <input type="file" name="image"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div> --}}

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
                Delete Supplier
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
                Edit Supplier
            </h3>

            <form id="editForm" method="POST">
                @csrf

                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Name</label>
                        <input type="text" name="name" id="edit-name"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Email</label>
                        <input type="email" name="email" id="edit-email"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Phone</label>
                        <input type="tel" name="phone" id="edit-phone"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">City</label>
                        <input type="text" name="city" id="edit-city"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Address</label>
                        <input type="text" name="address" id="edit-address"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <div class="hidden">
                        <label class="block mb-1 text-sm font-medium">Type</label>
                        <input type="text" name="type" id="edit-type" value="supplier"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div>

                    <!-- Image -->
                    {{-- <div>
                        <label class="block mb-1 text-sm font-medium">Change Image</label>
                        <input type="file" name="image"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium border border-default-medium rounded-base">
                    </div> --}}

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


    {{-- View modal --}}
    <div id="view-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40">
        <div class="bg-white rounded-base shadow-sm w-full max-w-md p-6">

            <h3 class="text-lg font-medium text-heading mb-4">
                Supplier Details
            </h3>

            <div class="space-y-3 text-sm">

                <div>
                    <span class="font-medium text-body">Name:</span>
                    <span id="view-name" class="text-heading"></span>
                </div>

                <div>
                    <span class="font-medium text-body">Email:</span>
                    <span id="view-email" class="text-heading"></span>
                </div>

                <div>
                    <span class="font-medium text-body">Phone:</span>
                    <span id="view-phone" class="text-heading"></span>
                </div>

                <div>
                    <span class="font-medium text-body">City:</span>
                    <span id="view-city" class="text-heading"></span>
                </div>

                <div>
                    <span class="font-medium text-body">Address:</span>
                    <span id="view-address" class="text-heading"></span>
                </div>

            </div>

            <div class="flex justify-end mt-6">
                <button type="button" data-modal-hide="view-modal" class="px-4 py-2 border rounded-base">
                    Close
                </button>
            </div>
        </div>
    </div>



    {{-- =====================
    EDIT, SEE & DELETE BUTTON
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
                const email = editBtn.dataset.email;
                const phone = editBtn.dataset.phone;
                const city = editBtn.dataset.city;
                const address = editBtn.dataset.address;
                const route = editBtn.dataset.route;

                document.getElementById('edit-name').value = name ?? '';
                document.getElementById('edit-email').value = email ?? '';
                document.getElementById('edit-phone').value = phone ?? '';
                document.getElementById('edit-city').value = city ?? '';
                document.getElementById('edit-address').value = address ?? '';

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

        document.addEventListener('click', function (e) {

            /* =====================
               SEE BUTTON
            ====================== */
            const seeBtn = e.target.closest('.see-btn');
            if (seeBtn) {
                document.getElementById('view-name').textContent =
                    seeBtn.dataset.name ?? '—';

                document.getElementById('view-email').textContent =
                    seeBtn.dataset.email ?? '—';

                document.getElementById('view-phone').textContent =
                    seeBtn.dataset.phone ?? '—';

                document.getElementById('view-city').textContent =
                    seeBtn.dataset.city ?? '—';

                document.getElementById('view-address').textContent =
                    seeBtn.dataset.address ?? '—';
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