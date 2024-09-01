//offcanvas-cart
// liste  .customScroll
//montant  .montant

function fetch_cart() {
    $.get("/client/get", function (response) {
        $(".panier-modal .customScroll").html(response.html);
        $(".panier-modal .montant").text(response.montant);
        $(".cart-count").text(response.total);
        if (response.total <= 0) {
            $(".panier-modal .buttons").hide();
        } else {
            $(".panier-modal .buttons").show();
        }
    }).fail(function (xhr, status, error) {
        console.error("Erreur :", error);
    });
}

fetch_cart();

//delete ele

//ajouter au panier
$(document).on("click", ".add-to-cart", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var quantite = $("#input-qty").length ? $("#input-qty").val() : 1;
    $.ajax({
        url: "/client/ajouter_au_panier",
        type: "POST",
        data: {
            id_produit: id,
            quantite: quantite,
            _token: $("#csrf-token")[0].content,
        },
        success: function (response) {
            if (response.status) {
                fetch_cart();
                Swal.fire({
                    title: "Félicittion !",
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

//supprimer un element du panier

$(document).on("click", ".delete-item-to-cart", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "/client/cart/delete",
        type: "POST",
        data: {
            id_produit: id,
            _token: $("#csrf-token")[0].content,
        },
        success: function (response) {
            if (response.status) {
                fetch_cart();
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



$(document).on("click", ".btn-delete-list-cart", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "/client/cart/delete",
        type: "POST",
        data: {
            id_produit: id,
            _token: $("#csrf-token")[0].content,
        },
        success: function (response) {
            if (response.status) {
                fetch_cart();
                $("#cart-list-"+id).remove();
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