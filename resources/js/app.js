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
