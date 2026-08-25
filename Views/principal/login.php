<?php include "Views/template/header.php"; ?>

<section class="shoping-cart spad">
    <div class="container text-center">
        <p class="text-muted">Ingresa a tu cuenta o regístrate.</p>
    </div>
</section>

<?php include "Views/template/footer.php"; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        localStorage.removeItem('postLoginRedirect');
        $('#authModal').modal('show');
    });
</script>
</body>

</html>
