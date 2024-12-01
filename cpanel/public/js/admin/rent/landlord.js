$(function () {
    $("#btnMainContent").on("click", function () {
        LandlordList($(this));
    });

    $("#active-only").on("click", function () {
        setTimeout(() => {
            $("#btnMainContent").trigger("click");
        }, 500);
    });

    LandlordList($("#btnMainContent"));
});

function LandlordList(btn) {
    let container = btn.closest(".card").find(".card-body");
    let params = {
        type: "LandlordList",
        active: $("#active-only").data("active"),
    };

    // Keep Page Number
    let currentPage = 0;
    // Keep Search
    let currentSearch = "";
    let currentTable = container.find("#modDataTable");
    if (currentTable.length == 1) {
        currentPage = currentTable.DataTable().page();
        currentSearch = currentTable.DataTable().search();
    }
    // ######
    app.sendRequestTo("/admin/rent/landlord/update", btn, params, function (data) {
        // Set Html
        container.html(data.html);

        // Set Table Options
        let tableOptions = app.getDataTableOptions("portrait");
        tableOptions.paging = true;
        tableOptions.order = [[0, "desc"]];
        tableOptions.pageLength = 10;
        tableOptions.lengthMenu = [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"],
        ];

        // Table
        let table = container.find("#modDataTable").DataTable(tableOptions);

        // Keep Search
        table.search(currentSearch).draw();
        // Keep Page Number
        table.page(currentPage).draw("page");

        // Tracking Click on Cell
        container.find("tbody").on("click", "td", function () {
            codeTracking(btn, this.cellIndex, $(this).parent(), table);
        });
    });
}

function codeTracking(btn, idx, row, table) {
    let record = table.row(row).data();
    let entityid = $(row).data("entityid");
    window.location.replace("/admin/rent/landlord/edit/" + entityid);
}
