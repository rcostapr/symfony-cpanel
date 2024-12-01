$.datepicker.regional.pt = {
    closeText: "Fechar",
    prevText: "Anterior",
    nextText: "Seguinte",
    currentText: "Hoje",
    monthNames: [
        "Janeiro",
        "Fevereiro",
        "Março",
        "Abril",
        "Maio",
        "Junho",
        "Julho",
        "Agosto",
        "Setembro",
        "Outubro",
        "Novembro",
        "Dezembro",
    ],
    monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
    dayNames: ["domingo", "segunda", "terça", "quarta", "quinta", "sexta", "sábado"],
    dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
    dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
    weekHeader: "Sem",
    dateFormat: "dd/mm/yy",
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: "",
};
$.datepicker.setDefaults($.datepicker.regional.pt);
$.fn.select2.defaults.set("theme", "bootstrap4");
$.fn.select2.defaults.set("language", "pt");
Dropzone.autoDiscover = false;
var dashboard = JSON.parse(localStorage.dashboard || "{}");
$(function () {
    "use strict"; // Start of use strict
    if ($("body").hasClass("animated")) {
        $("#wrapper").css({ opacity: 1, "margin-left": 0 });
    }

    if ($(window).width() < 768) {
        $(".sidebar .collapse").collapse("hide");
        $(".sidebar").addClass("toggled");
    }

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        var dashboard = { collapse: false };
        if ($(".sidebar").hasClass("toggled")) {
            $(".sidebar .collapse").collapse("hide");
            dashboard = { collapse: true };
        }
        localStorage.dashboard = JSON.stringify(dashboard);
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).on("resize", function () {
        if ($(window).width() < 768) {
            $(".sidebar .collapse").collapse("hide");
            $(".sidebar").addClass("toggled");
        }
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function (e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on("scroll", function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $(".scroll-to-top").fadeIn();
        } else {
            $(".scroll-to-top").fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on("click", "a.scroll-to-top", function (e) {
        var $anchor = $(this);
        $("html, body")
            .stop()
            .animate(
                {
                    scrollTop: $($anchor.attr("href")).offset().top,
                },
                1000,
                "easeInOutExpo"
            );
        e.preventDefault();
    });

    // Enable popovers everywhere
    $('[data-bs-toggle="popover"]').popover();
    $(".popover-dismiss").popover({
        trigger: "focus",
    });

    var divtarget = $(".active").closest(".collapse").attr("id");
    $("body")
        .find('[aria-controls="' + divtarget + '"]')
        .trigger("click");

    setTimeout(function () {
        if (dashboard.collapse) {
            $("#sidebarToggle").trigger("click");
        }
    }, 400);

    // SEARCH
    $("#searchDropdown").on("focusin", function () {
        $(this).parent().find(".dropdown-menu").dropdown("show");
        $("#searchDropdown2").trigger("focus");
    });
    $("#searchDropdown").on("focusout", function () {});
    $("#searchDropdown2").on("focusout", function () {
        //$("#searchDropdown").dropdown('hide');
    });

    $("#searchDropdown1,#searchDropdown2").on("keyup", function () {
        let container = $(this).parent().find(".dropdown-menu");
        container.empty();

        let strSearch = $(this).val();

        if (strSearch == "") {
            return false;
        }

        let links = $("a");

        links.each(function (idx, element) {
            if ($(element).attr("href").indexOf("#") == -1 && $(element).attr("href") !== "/") {
                let href = $(element).attr("href");
                let text = $(element).text();
                let content = $(element).html();
                let template = `<a class="dropdown-item" href="${href}">${content}</a>`;

                if (text.toLowerCase().includes(strSearch.toLowerCase())) {
                    container.append(template);
                }
            }
        });
        container.find("a").on("click", function () {
            window.location.replace($(this).attr("href"));
        });
    });

    $("#adminmodal").on("hidden.bs.modal", function (e) {
        $(this).find(".modal-title").empty();
        $(this).find(".modal-body").empty();
        if (!$(this).find(".modal-dialog").hasClass("modal-xl")) {
            $(this).find(".modal-dialog").addClass("modal-xl");
        }
    });

    $(".btn-active").on("click", function () {
        app.toggleActive($(this));
    });

    registerRawData();
}); // End of use strict

function registerRawData() {
    $(".btn-raw").on("click", function () {
        if ($(this).hasClass("btn-raw-up")) {
            $(this).removeClass("btn-raw-up");
            $(this).addClass("btn-raw-down");
        } else {
            $(this).removeClass("btn-raw-down");
            $(this).addClass("btn-raw-up");
        }
        let element = $(this).closest(".card").find(".card-body");
        $(element).slideToggle(500);
    });
}
