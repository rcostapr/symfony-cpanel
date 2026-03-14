$(function () {
    // module_form Add & Edit
    $("body").on("submit", "form[name=module_form]", function (e) {
        e.preventDefault();

        let form = $(this);
        let data = form.serialize();
        $.ajax({
            url: form.attr("action"),
            method: form.attr("method"),
            data: data,
            success: function (response) {
                if (!response.success) {
                    toastr.error(response.message);
                    return false;
                }

                toastr.success(response.message);
                $("#modaleditmodule").modal("hide");
                $("#modaladdmodule").modal("hide");
                $("#btn-main-content").trigger("click");
            },
            error: function (err, status, error) {
                toastr.error("An error occurred while processing your request. " + error);
            },
        });
    });

    $("#btn-main-content").on("click", function () {
        getContent($(this));
    });

    $("#btn-main-content").trigger("click");
});

// get content
function getContent(btn, searchStr = null) {
    let container = btn.closest(".card").find(".card-body");
    $.ajax({
        url: "/admin/modules/get",
        method: "POST",
        success: function (response) {
            if (!response.success) {
                toastr.error(response.message);
                return false;
            }

            container.html(response.html);
            // DataTable modules-table
            container.find("table").DataTable();
            setModuleEditBtn();
        },
        error: function (err, status, error) {
            toastr.error("An error occurred while processing your request.");
        },
    });
}

function setModuleEditBtn() {
    // btn-edit-content
    $(".btn-edit-module").on("click", function () {
        let id = $(this).data("id");
        $.ajax({
            url: `/admin/modules/get/${id}`,
            method: "POST",
            success: function (response) {
                if (!response.success) {
                    toastr.error(response.message);
                    return false;
                }

                $("#modaleditmodule .modal-body").html(response.html);
                $("#modaleditmodule").modal("show");
            },
            error: function (err, status, error) {
                toastr.error("An error occurred while processing your request.");
            },
        });
    });
}
