$(function () {
    $(".btn-success").on("click", function () {
        toastr.success("Have fun storming the castle!", "Miracle Max Says");
    });
    $(".btn-warning").on("click", function () {
        toastr.warning("My name is Inigo Montoya. You killed my father, prepare to die!");
    });
    $(".btn-danger").on("click", function () {
        toastr.error("I do not think that word means what you think it means.", "Inconceivable!");
    });
    $(".btn-info").on("click", function () {
        // Override global options
        toastr.success("We do have the Kapua suite available.", "Turtle Bay Resort", {
            timeOut: 5000,
            positionClass: "toast-bottom-right",
        });
    });

    $(".btn-primary").on("click", function () {
        // Override global options
        toastr.success("We do have the Kapua suite available.", "Turtle Bay Resort", {
            timeOut: 15000,
            closeButton: true,
            progressBar: true,
        });
    });

    $(".btn-secondary").on("click", function () {
        // Override global options
        toastr.success("We do have the Kapua suite available.", "Turtle Bay Resort", {
            timeOut: 1000,
            closeHtml: '<button><i class="fa-solid fa-xmark"></i></button>',
            closeDuration: 500,
            closeEasing: "swing", // linear
            onShown: function () {
                console.log("hello");
            },
            onHidden: function () {
                console.log("goodbye");
            },
            onclick: function () {
                console.log("clicked");
            },
            onCloseClick: function () {
                console.log("close button clicked");
            },
            showMethod: "slideDown",
            hideMethod: "slideUp",
            closeMethod: "slideUp",
            preventDuplicates: true,
        });
    });
});
