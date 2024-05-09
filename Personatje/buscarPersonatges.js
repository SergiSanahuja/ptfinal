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

$("eliminarPersonatge").click(function(){
    var id = $(this).attr("id");
    $.ajax({
        url: "eliminarPersonatge.php",
        method: "POST",
        data: {id: id},
        success: function(data){
            $("#"+id).remove();
        }
    });
});


$(".editarPersonatge").click(function(){
    var idPersonatge = $(this).attr("id");

    $.ajax({
        url: "editarPersonatge.controller.php",
        method: "POST",
        data: {PersonatgeID: idPersonatge},
        success: function(data){
            // console.log(JSON.stringify(data));

            var Personatge = JSON.parse(data);

            console.log(Personatge);

           

            $('#NomPersonatge').text(Personatge.nom);
            $('#raza').text(Personatge.raza);
            $('#clase').text(Personatge.clase);
            $('#nivel').text(Personatge.nivel);
            $('#Vida').text(Personatge.Vida);
            $('#Iniciativa').text(Personatge.Iniciativa);
            $('#Fuerza').val(Personatge.Fuerza);
            $('#Destreza').val(Personatge.Destreza);
            $('#Constitucion').val(Personatge.Constitucion);
            $('#Inteligencia').val(Personatge.Inteligencia);
            $('#Sabiduria').val(Personatge.Sabiduria);
            $('#Carisma').val(Personatge.Carisma);
           

            
        }
    });
});