function init(){
    // DROP IMAGE 
    var dropZone = document.getElementById('drop_zone');

    $('.imgPerfil').on('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            
            img.setAttribute('class', 'img-fluid');
            img.setAttribute('alt', 'Imagen cargada');
            img.setAttribute('border-radius', '10px');

            dropZone.innerHTML = '';
            dropZone.appendChild(img);
        };
        reader.readAsDataURL(file);
    });


    dropZone.addEventListener('dragover', function(event) {
        event.stopPropagation();
        event.preventDefault();
        event.dataTransfer.dropEffect = 'copy';
    });

    dropZone.addEventListener('drop', function(event) {
        event.stopPropagation();
        event.preventDefault();
        var file = event.dataTransfer.files[0];

        // document.getElementById('inputFile').files[0] = file;
        $('#nomImgPerfil').val(file.name);

        //comprovar si es una imatge
        if (file.type.match('image.*')) {
            //veure el contingut de la imatge
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    
                    //afegir atributs a la imatge 
                    img.setAttribute('class', 'img-fluid');
                    img.setAttribute('alt', 'Imagen cargada');
                    img.setAttribute('border-radius', '10px');

                    dropZone.innerHTML = '';
                    dropZone.appendChild(img);
                };
            })(file);
            reader.readAsDataURL(file);
        } else {
            dropZone.innerHTML = 'El archivo no es una imagen';
        }
    }); 
}

window.onload = init;