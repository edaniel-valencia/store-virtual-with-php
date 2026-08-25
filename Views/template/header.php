<!DOCTYPE html>
<html lang="es">

<head>
    <script>
        (function () {
            try {
                if (localStorage.getItem('theme') === 'dark') {
                    document.documentElement.setAttribute('data-theme', 'dark');
                }
            } catch (e) {}
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="description" content="Tienda Online - ADAVAM">
    <meta name="keywords" content="tienda, productos, ecommerce, ADAVAM">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda online</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Cairo:wght@400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>public/css/toastify.min.css" />
    <link href="<?php echo BASE_URL . 'public/admin/DataTables/datatables.min.css'; ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/login.css" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/css/custom-theme.css'); ?>" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <img src="<?php echo BASE_URL; ?>public/img/logo-adavam.png" alt="ADAVAM" class="preloder__logo">
        <div class="loader"></div>
    </div>

    <!-- ============================================================
         NAVBAR UNIFICADO
    ============================================================ -->
    <nav class="navbar-pro" id="navbar-pro">
        <div class="navbar-pro__inner">

            <!-- LOGO -->
            <a href="<?php echo BASE_URL; ?>" class="navbar-pro__logo logo-link">
                <img
                    src="<?php echo BASE_URL; ?>public/img/logo-adavam.png"
                    alt="ADAVAM"
                    class="logo-img"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';"
                >
                <span class="logo-text-fallback" style="display:none;">ADAVAM</span>
            </a>

            <!-- LINKS DE NAV con CATEGORÍAS incluidas (escritorio) -->
            <ul class="navbar-pro__links" id="nav-links-desktop">
                <li><a href="<?php echo BASE_URL; ?>" class="nav-link-item <?php echo ($data['title'] == 'Pagina Principal') ? 'active' : ''; ?>">Inicio</a></li>
                
                <!-- CATEGORÍAS TIPO HERO INTEGRADO EN NAV -->
                <li class="navbar-cat-nav-item" style="position: relative; z-index: 99;">
                    <div class="hero__categories nav-hero-categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Todo</span>
                        </div>
                        <ul>
                            <?php foreach ($data['categorias'] as $categoria) { ?>
                                <li><a href="<?php echo BASE_URL . 'principal/categoria/' . $categoria['categoria']; ?>"><?php echo $categoria['categoria']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>

                <li><a href="<?php echo BASE_URL . 'principal/productos'; ?>" class="nav-link-item">Productos</a></li>
                <li><a href="<?php echo BASE_URL . 'principal/contactos'; ?>" class="nav-link-item">Contactos</a></li>
            </ul>

            <!-- SPACER -->
            <div style="flex:1;"></div>

            <!-- BUSCADOR + CARRITO juntos (derecha) -->
            <div class="navbar-pro__right-group">

                <!-- Buscador compacto -->
                <div class="navbar-pro__search">
                    <form action="<?php echo BASE_URL . 'principal/productos'; ?>" autocomplete="off" class="navbar-search-form">
                        <i class="fa fa-search navbar-search-icon"></i>
                        <input type="text" name="search" placeholder="Buscar..." class="navbar-search-input" id="navbar-search-input">
                        <button type="submit" class="navbar-search-btn" title="Buscar">
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </form>
                </div>

                <!-- Carrito -->
                <a href="<?php echo BASE_URL . 'principal/carrito'; ?>" class="navbar-action-btn navbar-cart-btn" title="Carrito">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="cart-badge" id="numerito">0</span>
                    <span class="cart-badge" id="numerito1" style="display:none;">0</span>
                </a>

            </div>

            <!-- ACCIONES EXTRAS -->
            <div class="navbar-pro__actions">

                <!-- Login / Mi cuenta -->
                <?php if (empty($_SESSION['id_usuario'])) { ?>
                    <a href="#" class="navbar-login-btn"
                       data-toggle="modal" data-target="#authModal"
                       onclick="localStorage.removeItem('postLoginRedirect')">
                        <i class="fa fa-user"></i>
                        <span>Login</span>
                    </a>
                <?php } else { ?>
                    <div class="nav-user-dropdown-wrap" style="position: relative;">
                        <button class="navbar-login-btn nav-user-btn">
                            <i class="fa fa-user"></i>
                            <span>Mi cuenta</span>
                        </button>
                        <div class="nav-user-dropdown">
                            <div class="nav-user-info">
                                <strong><?php echo isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Usuario'; ?></strong>
                                <span><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></span>
                            </div>
                            <ul class="nav-user-links">
                                <li>
                                    <a href="<?php echo BASE_URL . 'profile'; ?>">
                                        <i class="fa fa-id-card-o"></i> Datos de mi perfil / Pedidos
                                    </a>
                                </li>
                                <li class="nav-user-divider"></li>
                                <li>
                                    <a href="<?php echo BASE_URL . 'profile/salir'; ?>" class="logout-link">
                                        <i class="fa fa-sign-out"></i> Cerrar sesión
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>

                <!-- Toggle tema -->
                <button class="navbar-theme-btn theme-toggle-btn" id="theme-toggle" aria-label="Cambiar tema" title="Cambiar tema">
                    <i class="fa fa-moon-o" id="theme-icon"></i>
                </button>

                <!-- Hamburger móvil -->
                <button class="navbar-hamburger" id="navbar-hamburger" aria-label="Menú">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

        <!-- MENÚ MÓVIL (desplegable) -->
        <div class="navbar-pro__mobile-menu" id="mobile-menu">
            <ul>
                <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Inicio</a></li>
                <li><a href="<?php echo BASE_URL . 'principal/productos'; ?>"><i class="fa fa-th-large"></i> Productos</a></li>
                <li><a href="<?php echo BASE_URL . 'principal/contactos'; ?>"><i class="fa fa-envelope"></i> Contactos</a></li>
                <li><a href="<?php echo BASE_URL . 'principal/carrito'; ?>"><i class="fa fa-shopping-bag"></i> Carrito</a></li>
                <?php if (empty($_SESSION['id_usuario'])) { ?>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#authModal"
                           onclick="document.getElementById('mobile-menu').classList.remove('open'); document.getElementById('navbar-hamburger').classList.remove('open');">
                            <i class="fa fa-user"></i> Login
                        </a>
                    </li>
                <?php } else { ?>
                    <li><a href="<?php echo BASE_URL . 'profile'; ?>"><i class="fa fa-user"></i> Mi cuenta</a></li>
                <?php } ?>
            </ul>
            <!-- Búsqueda en móvil -->
            <form action="<?php echo BASE_URL . 'principal/productos'; ?>" autocomplete="off" class="mobile-search-form">
                <input type="text" name="search" placeholder="Buscar productos...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </nav>
    <!-- /NAVBAR -->

    <!-- Auth Modal Begin -->
    <div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authModalLabel">Mi cuenta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="authTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="login-tab" data-toggle="tab" href="#loginPane" role="tab">Ingresar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signupPane" role="tab">Registrarse</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="authTabContent">
                        <div class="tab-pane fade show active" id="loginPane" role="tabpanel">
                            <div class="form-holder mb-3">
                                <input type="email" id="email" class="form-control mb-2" placeholder="Correo electrónico" autocomplete="username">
                                <input type="password" id="password" class="form-control" placeholder="Contraseña" autocomplete="current-password">
                            </div>
                            <a href="<?php echo BASE_URL . 'principal/recoverpw'; ?>" class="d-block mb-3 small">¿Olvidaste tu contraseña?</a>
                            <button class="primary-btn w-100" id="btnLogin">Ingresar</button>
                        </div>
                        <div class="tab-pane fade" id="signupPane" role="tabpanel">
                            <div class="form-holder mb-3">
                                <input type="text" id="nameRegister" class="form-control mb-2" placeholder="Nombre" autocomplete="name">
                                <input type="email" id="emailRegister" class="form-control mb-2" placeholder="Correo electrónico" autocomplete="email">
                                <input type="password" id="passwordRegister" class="form-control" placeholder="Contraseña" autocomplete="new-password">
                            </div>
                            <button class="primary-btn w-100" id="btnRegister">Registrarse</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Auth Modal End -->

    <!-- Hero Section Begin -->
    <?php if ($data['title'] == 'Pagina Principal') { ?>
    <section class="hero <?php echo ($data['title'] == 'Tu carrito') ? 'hero-normal' : ''; ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="<?php echo BASE_URL; ?>public/img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUTA FRESCA</span>
                            <h2>Vegetable <br />100% Organicos</h2>
                            <p>Recogida y entrega gratuitas disponibles</p>
                            <a href="<?php echo BASE_URL . 'principal/productos'; ?>" class="primary-btn">Ver productos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <!-- Hero Section End -->

    <script>
    // Hamburger toggle
    (function() {
        var ham = document.getElementById('navbar-hamburger');
        var menu = document.getElementById('mobile-menu');
        if (ham && menu) {
            ham.addEventListener('click', function() {
                ham.classList.toggle('open');
                menu.classList.toggle('open');
            });
        }
        // Cerrar menú al hacer click fuera
        document.addEventListener('click', function(e) {
            if (menu && menu.classList.contains('open')) {
                if (!menu.contains(e.target) && !ham.contains(e.target)) {
                    menu.classList.remove('open');
                    ham.classList.remove('open');
                }
            }
        });
    })();
    </script>
</body>
</html>