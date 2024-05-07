$("#search").keyup(function(){
    var search = $(this).val().toLowerCase();

    $(".cartaPersonatge").each(function(){
        var nom = $(this).find(".card-title").text().toLowerCase();
        if (nom.indexOf(search) > -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});