<?php
require_once('encabezado.php');
?>

<body>
    <div id="portada">
        <img src="imagenes/portada-detalle.jpg" alt="portada-productos" class="d-block auto img-fluid pb-3 pt-5">
    </div>

    <div class="row">
        <?php

        $a_productos = json_decode(file_get_contents('productos.json'), true);
        $id_producto = $_REQUEST['id_producto'];
        $a_comentarios = json_decode(file_get_contents('comentarios.json'), true);
        $a_carrito = json_decode(file_get_contents('carrito.json'), true);

        $pr_id = $_REQUEST['id_producto'];
        $pr_id_categoria = $a_productos[$pr_id]['id_categoria'];
        $pr_id_marca = $a_productos[$pr_id]['id_marca'];
        $pr_nombre = $a_productos[$pr_id]['nombre_producto'];
        $pr_im = 'imagenes//' . $pr_id_marca . '//' . $pr_id_categoria . '//' . $pr_id . '.jpg';
        $pr_precio = $a_productos[$pr_id]['precio'];
        $pr_descripcion = $a_productos[$pr_id]['descripcion'];
        $pr_marca = $a_productos[$pr_id]['nombre_marca'];
        $pr_categoria = $a_productos[$pr_id]['nombre_categoria'];



        ?>

        <div class="col-12 col-lg-6 col-md-6">
            <a href="productos.php?id_producto=<?php echo $pr_id ?>"> <img class="img-fluid" src="<?php echo $pr_im ?>"></a>

        </div>

        <div class="col-12 col-lg-5 col-md-6">


            <h2 class="pt-5 text-left"> <?php echo $pr_nombre ?></h2>
            <p><strong><?php echo $pr_descripcion ?></strong></p>
            <div class="row">
                <div class="col-3">
                    <p><?php echo $pr_categoria ?></p>
                </div>
                <div class="col-3">
                    <p><?php echo $pr_marca ?></p>
                </div>
                <div class="col-2">
                    <p><?php echo '$ ', $pr_precio ?></p>
                </div>
            </div>

            <label for="exampleFormControlTextarea1">¿Qué le pareció el producto? </label>


            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="valoracion">
                    <input id="radio1" type="radio" name="puntuacion" value="5">
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="puntuacion" value="4">
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="puntuacion" value="3">
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="puntuacion" value="2">
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="puntuacion" value="1">
                    <label for="radio5">★</label>
                </div>

                <div class="form-group">
                    <input type="email" name="correo" class="form-control" id="exampleInputEmail1" placeholder="Ingrese su e-mail" required>
                </div>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comentario"></textarea>
                <div class="justify-content-center"><input type="submit" name="enviar" class="btn btn-primary"></div>

                <button type="button" name="insert" value="insert" onclick="insert();" class="btn btn-outline-dark mx-auto d-block">Agregar al carrito</button>
                
            </form>



            <?php
                function insert(){
                    echo 'Se agrega al carrito';
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    array_push($a_carrito, array(
                        'id_producto' => $pr_id,
                        'id_categoria' => $pr_id_categoria,
                        'id_marca' => $pr_id_marca,
                        'nombre_producto' => $pr_nombre,
                        'precio' => $pr_precio,
                        'nombre_marca' => $pr_marca,
                        'nombre_categoria' => $pr_categoria,
                        'cant' => '0',
                        'estado' => "pendiente"
                    ));
                    file_put_contents('carrito.json', json_encode($a_carrito));
                }
            ?>




          

            <?php
            if (isset($_REQUEST['enviar'])) {
                if (isset($_REQUEST['puntuacion']) == 0) {
            ?>
                    <div class="alert alert-danger" role="alert">
                        Por favor califique el producto para poder comentar.
                    </div>

            <?php
                } else {
                    $com_correo =  $_POST['correo'];
                    $com_puntuacion = $_POST['puntuacion'];
                    $com_comentario = $_POST['comentario'];
                    switch ($com_puntuacion) {
                        case 1:
                            $com_puntuacion = '★ ';
                            break;
                        case 2:
                            $com_puntuacion = '★ ★';
                            break;
                        case 3:
                            $com_puntuacion = '★ ★ ★';
                            break;
                        case 4:
                            $com_puntuacion = '★ ★ ★ ★';
                            break;
                        case 5:
                            $com_puntuacion = '★ ★ ★ ★ ★';
                            break;
                    }
                    array_push($a_comentarios, array(
                        'correo' => $com_correo,
                        'comentario' => $com_comentario,
                        'puntuacion' => $com_puntuacion,
                        'id_producto' => $id_producto
                    ));

                    file_put_contents('comentarios.json', json_encode($a_comentarios));
                }
            }
            ?>

            <div class="container pt-5 pb-4">
                <h3>Últimos comentarios </h3>
                <hr>
                <?php
            
                $a_comentariosR = array($a_comentarios);

                $cont = 0;
                foreach ($a_comentariosR as $a_comentario) {
                    if ($a_comentario['id_producto']  == $pr_id) {
                        $com_correo = $a_comentario['correo'];
                        $com_comentario = $a_comentario['comentario'];
                        $com_puntuacion =  $a_comentario['puntuacion'];
                        $cont++;

                        echo  '<p> De: ' . $com_correo . '<br>';
                        echo '<p> Comentario: ' . $com_comentario .  $com_puntuacion . ' </p>';
                    }
                    if ($cont >= 4)
                        break;
                }


                ?>
            </div>

        </div>
    </div>
</body>

<?php
require_once('pie.php');
?>