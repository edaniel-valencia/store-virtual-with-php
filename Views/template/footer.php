<!-- ============================================================
     FOOTER PRO - Rediseñado
     ============================================================ -->
<footer class="footer-pro">

  <!-- Cuerpo principal del footer -->
  <div class="footer-pro__body">
    <div class="container">
      <div class="row gy-5">

        <!-- Columna 1: Marca + Contacto -->
        <div class="col-lg-4 col-md-6">
          <div class="fp-col">
            <!-- Logo -->
            <a href="<?php echo BASE_URL; ?>" class="fp-logo logo-link">
              <img src="<?php echo BASE_URL; ?>public/img/logo-adavam.png" alt="ADAVAM" class="logo-img fp-logo__img"
                onerror="this.style.display='none';this.nextElementSibling.style.display='inline-flex';">
              <span class="logo-text-fallback" style="display:none;">ADAVAM</span>
            </a>
            <p class="fp-tagline">Tu tienda de confianza con productos frescos y de calidad.</p>

            <!-- Contacto -->
            <ul class="fp-contact-list">
              <li>
                <span class="fp-contact-icon"><i class="fa fa-map-marker"></i></span>
                <span><?php echo $data['negocio']['direccion']; ?></span>
              </li>
              <li>
                <span class="fp-contact-icon"><i class="fa fa-phone"></i></span>
                <span><?php echo $data['negocio']['telefono']; ?></span>
              </li>
              <li>
                <span class="fp-contact-icon"><i class="fa fa-envelope"></i></span>
                <span><?php echo $data['negocio']['correo']; ?></span>
              </li>
            </ul>

            <!-- Redes sociales -->
            <div class="fp-social">
              <a href="#" class="fp-social__btn" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="fp-social__btn" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="fp-social__btn" aria-label="WhatsApp">
                <i class="fa fa-whatsapp"></i>
              </a>
              <a href="#" class="fp-social__btn" aria-label="Twitter"><i class="fa fa-twitter"></i></a>
            </div>
          </div>
        </div>

        <!-- Columna 2: Links rápidos -->
        <div class="col-lg-2 col-md-6 col-6">
          <div class="fp-col">
            <h5 class="fp-heading">Navegación</h5>
            <ul class="fp-links">
              <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-chevron-right"></i> Inicio</a></li>
              <li><a href="<?php echo BASE_URL . 'principal/productos'; ?>"><i class="fa fa-chevron-right"></i>
                  Productos</a></li>
              <li><a href="<?php echo BASE_URL . 'principal/contactos'; ?>"><i class="fa fa-chevron-right"></i>
                  Contactos</a></li>
              <li><a href="<?php echo BASE_URL . 'principal/carrito'; ?>"><i class="fa fa-chevron-right"></i>
                  Carrito</a></li>
              <?php if (empty($_SESSION['id_usuario'])) { ?>
                <li><a href="<?php echo BASE_URL . 'principal/login'; ?>"><i class="fa fa-chevron-right"></i> Login</a>
                </li>
              <?php } else { ?>
                <li><a href="<?php echo BASE_URL . 'profile'; ?>"><i class="fa fa-chevron-right"></i> Mi cuenta</a></li>
              <?php } ?>
            </ul>
          </div>
        </div>

        <!-- Columna 3: Categorías -->
        <div class="col-lg-2 col-md-6 col-6">
          <div class="fp-col">
            <h5 class="fp-heading">Categorías</h5>
            <ul class="fp-links">
              <?php if (!empty($data['categorias'])) { ?>
                <?php foreach (array_slice($data['categorias'], 0, 6) as $cat) { ?>
                  <li>
                    <a href="<?php echo BASE_URL . 'principal/categoria/' . $cat['categoria']; ?>">
                      <i class="fa fa-chevron-right"></i> <?php echo $cat['categoria']; ?>
                    </a>
                  </li>
                <?php } ?>
              <?php } ?>
            </ul>
          </div>
        </div>

        <!-- Columna 4: Newsletter + Pagos locales -->
        <div class="col-lg-4 col-md-6">
          <div class="fp-col">
            <h5 class="fp-heading">Newsletter</h5>
            <p class="fp-newsletter-text">Suscríbete y recibe ofertas exclusivas cada semana.</p>
            <form class="fp-newsletter-form" action="#" onsubmit="return false;">
              <input type="email" placeholder="Tu correo electrónico" class="fp-newsletter-input">
              <button type="submit" class="fp-newsletter-btn">
                <i class="fa fa-paper-plane"></i>
              </button>
            </form>

            <!-- Pagos aceptados - SOLO LOCAL -->
            <div class="fp-payments">
              <p class="fp-payments__label">
                <i class="fa fa-store" style="margin-right:6px;color:#60a5fa;"></i>
                Pagos aceptados en tienda física
              </p>
              <div class="fp-payments__methods">
                <span class="fp-pay-badge fp-pay-cash">
                  <i class="fa fa-money"></i> Efectivo
                </span>
                <span class="fp-pay-badge fp-pay-transfer">
                  <i class="fa fa-university"></i> Transferencia
                </span>
                <span class="fp-pay-badge fp-pay-qr">
                  <i class="fa fa-qrcode"></i> QR / Billetera
                </span>
                <span class="fp-pay-badge fp-pay-deposit">
                  <i class="fa fa-credit-card-alt"></i> Depósito
                </span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Divisor -->
  <div class="footer-pro__divider"></div>

  <!-- Bottom bar -->
  <div class="footer-pro__bottom">
    <div class="container">
      <div class="fp-bottom-row">
        <p class="fp-copyright">
          &copy;
          <script>document.write(new Date().getFullYear());</script>
          <strong>ADAVAM</strong> — Todos los derechos reservados
        </p>
        <p class="fp-credit">
          Desarrollado con ❤️ por
          <strong>E. Daniel Valencia</strong>
        </p>
      </div>
    </div>
  </div>

