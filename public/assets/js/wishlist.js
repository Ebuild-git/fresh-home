function fetch(){
    $.get('/favoris/get',  function(response) {
        $("#liste-wishlist").html(response.html);
        $(".wishlist-count").text(response.total);
    }).fail(function(xhr, status, error) {
        console.error('Erreur :', error);
    });
    
}

fetch();

//delete element from favorites

$(document).on('click', '.delete-from-wish', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/favoris/delete/' + id,
        type: 'DELETE',
        success: function(response) {
            if(response.success) {
                fetch();
            } else {
                showtoast('error', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erreur :', error);
        }
    });
});

//add element to favorites
$(document).on('click', '.add-to-wish', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/favoris/add',
        type: 'POST',
        data: { id_produit: id },
        success: function(response) {
            if(response.success) {
                fetch();
            } else {
                showtoast('error', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erreur :', error);
        }
    });
});