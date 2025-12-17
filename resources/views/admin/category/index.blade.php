@extends('layout.admin')

@section('content')
    <!-- Breadcrumb -->
    <x-ui.breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Category']
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

    <div class="relative bg-white overflow-x-auto mt-3 shadow-xs rounded-base border border-default">

        <!-- Top bar: Search + Create -->
        <div class="flex items-center justify-between p-4 gap-4">
            <!-- Search -->
            <div class="relative w-full max-w-sm">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-body" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text"
                    class="block w-full ps-9 pe-3 py-2 bg-white border border-default-medium
                                                                                                                                  text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs"
                    placeholder="Search category">
            </div>

            <!-- Create Button -->
            <a href="#" data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium
                                                                                                                          bg-brand text-white rounded-base hover:bg-brand-dark shadow-xs">
                Create Category
            </a>
        </div>

        <!-- Table -->
        <table class="w-full text-sm text-left text-body">
            <thead class="text-sm bg-white border-y border-default-medium">
                <tr>
                    <th class="px-6 py-3 font-medium">#</th>
                    <th class="px-6 py-3 font-medium">Image</th>
                    <th class="px-6 py-3 font-medium">Category Name</th>
                    <th class="px-6 py-3 font-medium">Parent Category</th>
                    <th class="px-6 py-3 font-medium text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $key => $category)
                        <tr class="border-b border-default hover:bg-white">
                            <td class="px-6 py-4">{{ $key + 1 }}</td>

                            <td class="px-6 py-4">
                                <img src="{{ $category->image
                    ? asset($category->image)
                    : 'https://placehold.co/40' }}" class="w-10 h-10 rounded object-cover">
                            </td>

                            <td class="px-6 py-4 font-medium text-heading">
                                {{ $category->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $category->parent?->name ?? '—' }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-3">
                                    <button class="edit-btn" data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                        data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                        data-parent="{{ $category->parent_id }}">
                                        <x-icons.edit class="text-fg-brand" />
                                    </button>
                                    <button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                        data-id="{{ $category->id }}" class="delete-btn">
                                        <x-icons.delete class="text-danger" />
                                    </button>

                                </div>
                            </td>
                        </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-neutral-primary-soft rounded-base shadow-sm p-4 md:p-6">
                <!-- Modal header -->
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-heading">
                        Create new product
                    </h3>
                    <button type="button"
                        class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="crud-modal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('create-category') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                        <!-- Category Name -->
                        <div class="col-span-2">
                            <label class="block mb-2.5 text-sm font-medium text-heading">
                                Category Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name"
                                class="bg-neutral-secondary-medium border border-default-medium
                                                                                                                                  text-heading text-sm rounded-base block w-full px-3 py-2.5"
                                placeholder="Type category name" required>
                        </div>

                        <!-- Parent Category -->
                        <div class="col-span-2">
                            <label class="block mb-2.5 text-sm font-medium text-heading">
                                Parent Category
                            </label>
                            <select name="parent_id"
                                class="block w-full px-3 py-2.5 bg-neutral-secondary-medium
                                                                                                                                   border border-default-medium text-heading text-sm rounded-base">
                                <option value="">Select parent category</option>

                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Image -->
                        <div class="col-span-2">
                            <label class="block mb-2.5 text-sm font-medium text-heading">
                                Category Image
                            </label>
                            <input type="file" name="image"
                                class="bg-neutral-secondary-medium border border-default-medium
                                                                                                                                  text-heading text-sm rounded-base block w-full px-3 py-2.5">
                        </div>

                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit"
                            class="inline-flex items-center text-white bg-brand hover:bg-brand-strong
                                                                                                                               rounded-base text-sm px-4 py-2.5">
                            Add Category
                        </button>

                        <button type="button" data-modal-hide="crud-modal"
                            class="text-body bg-neutral-secondary-medium border border-default-medium
                                                                                                                               rounded-base text-sm px-4 py-2.5">
                            Cancel
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Delete modal--}}
    <div id="delete-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40">
        <div class="bg-white rounded-base p-6 w-full max-w-sm">

            <h3 class="text-lg font-semibold text-heading mb-2">
                Delete Category
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
                Edit Category
            </h3>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Category Name</label>
                        <input type="text" name="name" id="edit-name"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium
                                                                                          border border-default-medium rounded-base">
                    </div>

                    <!-- Parent -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Parent Category</label>
                        <select name="parent_id" id="edit-parent"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium
                                                                                           border border-default-medium rounded-base">
                            <option value="">None</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block mb-1 text-sm font-medium">Change Image</label>
                        <input type="file" name="image"
                            class="w-full px-3 py-2 bg-neutral-secondary-medium
                                                                                          border border-default-medium rounded-base">
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

    {{-- Edit Modal --}}
    <script>
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {

                const id = btn.dataset.id;
                const name = btn.dataset.name;
                const parent = btn.dataset.parent;

                document.getElementById('edit-name').value = name;
                document.getElementById('edit-parent').value = parent ?? '';

                document.getElementById('editForm').action =
                    `/update-category/${id}`;
            });
        });
    </script>


    {{-- Delete Modal--}}
    <script>
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                document.getElementById('deleteForm').action =
                    `/delete-category/${id}`;
            });
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