</footer>
<!-- /FOOTER PRO -->

<!-- ==========================================
     BOTÓN FLOTANTE WHATSAPP
     ========================================== -->
<?php
$waNumber = !empty($data['negocio']['whatsapp']) ? $data['negocio']['whatsapp'] : '593995411589';
$waMsg = urlencode('¡Hola! Tienda Store Adavam, ayúdeme con más información de ustedes.');
$waUrl = 'https://api.whatsapp.com/send?phone=' . $waNumber . '&text=' . $waMsg;
?>

<div class="wa-float-wrap" id="wa-float-wrap">

  <!-- Tooltip de preview del mensaje -->
  <div class="wa-float-tooltip" id="wa-tooltip">
    <div class="wa-tooltip-header">
      <div class="wa-tooltip-avatar">
        <i class="fa fa-whatsapp"></i>
      </div>
      <div class="wa-tooltip-info">
        <strong>Tienda Store ADAVAM</strong>
        <span class="wa-tooltip-status">
          <span class="wa-status-dot"></span> En línea
        </span>
      </div>
      <button class="wa-tooltip-close" id="wa-tooltip-close" aria-label="Cerrar">
        &times;
      </button>
    </div>
    <div class="wa-tooltip-bubble">
      <p>¡Hola! 👋 ¿En qué podemos ayudarte hoy?</p>
      <p>Escríbenos y te atenderemos en seguida.</p>
      <span class="wa-bubble-time">Ahora</span>
    </div>
    <a href="<?php echo $waUrl; ?>" target="_blank" rel="noopener noreferrer" class="wa-tooltip-cta" id="wa-cta-btn">
      <i class="fa fa-whatsapp"></i>
      Iniciar conversación
    </a>
  </div>

  <!-- Botón flotante principal -->
  <a href="<?php echo $waUrl; ?>" target="_blank" rel="noopener noreferrer" class="wa-float-btn" id="wa-float-btn"
    aria-label="Contactar por WhatsApp" title="Escríbenos por WhatsApp">
    <i class="fa fa-whatsapp wa-icon-main"></i>
    <i class="fa fa-times wa-icon-close" style="display:none;"></i>
    <span class="wa-float-ripple"></span>
  </a>

