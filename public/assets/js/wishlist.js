// A $( document ).ready() block.
$(document).ready(function () {
    function fetch() {
        $.get("/favoris/get", function (response) {
            $("#liste-wishlist").html(response.html);
            $(".wishlist-count").text(response.total);
        }).fail(function (xhr, status, error) {
            console.error("Erreur :", error);
        });
    }

    fetch();

    //delete element from favorites

    $(document).on("click", ".delete-from-wish", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: "/favoris/delete",
            type: "DELETE",
            data: {
                id_produit: id,
                _token: $("#csrf-token")[0].content,
            },
            success: function (response) {
                if (response.status) {
                    fetch();
                    $("#tr-favoris-" + id).hide();
                    Swal.fire({
                        title: "Félicitation!",
                        text: response.message,
                        icon: "success",
                    });
                } else {
                    Swal.fire({
                        title: "Echec !",
                        text: response.message,
                        icon: "error",
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Erreur :", error);
            },
        });
    });

    //add element to favorites
    $(document).on("click", ".add-to-wish", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: "/favoris/add",
            type: "POST",
            data: {
                id_produit: id,
                _token: $("#csrf-token")[0].content,
            },
            success: function (response) {
                if (response.status) {
                    fetch();
                    Swal.fire({
                        title: "Félicitation !",
                        text: response.message,
                        icon: "success",
                    });
                } else {
                    Swal.fire({
                        title: "Echec !",
                        text: response.message,
                        icon: "error",
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Erreur :", error);
            },
        });
    });
});
