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


$('#FiltrarClasse').change(function(){
    var search = $(this).val().toLowerCase();

    $(".cartaPersonatge").each(function(){
        var nom = $(this).find(".card-title").text().toLowerCase();
        if (nom.indexOf(search) > -1) {
            $(this).show();
        } else if(search == "tots"){
            $(".cartaPersonatge").show();
        }else{
            $(this).hide();
        }
    });
});


$("eliminarPersonatge").click(function(){
    var id = $(this).attr("id");

    if(id == null){
        alert("No s'ha pogut eliminar el personatge");

    }else{

        $.ajax({
            url: "eliminarPersonatge.php",
            method: "POST",
            data: {id: id},
            success: function(data){
                $("#"+id).remove();
            }
        });
    }
});


$(".editarPersonatge").click(function(){
    var idPersonatge = $(this).attr("id");

    if(idPersonatge == null){
        alert("No s'ha pogut editar el personatge");
    }else{

        $.ajax({
            url: "editarPersonatge.controller.php",
            method: "POST",
            data: {PersonatgeID: idPersonatge},
            success: function(data){
                // console.log(JSON.stringify(data));

                var Personatge = JSON.parse(data);

                console.log(Personatge);

            
                $('#id').text(Personatge.id);
                $('#NomPersonatge').text(Personatge.nom);
                $('#raza').text(Personatge.raza);
                $('#clase').text(Personatge.clase);
                $('#nivel').val(Personatge.nivel);
                $('#Vida').val(Personatge.Vida);
                $('#Iniciativa').val(Personatge.Iniciativa);
                $('#Fuerza').val(Personatge.Fuerza);
                $('#Destreza').val(Personatge.Destreza);
                $('#Constitucion').val(Personatge.Constitucion);
                $('#Inteligencia').val(Personatge.Inteligencia);
                $('#Sabiduria').val(Personatge.Sabiduria);
                $('#Carisma').val(Personatge.Carisma);
            

                
            }
        });
    }
});



$("#updateCharacter").click(function(){
    
   
    var PersonatgeID = $('#id').text();
    var Fuerza = $('#Fuerza').val();
    var Destreza = $('#Destreza').val();
    var Constitucion = $('#Constitucion').val();
    var Inteligencia = $('#Inteligencia').val();
    var Sabiduria = $('#Sabiduria').val();
    var Carisma = $('#Carisma').val();
    var Vida = $('#Vida').val();
    var Iniciativa = $('#Iniciativa').val();
    var nivel = $('#nivel').val();

    $.ajax({
        url: "updatePersonatge.controller.php",
        method: "POST",
        data: {PersonatgeID: PersonatgeID, Fuerza: Fuerza, Destreza: Destreza, Constitucion: Constitucion, Inteligencia: Inteligencia, Sabiduria: Sabiduria, Carisma: Carisma, Vida: Vida, Iniciativa: Iniciativa, nivel: nivel},
        success: function(data){
            window.location.reload();
        }
    });
});