</div>
<!-- /BOTÓN FLOTANTE WHATSAPP -->

<style>
  /* ---- WhatsApp Float Button ---- */
  .wa-float-wrap {
    position: fixed;
    bottom: 28px;
    right: 28px;
    z-index: 99998;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 14px;
  }

  /* Botón principal */
  .wa-float-btn {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: #25D366;
    border-radius: 50%;
    color: #fff !important;
    font-size: 30px;
    text-decoration: none;
    box-shadow: 0 6px 24px rgba(37, 211, 102, 0.5);
    transition: all 0.3s cubic-bezier(.4, 0, .2, 1);
    cursor: pointer;
    overflow: visible;
  }

  .wa-float-btn:hover {
    background: #20bf5c;
    transform: scale(1.08) translateY(-2px);
    box-shadow: 0 10px 30px rgba(37, 211, 102, 0.6);
    color: #fff !important;
  }

  .wa-float-btn i {
    transition: all 0.25s;
    line-height: 1;
  }

  /* Onda de pulso */
  .wa-float-ripple {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: rgba(37, 211, 102, 0.4);
    animation: wa-pulse 2s ease-out infinite;
    pointer-events: none;
  }

  @keyframes wa-pulse {
    0% {
      transform: scale(1);
      opacity: 0.7;
    }

    70% {
      transform: scale(1.6);
      opacity: 0;
    }

    100% {
      transform: scale(1.6);
      opacity: 0;
    }
  }

  /* Tooltip / chat preview */
  .wa-float-tooltip {
    display: none;
    flex-direction: column;
    gap: 0;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    width: 300px;
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.2);
    animation: wa-tooltip-in 0.3s cubic-bezier(.4, 0, .2, 1);
    transform-origin: bottom right;
  }

  .wa-float-tooltip.open {
    display: flex;
  }

  @keyframes wa-tooltip-in {
    from {
      opacity: 0;
      transform: scale(0.85) translateY(10px);
    }

    to {
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }

  /* Header del tooltip */
  .wa-tooltip-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    background: #075E54;
  }

  .wa-tooltip-avatar {
    width: 42px;
    height: 42px;
    background: #25D366;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #fff;
    flex-shrink: 0;
  }

  .wa-tooltip-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .wa-tooltip-info strong {
    font-size: 14px;
    color: #fff;
    font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  .wa-tooltip-status {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: rgba(255, 255, 255, 0.75);
  }

  .wa-status-dot {
    width: 7px;
    height: 7px;
    background: #4ade80;
    border-radius: 50%;
    display: inline-block;
    animation: wa-blink 1.6s infinite;
  }

  @keyframes wa-blink {

    0%,
    100% {
      opacity: 1;
    }

    50% {
      opacity: 0.3;
    }
  }

  .wa-tooltip-close {
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.7);
    font-size: 20px;
    cursor: pointer;
    padding: 0;
    line-height: 1;
    transition: color 0.2s;
  }

  .wa-tooltip-close:hover {
    color: #fff;
  }

  /* Burbuja de mensaje */
  .wa-tooltip-bubble {
    background: #ECE5DD;
    padding: 16px 16px 8px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    position: relative;
  }

  .wa-tooltip-bubble p {
    background: #fff;
    border-radius: 0 12px 12px 12px;
    padding: 10px 14px;
    font-size: 13.5px;
    color: #1a1a1a;
    margin: 0;
    line-height: 1.5;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
  }

  .wa-bubble-time {
    font-size: 11px;
    color: #777;
    text-align: right;
    display: block;
    padding-right: 4px;
  }

  /* Botón CTA */
  .wa-tooltip-cta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 16px;
    background: #25D366;
    color: #fff !important;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    letter-spacing: 0.3px;
    transition: background 0.2s;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  .wa-tooltip-cta i {
    font-size: 18px;
  }

  .wa-tooltip-cta:hover {
    background: #1ebe5d;
    color: #fff !important;
  }

  /* Badge de notificación en botón principal */
  .wa-float-btn::after {
    content: '1';
    position: absolute;
    top: -2px;
    right: -2px;
    width: 20px;
    height: 20px;
    background: #ef4444;
    color: #fff;
    font-size: 11px;
    font-weight: 800;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
    border: 2px solid #fff;
    line-height: 1;
    animation: wa-badge-bounce 1s ease infinite alternate;
  }

  @keyframes wa-badge-bounce {
    from {
      transform: scale(1);
    }

    to {
      transform: scale(1.15);
    }
  }

  /* Ocultar badge cuando el tooltip esté abierto */
  .wa-float-wrap.tooltip-open .wa-float-btn::after {
    display: none;
  }

  @media (max-width: 480px) {
    .wa-float-wrap {
      bottom: 16px;
      right: 16px;
    }

    .wa-float-btn {
      width: 52px;
      height: 52px;
      font-size: 26px;
    }

    .wa-float-tooltip {
      width: 260px;
    }
  }
