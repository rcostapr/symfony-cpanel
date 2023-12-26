$(function () {
    $(".btn-success").on("click", function () {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1500,
        });
    });
    $(".btn-warning").on("click", function () {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                });
            }
        });
    });
    $(".btn-danger").on("click", function () {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: '<a href="#">Why do I have this issue?</a>',
        });
    });
    $(".btn-info").on("click", function () {
        Swal.fire({
            icon: "question",
            title: "Custom animation with Animate.css",
            showClass: {
                popup: `
                animate__animated
                animate__fadeInUp
                animate__faster
              `,
            },
            hideClass: {
                popup: `
                animate__animated
                animate__fadeOutDown
                animate__faster
              `,
            },
        });
    });

    $(".btn-primary").on("click", function () {
        Swal.fire("SweetAlert2 is working!");
    });

    $(".btn-secondary").on("click", function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success",
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error",
                    });
                }
            });
    });
});
