@extends('layout.admin')

@section('content')
    {{-- Stats --}}
    @include('components.admin.stats')

    {{-- Recent Orders --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-6 mt-6">
        <!-- Recent Orders -->
        <div class="bg-neutral-primary-soft border border-gray-200 rounded-xl shadow-sm p-6">

            <!-- Header -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                <p class="text-sm text-gray-500 mt-1">
                    Latest orders placed by customers in your store.
                </p>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                        <tr>
                            <th class="px-4 py-3">Order</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right"></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        <!-- Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">
                                <div>
                                    <p class="font-medium text-gray-900">#ORD-1024</p>
                                    <p class="text-xs text-gray-500">30 Mar 2025</p>
                                </div>
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Neil+Sims"
                                        alt="">
                                    <div>
                                        <p class="font-medium text-gray-900">Neil Sims</p>
                                        <p class="text-xs text-gray-500">neil@domain.com</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">$899</td>

                            <td class="px-4 py-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-medium rounded-full border-yellow-500 border  bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            </td>

                            <td class="px-4 py-4 text-right">
                                <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal"
                                    class="" type="button">
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="3"
                                            d="M6 12h.01m6 0h.01m5.99 0h.01" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="dropdownDotsHorizontal"
                                    class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44 dark:divide-gray-600">
                                    <ul class="p-2 text-sm text-body font-medium"
                                        aria-labelledby="dropdownMenuIconHorizontalButton">
                                        <li>
                                            <a href="#"
                                                class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Delete</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Approve</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Decline</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">
                                <div>
                                    <p class="font-medium text-gray-900">#ORD-1023</p>
                                    <p class="text-xs text-gray-500">27 Mar 2025</p>
                                </div>
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Bonnie+Green"
                                        alt="">
                                    <div>
                                        <p class="font-medium text-gray-900">Bonnie Green</p>
                                        <p class="text-xs text-gray-500">bonnie@domain.com</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">$245</td>

                            <td class="px-4 py-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-medium border border-green-500 rounded-full bg-green-100 text-green-700">
                                    Completed
                                </span>
                            </td>

                            <td class="px-4 py-4 text-right">
                                <button class="text-gray-400 hover:text-gray-600">⋯</button>
                            </td>
                        </tr>

                        <!-- Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">
                                <div>
                                    <p class="font-medium text-gray-900">#ORD-1022</p>
                                    <p class="text-xs text-gray-500">25 Mar 2025</p>
                                </div>
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Sarah+Ahmed"
                                        alt="">
                                    <div>
                                        <p class="font-medium text-gray-900">Sarah Ahmed</p>
                                        <p class="text-xs text-gray-500">sarah@domain.com</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">$129</td>

                            <td class="px-4 py-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-medium border border-red-500 rounded-full bg-red-100 text-red-700">
                                    Failed
                                </span>
                            </td>

                            <td class="px-4 py-4 text-right">
                                <button class="text-gray-400 hover:text-gray-600">⋯</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Footer CTA -->
            <div class="mt-6">
                <a href="#"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-300 rounded-lg hover:bg-gray-50">
                    View all orders →
                </a>
            </div>

        </div>



        <!-- Recent Customers -->
        <div class="bg-neutral-primary-soft border border-gray-200 rounded-xl shadow-sm p-6">

            <!-- Header -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Transactions</h3>
                <p class="text-sm text-gray-500 mt-1">
                    View your transactions, gaining a comprehensive overview of all financial activities within your
                    account.
                </p>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                        <tr>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Due Date</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">

                        <!-- Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100">
                                        🍎
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">iPhone 15 Pro Max</p>
                                        <p class="text-xs text-gray-500">Apple Inc.</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 font-medium text-gray-900">$899</td>
                            <td class="px-4 py-4">30 Mar 2025</td>
                            <td class="px-4 py-4">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <button class="text-gray-400 hover:text-gray-600">
                                    ⋯
                                </button>
                            </td>
                        </tr>

                        <!-- Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-indigo-100">
                                        🎮
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Nitro Basic for 12 months</p>
                                        <p class="text-xs text-gray-500">Discord Inc.</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 font-medium text-gray-900">$99</td>
                            <td class="px-4 py-4">27 Mar 2025</td>
                            <td class="px-4 py-4">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                    Completed
                                </span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <button class="text-gray-400 hover:text-gray-600">⋯</button>
                            </td>
                        </tr>

                        <!-- Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-red-100">
                                        🎵
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Spotify Platinum</p>
                                        <p class="text-xs text-gray-500">Spotify Inc.</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 font-medium text-gray-900">$29</td>
                            <td class="px-4 py-4">05 Mar 2025</td>
                            <td class="px-4 py-4">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                    Failed
                                </span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <button class="text-gray-400 hover:text-gray-600">⋯</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Footer CTA -->
            <div class="mt-6">
                <a href="#"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-300 rounded-lg hover:bg-gray-50">
                    View all transactions →
                </a>
            </div>

        </div>



    </div>




@endsection