</style>

<script>
  (function () {
    var wrap = document.getElementById('wa-float-wrap');
    var btn = document.getElementById('wa-float-btn');
    var tooltip = document.getElementById('wa-tooltip');
    var closeBtn = document.getElementById('wa-tooltip-close');
    var ctaBtn = document.getElementById('wa-cta-btn');
    var iconMain = btn ? btn.querySelector('.wa-icon-main') : null;
    var iconClose = btn ? btn.querySelector('.wa-icon-close') : null;

    var isOpen = false;

    function openTooltip() {
      isOpen = true;
      tooltip.classList.add('open');
      wrap.classList.add('tooltip-open');
      btn.removeAttribute('href'); // No navegar al hacer click en el botón
      if (iconMain) iconMain.style.display = 'none';
      if (iconClose) iconClose.style.display = '';
    }

    function closeTooltip() {
      isOpen = false;
      tooltip.classList.remove('open');
      wrap.classList.remove('tooltip-open');
      btn.href = ctaBtn ? ctaBtn.href : '#';
      if (iconMain) iconMain.style.display = '';
      if (iconClose) iconClose.style.display = 'none';
    }

    if (btn) {
      // Guardar href original
      var originalHref = btn.getAttribute('href');

      btn.addEventListener('click', function (e) {
        if (!isOpen) {
          e.preventDefault();
          openTooltip();
        }
      });
    }

    if (closeBtn) {
      closeBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        closeTooltip();
      });
    }

    // Mostrar tooltip automáticamente después de 3 segundos
    setTimeout(function () {
      if (!isOpen) openTooltip();
    }, 3000);

    // Cerrar al hacer click fuera
    document.addEventListener('click', function (e) {
      if (isOpen && wrap && !wrap.contains(e.target)) {
        closeTooltip();
      }
    });
  })();
</script>

<!-- ==========================================
     MODAL - DETALLE DEL PRODUCTO
     ========================================== -->
<div id="producto-modal-overlay" onclick="cerrarModalProducto(event)" role="dialog" aria-modal="true"
  aria-labelledby="modal-nombre-producto">
  <div class="producto-modal" id="producto-modal-box">
    <!-- Botón cerrar -->
    <button class="producto-modal__close" onclick="cerrarModalProducto()" aria-label="Cerrar">&times;</button>

    <!-- Skeleton / loader -->
    <div id="modal-skeleton" class="producto-modal__skeleton">
      <div class="skel skel--img"></div>
      <div class="skel-info">
        <div class="skel skel--title"></div>
        <div class="skel skel--price"></div>
        <div class="skel skel--line"></div>
        <div class="skel skel--line short"></div>
        <div class="skel skel--line"></div>
      </div>
    </div>

    <!-- Contenido real -->
    <div id="modal-contenido" class="producto-modal__body" style="display:none">
      <div class="producto-modal__img-wrap">
        <img id="modal-img" src="" alt="Producto" />
        <span id="modal-badge-stock" class="modal-badge"></span>
      </div>
      <div class="producto-modal__info">
        <span id="modal-categoria" class="modal-categoria-tag"></span>
        <h2 id="modal-nombre-producto" class="modal-nombre"></h2>
        <div class="modal-precio-wrap">
          <span class="modal-precio-label">Precio</span>
          <span id="modal-precio" class="modal-precio"></span>
        </div>
        <div class="modal-divider"></div>
        <p id="modal-descripcion" class="modal-descripcion"></p>
        <div class="modal-stock-row">
          <i class="fa fa-cubes"></i>
          <span id="modal-stock-text"></span>
        </div>
        <div class="modal-actions">
          <a id="modal-whatsapp" href="#" target="_blank" class="modal-btn modal-btn--whatsapp">
            <i class="fa fa-whatsapp"></i> WhatsApp
          </a>
          <a id="modal-agregar" href="#" class="modal-btn modal-btn--cart producto-agregar">
            <i class="fa fa-shopping-cart"></i> Agregar
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /MODAL -->

