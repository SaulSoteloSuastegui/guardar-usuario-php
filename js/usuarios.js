

/*=============================================
SUBIENDO LA FOTO DEL USUARIO
==============================type: "image/jpeg"===============*/
$(".nuevaFoto").change(function(){

	var imagen = this.files;

//   console.log("imagen", imagen );
	if(imagen[0]["type"] != "image/jpeg"){
	
        $(".nuevaFoto").val("");

         swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });

	}else{
        console.log(imagen[0]["type"]);

     
        
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen[0]);

        $(datosImagen).on("load", function(event){

            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);

        })

    }
	/*
);

    }else if(imagen["size"] > 2000000){

        $(".nuevaFoto").val("");

         swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });

    }
*/
})
