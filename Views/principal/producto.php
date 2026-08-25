<?php include "Views/template/header.php"; ?>

<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <img src="<?php echo BASE_URL . 'public/img/productos/' . $data['producto']['imagen']; ?>" alt="<?php echo $data['producto']['nombre']; ?>" class="img-fluid rounded" style="width:100%; object-fit:cover;">
            </div>
            <div class="col-lg-7 col-md-6">
                <h2><?php echo $data['producto']['nombre']; ?></h2>
                <h3 class="mb-3">$<?php echo $data['producto']['precio']; ?></h3>

                <?php if ($data['producto']['cantidad'] > 0) { ?>
                    <span class="badge badge-success mb-3">En stock (<?php echo $data['producto']['cantidad']; ?> disponibles)</span>
                <?php } else { ?>
                    <span class="badge badge-danger mb-3">Agotado</span>
                <?php } ?>

                <p><?php echo nl2br(htmlspecialchars($data['producto']['descripcion'])); ?></p>

                <div class="d-flex flex-wrap" style="gap:10px;">
                    <a href="#" stock="<?php echo $data['producto']['cantidad']; ?>" class="primary-btn producto-agregar" id="<?php echo $data['producto']['id']; ?>">
                        <i class="fa fa-shopping-cart"></i> Agregar al carrito
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=<?php echo $data['negocio']['whatsapp'] . '&text=Producto: ' . $data['producto']['nombre'] . ' Precio(' . $data['producto']['precio'] . ')'; ?>" target="_blank" class="btn btn-success">
                        <i class="fa fa-whatsapp"></i> Consultar por WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "Views/template/footer.php"; ?>

<script src="<?php echo asset('public/js/cart.js'); ?>"></script>
</body>

</html>