<script>
  /* ---- Estilos del modal inyectados por JS para no depender de un CSS extra ---- */
  (function () {
    var s = document.createElement('style');
    s.textContent = `
      #producto-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(30,27,75,0.65);
        backdrop-filter: blur(6px);
        z-index: 99999;
        align-items: center;
        justify-content: center;
        padding: 16px;
        animation: overlayIn 0.25s ease;
      }
      #producto-modal-overlay.abierto { display: flex; }
      @keyframes overlayIn { from{opacity:0} to{opacity:1} }

      .producto-modal {
        background: #fff;
        border-radius: 22px;
        max-width: 820px;
        width: 100%;
        position: relative;
        overflow: hidden;
        box-shadow: 0 24px 80px rgba(108,63,232,0.3);
        animation: modalSlideUp 0.35s cubic-bezier(.4,0,.2,1);
        max-height: 90vh;
        overflow-y: auto;
      }
      @keyframes modalSlideUp {
        from { opacity:0; transform:translateY(40px) scale(.97); }
        to   { opacity:1; transform:translateY(0)   scale(1); }
      }

      .producto-modal__close {
        position: absolute;
        top: 14px; right: 16px;
        background: rgba(108,63,232,0.1);
        border: none;
        border-radius: 50%;
        width: 36px; height: 36px;
        font-size: 20px; line-height: 1;
        cursor: pointer; color: #6C3FE8;
        z-index: 10;
        transition: all .2s;
        display: flex; align-items: center; justify-content: center;
      }
      .producto-modal__close:hover { background:#6C3FE8; color:#fff; }

      /* Skeleton */
      .producto-modal__skeleton { display: flex; gap: 24px; padding: 30px; }
      .skel { background: linear-gradient(90deg,#f0edff 25%,#ddd6fe 50%,#f0edff 75%);
              background-size: 200% 100%;
              animation: shimmer 1.4s infinite;
              border-radius: 10px; }
      @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
      .skel--img   { width:260px; min-height:260px; border-radius:16px; flex-shrink:0; }
      .skel-info   { flex:1; display:flex; flex-direction:column; gap:12px; padding-top:8px; }
      .skel--title { height:28px; width:70%; }
      .skel--price { height:36px; width:40%; }
      .skel--line  { height:14px; width:90%; }
      .skel--line.short { width:55%; }

      /* Contenido */
      .producto-modal__body {
        display: flex;
        gap: 0;
      }

      .producto-modal__img-wrap {
        position: relative;
        width: 320px;
        min-height: 320px;
        flex-shrink: 0;
        background: #f0edff;
      }
      .producto-modal__img-wrap img {
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
        border-radius: 0;
      }
      .modal-badge {
        position: absolute;
        top: 14px; left: 14px;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
      }
      .modal-badge.en-stock   { background:#d1fae5; color:#065f46; }
      .modal-badge.sin-stock  { background:#fee2e2; color:#991b1b; }

      .producto-modal__info {
        flex: 1;
        padding: 30px 28px 28px;
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .modal-categoria-tag {
        display: inline-block;
        background: rgba(108,63,232,0.1);
        color: #6C3FE8;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding: 4px 12px;
        border-radius: 99px;
        width: fit-content;
      }
      .modal-nombre {
        font-size: 22px;
        font-weight: 800;
        color: #1E1B4B;
        margin: 0;
        line-height: 1.3;
      }
      .modal-precio-wrap {
        display: flex; align-items: baseline; gap: 8px;
        margin: 4px 0;
      }
      .modal-precio-label { font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; }
      .modal-precio {
        font-size: 30px;
        font-weight: 800;
        color: #6C3FE8;
      }
      .modal-divider { height:1px; background: #f0edff; margin: 4px 0; }
      .modal-descripcion {
        font-size: 14px;
        color: #4B5563;
        line-height: 1.7;
        margin: 0;
        flex: 1;
      }
      .modal-stock-row {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; color: #6b7280;
      }
      .modal-stock-row i { color: #6C3FE8; }

      .modal-actions {
        display: flex; gap: 10px;
        margin-top: 6px;
      }
      .modal-btn {
        flex: 1;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        padding: 13px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        text-decoration: none;
        transition: all .25s;
        border: none;
      }
      .modal-btn--whatsapp {
        background: #25D366;
        color: #fff;
      }
      .modal-btn--whatsapp:hover { background: #1ebe5d; color:#fff; transform:translateY(-2px); box-shadow:0 6px 16px rgba(37,211,102,0.4); }
      .modal-btn--cart {
        background: linear-gradient(135deg,#6C3FE8,#8B5CF6);
        color: #fff;
      }
      .modal-btn--cart:hover { background: linear-gradient(135deg,#F97316,#FB923C); color:#fff; transform:translateY(-2px); box-shadow:0 6px 16px rgba(249,115,22,0.4); }

      @media (max-width: 640px) {
        .producto-modal__body { flex-direction: column; }
        .producto-modal__img-wrap { width: 100%; min-height: 220px; }
        .producto-modal__skeleton { flex-direction: column; }
        .skel--img { width:100%; min-height:180px; }
      }
    `;
    document.head.appendChild(s);
  })();

  /* ---- Lógica del modal ---- */
  var _negocioWA = '<?php echo !empty($data["negocio"]["whatsapp"]) ? $data["negocio"]["whatsapp"] : ""; ?>';

  function abrirModalProducto(idProducto, stock) {
    var overlay = document.getElementById('producto-modal-overlay');
    var skeleton = document.getElementById('modal-skeleton');
    var contenido = document.getElementById('modal-contenido');

    // Mostrar overlay con skeleton
    overlay.classList.add('abierto');
    skeleton.style.display = 'flex';
    contenido.style.display = 'none';
    document.body.style.overflow = 'hidden';

    // Llamada AJAX al endpoint
    var xhr = new XMLHttpRequest();
    xhr.open('GET', ruta + 'principal/detalleProducto/' + idProducto, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          var p = JSON.parse(xhr.responseText);
          if (p.error) { cerrarModalProducto(); return; }

          document.getElementById('modal-img').src = ruta + 'public/img/productos/' + p.imagen;
          document.getElementById('modal-nombre-producto').textContent = p.nombre;
          document.getElementById('modal-precio').textContent = '$' + parseFloat(p.precio).toFixed(2);
          document.getElementById('modal-descripcion').textContent = p.descripcion || 'Sin descripción';

          // Stock
          var stockNum = parseInt(p.cantidad);
          var badge = document.getElementById('modal-badge-stock');
          var stockTxt = document.getElementById('modal-stock-text');
          if (stockNum > 0) {
            badge.textContent = 'En stock';
            badge.className = 'modal-badge en-stock';
            stockTxt.textContent = stockNum + ' unidades disponibles';
          } else {
            badge.textContent = 'Sin stock';
            badge.className = 'modal-badge sin-stock';
            stockTxt.textContent = 'Producto agotado';
          }

          // Categoría
          document.getElementById('modal-categoria').textContent = p.id_categoria ? 'Categoría #' + p.id_categoria : '';

          // WhatsApp
          var waLink = document.getElementById('modal-whatsapp');
          var waMsg = encodeURIComponent('Hola, me interesa el producto: ' + p.nombre + ' - Precio: $' + p.precio);
          waLink.href = 'https://api.whatsapp.com/send?phone=' + _negocioWA + '&text=' + waMsg;

          // Botón agregar al carrito
          var btnAgregar = document.getElementById('modal-agregar');
          btnAgregar.id = p.id; // para que cargarBotones() lo detecte
          btnAgregar.setAttribute('stock', p.cantidad);
          btnAgregar.setAttribute('data-pid', p.id);

          // Reasignar evento de carrito al botón del modal
          btnAgregar.onclick = function (e) {
            e.preventDefault();
            agregarCarrito(p.id, 1, p.cantidad);
          };

          // Mostrar contenido
          skeleton.style.display = 'none';
          contenido.style.display = 'flex';

        } catch (err) {
          cerrarModalProducto();
        }
      }
    };
    xhr.send();
  }

  function cerrarModalProducto(e) {
    if (e && e.target !== document.getElementById('producto-modal-overlay')) return;
    document.getElementById('producto-modal-overlay').classList.remove('abierto');
    document.body.style.overflow = '';
  }

  // Cerrar con ESC
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') cerrarModalProducto();
  });

  /* ---- Click en tarjetas de producto: navega a la pagina de detalle ----
     (el modal de vista rapida queda sin usar; abrirModalProducto/cerrarModalProducto
     se dejan por si se quiere reactivar mas adelante) */
  function inicializarModalProductos() {
    document.querySelectorAll('.featured__item').forEach(function (item) {
      var pic = item.querySelector('.featured__item__pic');
      var tituloLink = item.querySelector('.featured__item__text h6 a');
      if (!pic || !tituloLink) return;

      pic.style.cursor = 'pointer';
      pic.addEventListener('click', function (e) {
        // Si hicieron click en whatsapp/agregar-al-carrito, no navegar
        if (e.target.closest('.featured__item__pic__hover')) return;
        window.location = tituloLink.getAttribute('href');
      });
    });
  }

  // Ejecutar cuando el DOM esté listo
  document.addEventListener('DOMContentLoaded', function () {
    inicializarModalProductos();
  });
  // También tras cargar (por si los productos se renderizan tarde)
  window.addEventListener('load', function () {
    inicializarModalProductos();
  });
