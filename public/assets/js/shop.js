let ordre = null;
let id_categorie = $("#IDcategorie").val();;
let key = null;
let max_price = null;
let min_price = null;
let promotion = "false";
let best_sell = "false";

function set_price(max,min) {
    max_price = max;
    min_price = min;
    fetch_shop();
}

function show_promotion(){
    promotion = "true";
    fetch_shop();
}

function show_best_sell(){
    best_sell = "true";
    fetch_shop();
}


function show_normal(){
    promotion = "false";
    fetch_shop();
}

function fetch_shop() {
    $('#loading-div').show("slow");
    $.get(
        "/shop_live",
        {
            ordre: ordre,
            id_categorie: id_categorie,
            key: key,
            max_price: max_price,
            min_price: min_price,
            promotion: promotion,
            best_sell: best_sell,
        },
        function (response) {
            $('#loading-div').hide("slow");
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
