@extends('layout.admin')

@section('content')
<!-- Breadcrumb -->
<nav class="flex p-3 bg-white border border-default-medium rounded-base"
    aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
                <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                </svg>
                Home
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center space-x-1.5">
                <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m9 5 7 7-7 7" />
                </svg>
                <span class="inline-flex items-center text-sm font-medium text-body-subtle">Category</span>
            </div>
        </li>
    </ol>
</nav>

{{-- Main Page --}}

<div class="relative bg-white overflow-x-auto mt-3 shadow-xs rounded-base border border-default">

    <!-- Top bar: Search + Create -->
    <div class="flex items-center justify-between p-4 gap-4">
        <!-- Search -->
        <div class="relative w-full max-w-sm">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-body" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                          d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
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
                  bg-brand text-white rounded hover:bg-brand-dark shadow-xs">
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
              : 'https://placehold.co/40' }}"
             class="w-10 h-10 rounded object-cover">
    </td>

    <td class="px-6 py-4 font-medium text-heading">
        {{ $category->name }}
    </td>

    <td class="px-6 py-4">
        {{ $category->parent?->name ?? '—' }}
    </td>

    <td class="px-6 py-4 text-right">
        <div class="inline-flex items-center gap-3">
            <a href="#">
                <x-icons.edit class="text-fg-brand" />
            </a>

                <a href="#">
                    <x-icons.delete class="text-danger" />
                </a>
        </div>
    </td>
</tr>
@endforeach
</tbody>

    </table>
</div>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
            <!-- Modal header -->
            <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-heading">
                    Create new product
                </h3>
                <button type="button" class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="crud-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('create-category') }}"
      method="POST"
      enctype="multipart/form-data">
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

    <div class="flex items-center gap-4 border-t border-default pt-4 md:pt-6">
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

@endsection