/**
 * Initial Table
 * =========================
 */
function initialDataTable_wilayahModified(params) {
    $("#table_wilayah_modified")
        .DataTable({
            pageLength: 10,
            bDestroy: true,
            ordering: false,
            serverSide: true,
            processing: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: `${BASE_URL}/api/wilayah-modified`,
            },
            columns: [
                { data: "no", width: "10%" },
                { data: "type" },
                { data: "kode" },
                { data: "kode_provinsi" },
                { data: "kode_kabupaten_kota" },
                { data: "kode_kecamatan" },
                { data: "kode_kelurahan_desa" },
                { data: "nama" },
            ],
            columnDefs: [
                // {
                //     targets: [0, 1, 2, 3, 4, 5, 6, 7],
                //     orderable: false,
                // },
                {
                    targets: [0, 1, 3, 4, 5, 6],
                    className: "align-middle text-center",
                },
                {
                    targets: [2],
                    className: "align-middle text-left",
                },
                {
                    targets: [7],
                    className: "align-middle text-right",
                },
            ],
        })
        .buttons()
        .container()
        .appendTo("#table_wilayah_modified_wraper .col-md-6:eq(0)");
}

initialDataTable_wilayahModified();

/**
 * Download Excel
 * =========================
 */
$("#download_excel").on("click", function (event) {
    event.preventDefault();
    showLoadingSpinner();

    $.ajax({
        type: "GET",
        url: `${BASE_URL}/api/wilayah-modified-excel`,
        success: function (data) {
            hideLoadingSpinner();
            let url = data.data.url;
            window.open(url, "_blank");
        },
        error: function (data) {
            hideLoadingSpinner();
            if (data.status >= 500) {
                showToast("kesalahan pada <b>server</b>", "danger");
            }
        },
    });
});

/**
 * Download Json
 * =========================
 */
$("#download_json").on("click", function (event) {
    event.preventDefault();
    showLoadingSpinner();

    $.ajax({
        type: "GET",
        url: `${BASE_URL}/api/wilayah-modified-json`,
        success: function (data) {
            hideLoadingSpinner();
            let url = data.data.url;
            window.open(url, "_blank");
        },
        error: function (data) {
            hideLoadingSpinner();
            if (data.status >= 500) {
                showToast("kesalahan pada <b>server</b>", "danger");
            }
        },
    });
});
