import "./blockUI/jquery.blockUI.js";
export function scrollToElement(element) {
    if (element) {
        $("html,body").animate(
            {
                scrollTop: element.offset().top - $(window).height() / 2,
            },
            1000
        );
    }
}

export function clearOptions(element) {
    let options = element.find("option");
    options.each(function (index) {
        option = $(this);
        if (option.val() == "") {
            option.prop("selected", true);
        } else {
            option.remove();
        }
    });
}

export function sendRequestTo(url, btn, params, callback = null) {
    btn.addClass("btn-spin");
    let container = btn.closest(".card").find(".card-body");
    if (container.length > 0) {
        $(container[0]).block(getBlockOptions());
    }
    $.ajax({
        type: "POST",
        url: url,
        data: params,
        dataType: "json",
        success: function (data) {
            btn.removeClass("btn-spin");
            if (container.length > 0) {
                container.unblock();
            }
            if (data.error) {
                toastr.warning(data.error, "Aviso:");
                return false;
            }

            if (data.session) {
                toastr.error(data.session, "Sessão Expirou:");
                setTimeout(function () {
                    location.replace("/");
                }, 2000);
                return false;
            }

            if (data.success === true) {
                if (callback) {
                    callback(data);
                }
            }

            if (data.success === false) {
                toastr.error(data.info, "Aviso:", {
                    onHidden: function () {
                        if (data.location) {
                            window.location.replace(data.location);
                        }
                    },
                    timeOut: 800,
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if (container.length > 0) {
                container.unblock();
            }
            btn.removeClass("btn-spin");
            let info = xhr.status + "<br>" + thrownError;
            toastr.error(info, "Aviso:");
        },
    });
}

export function sendFormTo(url, formData, callback = null) {
    // Block Screen
    let blockOptions = getBlockOptions();
    $.blockUI(blockOptions);
    // Prevent other form button to be pushed
    let btn = $("body").find("button[type=submit]");
    btn.attr("disabled", true);
    // Set activity
    $.ajax({
        method: "POST",
        type: "POST",
        url: url,
        data: formData,
        enctype: "multipart/form-data",
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {
            // Unblock Screen
            $.unblockUI();
            // Release buttons
            btn.attr("disabled", false);
            // Remove Spinning
            $(".btn-spin").removeClass("btn-spin");

            if (data.success === true) {
                if (callback) {
                    callback(data);
                    return true;
                }
            }

            if (data.session) {
                toastr.error(data.session, "Sessão Expirou:");
                setTimeout(function () {
                    window.location("/");
                }, 2000);
                return false;
            }

            if (data.error) {
                toastr.warning(data.error, "Aviso:");
                return false;
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $(".btn-spin").removeClass("btn-spin");
            toastr.error(thrownError, "Error: " + xhr.status, {
                onHidden: function () {
                    // Unblock Screen
                    $.unblockUI();
                    // Release buttons
                    btn.attr("disabled", false);
                },
            });
            return false;
        },
    });
}

export function getDataTableOptions(orientation = null) {
    let setOrientation = "landscape";
    if (orientation && (orientation == "landscape" || orientation == "portrait")) {
        setOrientation = orientation;
    }
    return {
        dom: "lBfrtip",
        buttons: [
            {
                extend: "copy",
                className: "btn btn-copy btn-color-white btn-background",
                title: "Copiar",
            },
            { extend: "csv", className: "btn btn-csv" },
            { extend: "excel", className: "btn btn-excel" },
            {
                extend: "pdf",
                className: "btn btn-pdf",
                orientation: setOrientation,
                pageSize: "A4",
                customize: function (doc) {
                    doc.pageMargins = [15, 10, 10, 10];
                    doc.defaultStyle.fontSize = 6;
                    doc.styles.tableHeader.fontSize = 7;
                    doc.styles.tableFooter.fontSize = 7;
                    doc.styles.title.fontSize = 10;
                },
                footer: true,
            },
        ],
        language: {
            url: "/js/vendor/i18n/datatables/pt_pt.json",
        },
        language: {
            decimal: ".",
            emptyTable: "Sem Dados Disponíveis",
            info: "Mostrar _START_ até _END_ de _TOTAL_ registos",
            infoEmpty: "Sem Registos",
            infoFiltered: "(filtro de um total de _MAX_ registos)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostar _MENU_ Registos",
            loadingRecords: "Loading...",
            processing: "Processar...",
            search: "",
            zeroRecords: "Não foram encontrados registos",
            paginate: {
                previous: '<i class="fas fa-chevron-left"></i>',
                next: '<i class="fas fa-chevron-right"></i>',
                first: "&lt;&lt;",
                last: "&gt;&gt;",
            },
            aria: {
                sortAscending: ": Ordenar Ascendente",
                sortDescending: ": Ordenar Descendente",
            },
            buttons: {
                copy: "Copiar",
                copySuccess: {
                    1: "Copiado um registo para clipboard",
                    _: "Copiados %d registos para clipboard",
                },
                copyTitle: "Copiar para clipboard",
                copyKeys:
                    "Pressionar CTRL ou u2318 + C para copiar a informação para a área de transferência. Para cancelar, clique nesta mensagem ou pressione ESC.",
            },
        },
        paging: false,
    };
}

export function getSimpleDataTableOptions() {
    return {
        dom: "lBfrtip",
        buttons: [],
        language: {
            decimal: ".",
            emptyTable: "Sem Dados Disponíveis",
            info: "Mostrar _START_ até _END_ de _TOTAL_ registos",
            infoEmpty: "Sem Registos",
            infoFiltered: "(filtro de um total de _MAX_ registos)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostar _MENU_ Registos",
            loadingRecords: "Loading...",
            processing: "Processar...",
            search: "",
            zeroRecords: "Não foram encontrados registos",
            paginate: {
                previous: '<i class="fas fa-chevron-left"></i>',
                next: '<i class="fas fa-chevron-right"></i>',
                first: "&lt;&lt;",
                last: "&gt;&gt;",
            },
            aria: {
                sortAscending: ": Ordenar Ascendente",
                sortDescending: ": Ordenar Descendente",
            },
        },
        paging: false,
    };
}

export function getToastrOptions() {
    return {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "400",
        hideDuration: "1000",
        timeOut: "3000",
        extendedTimeOut: "500",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: false,
    };
}

export function toggleActive(btn) {
    btn.prop("disabled", true);
    let active = btn.data("active");
    let checkbox = btn.find(".far");
    btn.addClass("fa-spin");
    setTimeout(() => {
        btn.removeClass("fa-spin");

        checkbox.toggleClass("fa-check-square");
        checkbox.toggleClass("fa-square");

        if (checkbox.hasClass("fa-check-square")) {
            checkbox.css("color", "green");
        } else {
            checkbox.css("color", "red");
        }

        btn.data("active", active == "1" ? "0" : "1");

        btn.prop("disabled", false);
    }, 500);
}

export function setActive(btn) {
    let active = btn.data("active");
    let checkbox = btn.find(".far");

    if (active == "1") {
        checkbox.removeClass("fa-square");
        checkbox.addClass("fa-check-square");
        checkbox.css("color", "green");
    } else {
        checkbox.removeClass("fa-check-square");
        checkbox.addClass("fa-square");
        checkbox.css("color", "red");
    }
}

const toBase64 = (file) =>
    new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = (error) => reject(error);
    });

let getBase64File = (content, filename, type) => {
    var byteCharacters = atob(content);
    var byteNumbers = new Array(byteCharacters.length);
    for (var i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    var byteArray = new Uint8Array(byteNumbers);
    var blob = new Blob([byteArray], { type: type });

    // Remove the downloadfile element from the document if exists
    $("#downloadfile").remove();

    let uriContent = URL.createObjectURL(blob);
    let link = document.createElement("a");
    link.setAttribute("id", "downloadfile");
    link.setAttribute("href", uriContent);
    link.setAttribute("download", filename);
    let event = new MouseEvent("click");
    link.dispatchEvent(event);
};

let showBase64File = (content, filename, type) => {
    var byteCharacters = atob(content);
    var byteNumbers = new Array(byteCharacters.length);
    for (var i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    var byteArray = new Uint8Array(byteNumbers);
    var blob = new Blob([byteArray], { type: type });

    let uriContent = URL.createObjectURL(blob);
    window.location.replace(uriContent);
};

export function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
        s = "",
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}

export function bs_input_file() {
    $(".input-file").before(function () {
        if (!$(this).prev().hasClass("input-ghost")) {
            var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
            element.attr("name", $(this).attr("name"));
            element.on("change", function () {
                element.next(element).find("input").val(element.val().split("\\").pop());
            });
            $(this)
                .find("button.btn-choose")
                .on("click", function () {
                    element.trigger("click");
                });
            $(this)
                .find("button.btn-reset")
                .on("click", function () {
                    element.val(null);
                    $(this).parents(".input-file").find("input").val(null);
                });
            $(this).find("input").css("cursor", "pointer");
            $(this)
                .find("input")
                .on("mousedown", function () {
                    $(this).parents(".input-file").prev().trigger("click");
                    return false;
                });
            return element;
        }
    });
}

export function limitChar(textarea) {
    let eldivcount = textarea.parent().find("div.countdown");
    let msg = textarea.val();
    let limit = 500;
    let current = limit - msg.length;
    $(eldivcount).html("#" + current);
    if (current < 0) {
        textarea.val(msg.substring(0, limit));
        $(eldivcount).html("#0");
    }
}

export function datePicker(elem) {
    /**
     * Datepicker
     */
    const d = new Date();

    const today = ("0" + d.getDate()).slice(-2) + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + d.getFullYear();

    elem.attr("readonly", true);
    elem.css("cursor", "pointer");

    let options = {
        showAnim: "slideDown",
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        defaultDate: today,
    };

    elem.datepicker(options);
    elem.on("change", checkValidDate);
}

/**
 *
 * @param {jQuery} pickIni Data initial
 * @param {jQuery} pickEnd Data final
 * @param {boolean} update Is to update date in pickIni and pickEnd
 * @param {jQuery} element Element to push after onSelect method
 */
export function dateRange(pickIni, pickEnd, update = false, element = null) {
    /**
     * Datepicker
     */
    const d = new Date();

    const today = ("0" + d.getDate()).slice(-2) + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + d.getFullYear();

    const priorDate = new Date(d.getTime() + 30 * 24 * 60 * 60 * 1000);

    const priorMonth =
        ("0" + priorDate.getDate()).slice(-2) +
        "-" +
        ("0" + (priorDate.getMonth() + 1)).slice(-2) +
        "-" +
        priorDate.getFullYear();

    pickIni.attr("readonly", true);
    pickEnd.attr("readonly", true);
    pickIni.css("cursor", "pointer");
    pickEnd.css("cursor", "pointer");

    if (!update) {
        pickIni.val(today);
        pickEnd.val(priorMonth);
    }

    let optionsIni = {
        showAnim: "slideDown",
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        defaultDate: 0,
        onSelect: function (current, prev) {
            pickEnd.datepicker("option", "minDate", current);
            if (element) {
                element.trigger("click");
            }
        },
        beforeShow: function (input, inst) {
            $(document).off("focusin.bs.modal");
        },
        onClose: function () {
            $(document).on("focusin.bs.modal");
        },
    };

    let optionsEnd = {
        showAnim: "slideDown",
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        minDate: pickIni.val(),
        defaultDate: 30,
        onSelect: function (current, prev) {
            if (element) {
                element.trigger("click");
            }
        },
        beforeShow: function (input, inst) {
            $(document).off("focusin.bs.modal");
        },
        onClose: function () {
            $(document).on("focusin.bs.modal");
        },
    };

    if (update) {
        optionsIni.defaultDate = pickIni.val();
        optionsEnd.defaultDate = pickEnd.val();
    }

    pickIni.datepicker(optionsIni);
    pickEnd.datepicker(optionsEnd);

    pickIni.on("change", checkValidDate);
    pickEnd.on("change", checkValidDate);
}

/**
 *
 * @param {jQuery} pickIni Data initial
 * @param {jQuery} element Element to push after onSelect method
 */
export function pickdate(pickIni, element = null) {
    let update = pickIni.val() == "" ? false : true;
    /**
     * Datepicker
     */
    const d = new Date();

    const today = ("0" + d.getDate()).slice(-2) + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + d.getFullYear();

    pickIni.attr("readonly", true);
    pickIni.css("cursor", "pointer");

    if (!update) {
        pickIni.val(today);
    }

    let optionsIni = {
        showAnim: "slideDown",
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        defaultDate: 0,
        onSelect: function (current, prev) {
            if (element) {
                element.trigger("click");
            }
        },
        beforeShow: function (input, inst) {
            $(document).off("focusin.bs.modal");
        },
        onClose: function () {
            $(document).on("focusin.bs.modal");
        },
    };

    if (update) {
        optionsIni.defaultDate = pickIni.val();
    }

    pickIni.datepicker(optionsIni);

    pickIni.on("change", checkValidDate);
}

export function checkValidDate() {
    let d = $(this);
    let darr = d.val().split("-");
    if (darr.length !== 3) {
        d.val("");
    }

    let day = parseInt(darr[0]);
    if (day < 1 || day > 31) {
        d.val("");
    }
    let month = parseInt(darr[1]) - 1;
    if (month < 0 || month > 12) {
        d.val("");
    }
    let year = parseInt(darr[2]);
    var d1 = new Date(year, month, day);
    if (d1 == "Invalid Date") {
        d.val("");
    }
}

export function getBlockOptions(text = null) {
    let defaultColor = "#10163a";
    let defaultOptions = {
        message: '<div class="spinner-border text-primary" style="width: 2rem; height: 2rem;" role="status"></div>',
        overlayCSS: {
            backgroundColor: defaultColor,
            cursor: "wait",
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: "none",
        },
    };

    let infoOptions = {
        message:
            '<div><i class="feather-icon icon-refresh-cw icon-spin mr-2"></i><span id="blockinfo">' +
            text +
            "</span></div>",
        overlayCSS: {
            backgroundColor: defaultColor,
            cursor: "wait",
        },
        css: {
            border: 1,
            padding: 10,
            backgroundColor: "#00303c",
            color: "#fff",
        },
    };

    return text ? infoOptions : defaultOptions;
}

export function blockElementTimeOut(element, timeout) {
    // Block Element
    element.block(getBlockOptions(timeout));

    const ti = setInterval(function (e) {
        timeout--;
        element.find("#blockinfo").html(timeout);
    }, 1000);

    setTimeout(function (e) {
        clearInterval(ti);
        element.unblock();
    }, timeout * 1000);
}

export function setFormReadOnly(container) {
    container.find("button[type=submit]").remove();
    container.find("input").attr("readonly", true);
    container.find("input").datepicker("disable");
    container.find("select").attr("readonly", true);
    container.find("select").attr("disabled", true);
    container.find("option:not(:selected)").remove();
    container.find("button").off();
    container.find("button.icon-x-circle").remove();
    container.find("button.btn-delete").remove();
    container.find("button.btn-add").remove();
    container.find("input[type=file]").parent().remove();
    container.find("#imageplace").off();
}

export function showData(data) {
    let modal = $("#adminmodal");
    let container = modal.find(".modal-body");
    container.html(data.html);
    let title = "Registo Detalhes";
    if (data.title) {
        title = data.title;
    }
    modal.find(".modal-title").html(title);
    modal.find(".modal-xl").removeClass("modal-xl").addClass("modal-lg");
    modal.modal("show");
    return container;
}

export function getBase64FromImageUrl(url, width = null, height = null) {
    return new Promise((resolve, reject) => {
        var img = new Image();
        img.setAttribute("crossOrigin", "anonymous");

        img.onload = () => {
            var canvas = document.createElement("canvas");
            canvas.width = width ? width : img.width;
            canvas.height = height ? height : img.height;

            var ctx = canvas.getContext("2d");

            if (width && height) {
                ctx.drawImage(img, 0, 0, width, height);
            } else {
                ctx.drawImage(img, 0, 0);
            }

            var dataURL = canvas.toDataURL("image/png");

            resolve(dataURL);
        };

        img.onerror = (error) => {
            reject(error);
        };

        img.src = url;
    });
}

export function getData() {
    let date_ob = new Date();
    // current date
    // adjust 0 before single digit date
    let date = ("0" + date_ob.getDate()).slice(-2);

    // current month
    let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);

    // current year
    let year = date_ob.getFullYear();

    // current hours
    let hours = date_ob.getHours();

    // current minutes
    let minutes = date_ob.getMinutes();

    // current seconds
    let seconds = date_ob.getSeconds();

    // prints date & time in YYYY-MM-DD HH:MM:SS format
    return year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds;
}
