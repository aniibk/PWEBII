<?php
require_once("encabezado.php");
?>

<body>
    <div id="portada">
        <img src="imagenes/portada-detalle.jpg" alt="portada-productos" class="d-block auto img-fluid pb-3 pt-5">
    </div>

    <?php

    if (isset($_REQUEST['carrito'])) {
        $a_productos = json_decode(file_get_contents('productos.json'), true);
        $id_producto = $_REQUEST['id_producto'];
        $a_carrito = json_decode(file_get_contents('carrito.json'),true);


        $pr_id = $_REQUEST['id_producto'];
        $pr_id_categoria = $a_productos[$pr_id]['id_categoria'];
        $pr_id_marca = $a_productos[$pr_id]['id_marca'];
        $pr_nombre = $a_productos[$pr_id]['nombre_producto'];
        $pr_im = 'imagenes//' . $pr_id_marca . '//' . $pr_id_categoria . '//' . $pr_id . '.jpg';
        $pr_precio = $a_productos[$pr_id]['precio'];
        $pr_descripcion = $a_productos[$pr_id]['descripcion'];
        $pr_marca = $a_productos[$pr_id]['nombre_marca'];
        $pr_categoria = $a_productos[$pr_id]['nombre_categoria'];
    }
    ?>

    <div class="container">
        <div class="row">

            <div class="col-2 col-lg-2 col-md-2">
                <!-- <a href="carrito.php?id_producto=<?php echo $pr_id ?>"> <img class="img-fluid" src="<?php echo $pr_im ?>"></a> -->
            <img src="imagenes/1/1/1.jpg" class="img-fluid" alt="">
            </div>

            <div class="col-3">
                <!-- <h3><?php echo $pr_marca ?></h3> <br> -->
                <h3>Chanel</h3> <br>
                <!-- <p> <?php echo $pr_nombre ?></p> -->
                <p>LES BEIGES</p>
            </div>

            <div class="col-3 pt-3">
                <span>Cant</span>
                <select name="cantidad" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>

            <div class="col-3 pt-3">
                <!-- <p><strong><?php echo '$ ', $pr_precio ?></strong></p> -->
                <p><strong>70.00</strong></p>
            </div>

        </div> <!-- row -->
        
        <hr>

        <div class="container bg-light">
            
            <div class="row d-flex justify-content-around align-items-center">
                
                   <strong> <h4 class="text-uppercase"> Total</h4> </strong>
                   
                   
                    <p class="">$</p>
                    


                    </div>
                    </div> <!-- container gris-->

                    <button type="" name="" class="btn btn-primary mt-3">CONTINUAR COMPRA</button>
    </div> <!-- container -->



</body>
<?php
require_once("pie.php");
?>