</script>


<script src="<?php echo BASE_URL; ?>public/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/js/jquery.nice-select.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/js/jquery-ui.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/js/jquery.slicknav.js"></script>
<script src="<?php echo BASE_URL; ?>public/js/mixitup.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/js/owl.carousel.min.js"></script>
<script src="<?php echo asset('public/js/main.js'); ?>"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/toastify-js.js"></script>
<script>
  const ruta = '<?php echo BASE_URL; ?>';
  function alerta(mensaje, type) {
    let color = type == 1 ? "#46cd93" : "#f24734";
    Toastify({
      text: mensaje,
      duration: 3000,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "right", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      style: {
        background: color,
        borderRadius: "2rem",
        textTransform: "uppercase",
        fontSize: ".75rem",
      },
      offset: {
        x: "1.5rem", // horizontal axis - can be a number or a string indicating unity. eg: '2em'
        y: "1.5rem", // vertical axis - can be a number or a string indicating unity. eg: '2em'
      },
      onClick: function () { }, // Callback after click
    }).showToast();
  }
</script>
<script src="<?php echo asset('public/js/login.js'); ?>"></script>
<script src="<?php echo BASE_URL; ?>public/js/sweetalert2.all.min.js"></script>
<script>
  (function () {
    function aplicarIconos() {
      const oscuro = document.documentElement.getAttribute('data-theme') === 'dark';
      document.querySelectorAll('.theme-toggle-btn i').forEach(function (icono) {
        icono.className = oscuro ? 'fa fa-sun-o' : 'fa fa-moon-o';
      });
    }
    aplicarIconos();
    document.querySelectorAll('.theme-toggle-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        const oscuro = document.documentElement.getAttribute('data-theme') === 'dark';
        if (oscuro) {
          document.documentElement.removeAttribute('data-theme');
          localStorage.setItem('theme', 'light');
        } else {
          document.documentElement.setAttribute('data-theme', 'dark');
          localStorage.setItem('theme', 'dark');
        }
        aplicarIconos();
      });
    });
  })();
</script>