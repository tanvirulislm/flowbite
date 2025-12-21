import 'flowbite';
import './bootstrap';
import { DataTable } from "simple-datatables";

document.addEventListener("DOMContentLoaded", () => {
    const table = document.querySelector("#category-datatable");

    if (table) {
        new DataTable(table, {
            searchable: true,
            columns: [
        { select: 4, sortable: false },
         { select: 1, sortable: false }
    ],
            perPage: 10,
            perPageSelect: [5, 10, 20, 50],
            fixedHeight: false,
            labels: {
                placeholder: "Search categories...",
                perPage: "Rows per page",
                noRows: "No categories found",
                info: "Showing {start} to {end} of {rows} categories",
            },
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const table = document.querySelector("#brand-datatable");

    if (table) {
        new DataTable(table, {
            searchable: true,
            columns: [
                { select: 3, sortable: false },
                { select: 1, sortable: false },
            ],
            perPage: 10,
            perPageSelect: [5, 10, 20, 50],
            fixedHeight: false,
            labels: {
                placeholder: "Search brands...",
                perPage: "Rows per page",
                noRows: "No brands found",
                info: "Showing {start} to {end} of {rows} brands",
            },
        });
    }
});


document.addEventListener("DOMContentLoaded", () => {
    const table = document.querySelector("#customer-datatable");

    if (table) {
        new DataTable(table, {
            searchable: true,
            perPage: 10,
            perPageSelect: [5, 10, 20, 50],
            fixedHeight: false,
            labels: {
                placeholder: "Search customers...",
                perPage: "Rows per page",
                noRows: "No customers found",
                info: "Showing {start} to {end} of {rows} customers",
            },
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const table = document.querySelector("#supplier-datatable");

    if (table) {
        new DataTable(table, {
            searchable: true,
            perPage: 10,
            perPageSelect: [5, 10, 20, 50],
            fixedHeight: false,
            labels: {
                placeholder: "Search suppliers...",
                perPage: "Rows per page",
                noRows: "No suppliers found",
                info: "Showing {start} to {end} of {rows} suppliers",
            },
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const table = document.querySelector("#variation-datatable");

    if (table) {
        new DataTable(table, {
            searchable: true,
            perPage: 10,
            columns: [
                { select: 3, sortable: false },
                { select: 0, sortable: false },
                { select: 2, sortable: false },
            ],
            perPageSelect: [5, 10, 20, 50],
            fixedHeight: false,
            labels: {
                placeholder: "Search variations...",
                perPage: "Rows per page",
                noRows: "No variations found",
                info: "Showing {start} to {end} of {rows} variations",
            },
        });
    }
});

