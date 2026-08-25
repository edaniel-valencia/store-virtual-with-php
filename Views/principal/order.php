<?php include "Views/template/header.php"; ?>

<section class="shoping-cart spad">
    <div class="container text-center">
        <p class="text-muted">Ingresa o crea una cuenta para continuar con tu pedido.</p>
    </div>
</section>

<?php include "Views/template/footer.php"; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        localStorage.setItem('postLoginRedirect', 'principal/address');
        $('#authModal').modal('show');
    });
</script>
</body>

</html>
