<?php
    include_once '../../includes/servicioDAL.php';
    $serv_dal = new servicioDAL();
    $serv_id  = $_GET['serv_id'];

    $serv_row   = $serv_dal->BuscarServicio($serv_id);
    $galer_list = $serv_dal->listarGaleriaPorServicio($serv_id);
?>
<section id="services">
    <div class="container">
        <h2>Servicio de <?= $serv_row['serv_nombre'] ?> </h2>
        <div class='row'>
            <?php foreach ($galer_list as $galer_row) { ?>
                <div class="col-md-6">
                    <h4><?= $galer_row['galer_descripcion'] ?></h4>
                    <img src='<?= $galer_row['galer_imagen'] ?>' style='border: 2px solid #ffa03a;'>
                    <p><?= $galer_row['galer_comentario'] ?></p>
                </div>
            <?php } ?>
        </div>
        <div class='row'>
            <div class="txt_center" style='margin: 10px;'>
                <a class='btn btn-danger' href='solicitud.php?serv_id=<?= $serv_id; ?>'>Realiza tu pedido</a>
            </div>
        </div>
</section>