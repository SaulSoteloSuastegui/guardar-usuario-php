<?php
        // Conexión a la base de datos
        //https://victorroblesweb.es/2016/09/10/como-usar-pdo-en-php/
        $connect = new PDO('mysql:host=localhost;dbname=pos', 'root', '');
        $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //$link->exec("set names utf8");

    // Sacar todos los resultados de la base de datos
    $sql = $connect->prepare('SELECT * FROM usuarios');
    $sql->execute();
    $resultado = $sql->fetchAll();
    // Sacar todos los resultados de la base de datos
    //$sql2 = $connect->prepare('SELECT * FROM usuarios');
    //$sql2->execute();
    //$resultado2 = $sql->fetch();
   // var_dump($resultado);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../vistas/font-awesome/css/font-awesome.min.css">

    <title>Document</title>
     <link rel="stylesheet" href="bootstrap/Bootstrap v3.4.1.css">
    <!--=======================================
    PLUGINS DE CSSk

    <link rel="stylesheet" href="datatables/datatables.net-bs/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="datatables/datatables.net-bs/css/dataTables.bootstrap.min.css">
    =======================================-->
    <!--datables estilo  -->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <!--=====================================
    PLUGINS DE JAVASCRIPT
 
    ======================================-->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.all.js"></script>
   

</head>
<body>

<ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar usuarios</li>
      
</ol>




  <!-- https://www.w3schools.com/tags/att_wrap.asp
  https://uniwebsidad.com/libros/xhtml/capitulo-9
  https://ishadeed.com/article/styling-wrappers-css/
  -->

<div id="container"> 
  <section >
    <h1  align="center">Administrar usuarios</h1>
    <hr/>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
         <!--   https://www.w3schools.com/bootstrap/bootstrap_modal.asp 
          https://ishadeed.com/article/styling-wrappers-css/
          -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          Agregar usuario
        </button><br><br>
      
      </div>
    <div id="containertabla">
      <table id ="example" class=" table table-bordered table-striped dt-responsive tablas"  height="40%">
        <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Foto</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Último login</th>
            <th>Acciones</th>

          </tr> 

        </thead>
        <tbody>
          <?php
            foreach ($resultado  as $row => $value){
                
              echo ' 
              <tr>
                <td>'.($row+1).'</td>
                <td>'.$value["nombre"].'</td>
                <td>'.$value["usuario"].'</td>';

                if($value["foto"] != "")
                  {

                  echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                  }else{
                  echo '<td><img src="img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                  }

                  echo '<td>'.$value["perfil"].'</td>';

                  if($value["estado"] != 0){

                  echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

                  }else{

                  echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';

                  }             

                  echo '<td>'.$value["ultimo_login"].'</td>
                        <td>

                          <div class="btn-group">
                              
                            <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

                          </div>  

                        </td>

              </tr>';
            }


          ?> 
        </tbody>
      </table>
   </div>
   </div>
  </section>
</div>


<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>
            <!-- Nueva foto-->
              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

        <?php

          ctrCrearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarPerfil">
                  
                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

     <?php
/*
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();
*/
        ?> 

      </form>

    </div>

  </div>
  </div>
</div>

     <!--=====================================
        PLUGIN DATA TABLES
  ======================================-->
    <!--1-datatables jQuery, Popper.js, Bootstrap JS 1--->
    <script src="jquery/jquery-3.3.1.min.js"></script>
 
          <!-- 2-datatables JS-->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>  

          <!-- 3-datatables JS-->
          <script type="text/javascript" src="main.js"></script> 
            <!-- usuarios JS-->
            <script type="text/javascript" src="js/usuarios.js"></script> 

</body>
</html>
<?php
/*
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();
*/
?> 

<?php
function ctrCrearUsuario()
{
  if(isset($_POST["nuevoUsuario"]))
  {

    $connect = new PDO('mysql:host=localhost;dbname=pos', 'root', '');
    $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo $_POST["nuevoNombre"];

    /*=============================================
            VALIDAR IMAGEN
    =============================================*/
    $ruta = "";
	  if(isset($_FILES["nuevaFoto"]["tmp_name"]))
    {
   
       list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
      $nuevoAncho = 500;
      $nuevoAlto = 500;

      /*=============================================
      CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
      =============================================*/

      $directorio = "img/usuarios/".$_POST["nuevoUsuario"];

      mkdir($directorio, 0755);// CREAMOS EL DIRECTORIO       
        
    }
     /*=============================================
		   DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
	  	=============================================*/

	  if($_FILES["nuevaFoto"]["type"] == "image/jpeg")
    {
	  	/*=============================================
	  	GUARDAMOS LA IMAGEN EN EL DIRECTORIO
	  	=============================================*/

	  	$aleatorio = mt_rand(100,999);//NOMBRE DEL ARCHIVO
	  	$ruta = "img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";//URL	 DONDE GUARDAMOS IMAGEN
	  	$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);	//Crea una nueva imagen a partir de un fichero o de una URL				

	  	$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);/*=============================================
                                                              Esta variable es para que cuando destinemos
                                                              o cuando estemos recortando la foto de origen 
                                                              en su destino mantenga las mismas propiedades 
                                                              del color pero con el nuevo ancho y el nuevo
                                                              alto entonces aquí colocamos nuevo ancho que 
                                                              es 500 y nuevo alto que es 500
                                                              =============================================*/
                                                              
      imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                                                            /*=============================================
                                                              método imagecopyresized es el que me va entonces
                                                             a ajustar la imagen al tamaño de 500 por 500 este método 
                                                             de PHP tiene una serie de parámetros que hay que 
                                                             entenderlos muy bien para poder utilizar vamos a 
                                                             duplicar eso aquí abajo para explicarte cuáles son 
                                                             esos parámetros.
                                                             $destino::donde se va aguardar
                                                             $origen::de donde viene
                                                           =============================================*/
	  	imagejpeg($destino, $ruta);
	  }
      /*=============================================
      GUARDAR USUARIO
      =============================================*/
                
  
    $datos = array("nombre" => $_POST["nuevoNombre"],
    "usuario" => $_POST["nuevoUsuario"],
    "password" => $_POST["nuevoPassword"],
    "perfil" => $_POST["nuevoPerfil"],
    "foto" => $ruta);
                 
    /* echo $datos["nombre"];
    echo $datos["usuario"];
    echo $datos["password"];
    echo $datos["perfil"];
    echo $datos["foto"];*/
    
    $stmt = $connect->prepare("INSERT INTO usuarios(nombre, usuario, password, perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto )");

    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
    $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
    $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
             
   if($stmt->execute())
   {    
      echo '<script>
      swal({
      type: "success",
      title: "¡El usuario ha sido guardado correctamente!",
      showConfirmButton: true,
      confirmButtonText: "Cerrar"
      }).then(function(result){
      if(result.value){
      window.location = "index";
      }
      });
      </script>';	                  
    }else
    {
     echo '<script>
     swal({
     type: "error",
     title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
     showConfirmButton: true,
     confirmButtonText: "Cerrar"
     }).then(function(result){
     if(result.value){
     window.location = "usuarios";
     }
     });
     </script>';
    }
  }  
}
?> 