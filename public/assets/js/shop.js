let ordre = null;
let id_categorie = null;
let key = null;
function fetch_shop() {
    $.get(
        "/shop_live",
        {
            ordre: ordre,
            id_categorie: id_categorie,
            key: key,
        },
        function (response) {
            $("#shop-products").html(response.html);
        }
    ).fail(function (xhr, status, error) {
        console.error("Erreur :", error);
    });
}

fetch_shop();

function nice_select() {
    ordre = $("#nice-select").val();
    fetch_shop();
}

function select_categorie(id) {
    id_categorie = id;
    fetch_shop();
}

$(document).ready(function () {
    $("#key-shop" ).on( "keyup", function() {
        key = $(this).val();
        fetch_shop();
    });
});
