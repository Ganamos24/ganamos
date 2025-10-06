<?php
  // =================== CONFIGURACIÓN ===================
  $brand        = "Movida Central Casino"; // Nombre público
  $phone        = "5492235266292";         // Número sin '+' ni espacios
  $bonus        = 30;                      // Porcentaje del bono
  // Mensaje base (podés usar {BRAND} y {BONUS})
  $message      = "Hola {BRAND}, vengo a reclamar mi BONO {BONUS}%";
  // =====================================================

  // Normalizar número y placeholders
  $phone_digits = preg_replace('/\D+/', '', $phone);
  $message_base = str_replace(['{BRAND}','{BONUS}'], [$brand,$bonus], $message);
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="robots" content="noindex,nofollow"/>
<title>¡Reclamá tu Bono <?php echo (int)$bonus; ?>%! | <?php echo htmlspecialchars($brand); ?></title>
<meta name="description" content="Activá tu bono del <?php echo (int)$bonus; ?>% en <?php echo htmlspecialchars($brand); ?>. Atención inmediata por WhatsApp. Cupos limitados.">
<meta name="theme-color" content="#0c0f16">
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='86'>🎲</text></svg>">
<style>
  :root{
    --bg:#0c0f16; --panel:#111627; --glass:#161c30; --ink:#e8ecf4; --muted:#98a2b3;
    --brand1:#7C3AED; --brand2:#22D3EE; --gold:#F5D67B; --wa:#25D366;
    --radius:18px; --shadow:0 22px 48px rgba(0,0,0,.35);
  }
  *{box-sizing:border-box}
  html,body{height:100%}
  body{
    margin:0; color:var(--ink);
    font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Inter, Ubuntu, Arial, "Noto Sans", sans-serif;
    background:
      radial-gradient(1200px 540px at 85% -10%, rgba(34,211,238,.18), transparent 60%),
      radial-gradient(1000px 500px at 10% 110%, rgba(124,58,237,.20), transparent 60%),
      var(--bg);
  }
  a{color:inherit;text-decoration:none}
  .wrap{max-width:1180px;margin:0 auto;padding:28px}
  header{display:flex;align-items:center;justify-content:space-between;gap:16px}
  .brand{display:flex;align-items:center;gap:12px;font-weight:800;letter-spacing:.3px}
  .mark{
    width:46px;height:46px;border-radius:14px;display:grid;place-items:center;
    background:conic-gradient(from 180deg, var(--brand1), var(--brand2));
    box-shadow:var(--shadow);
  }
  nav a{opacity:.95;margin-left:18px}
  .hero{display:grid;grid-template-columns: 1.1fr .9fr;gap:26px;margin-top:20px;align-items:center}
  @media (max-width: 980px){ .hero{grid-template-columns:1fr} }

  .card{
    background: linear-gradient(180deg, rgba(255,255,255,.055), rgba(255,255,255,.03));
    border:1px solid rgba(255,255,255,.10);
    border-radius: var(--radius); padding:26px; box-shadow: var(--shadow);
    backdrop-filter: blur(8px);
  }
  .badge{display:inline-flex;gap:8px;align-items:center;padding:6px 12px;border-radius:999px;
    border:1px solid rgba(245,214,123,.6); color:var(--gold); background:rgba(245,214,123,.12); font-weight:700}
  h1{font-size: clamp(2.2rem, 1.2rem + 3.6vw, 4rem); line-height:1.04; margin:.6rem 0 .5rem}
  .lead{color:#d5dae5; font-size:1.12rem; max-width:60ch}
  .cta{display:flex;flex-wrap:wrap;gap:12px;margin-top:18px}
  .btn{display:inline-flex;align-items:center;gap:10px;padding:14px 18px;border-radius:14px;border:1px solid rgba(255,255,255,.12);background:#12182b;font-weight:800;transition:.2s}
  .btn:hover{transform:translateY(-1px);box-shadow:0 10px 24px rgba(0,0,0,.28)}
  .btn.primary{background:linear-gradient(135deg,var(--wa),#1ebe57);color:#0b0b0f;border:none}
  .btn.secondary{opacity:.95}
  .hint{margin-top:10px;font-size:.95rem;color:#d5d9e3}
  .hidden{display:none}

  /* Galería elegante */
  .gallery{margin-top:34px;display:grid;grid-template-columns: repeat(4, 1fr);gap:14px}
  @media (max-width: 980px){ .gallery{grid-template-columns: repeat(2, 1fr);} }
  .tile{
    position:relative; overflow:hidden; border-radius:16px;
    background:linear-gradient(180deg, rgba(255,255,255,.05), rgba(255,255,255,.02));
    border:1px solid rgba(255,255,255,.08); aspect-ratio: 4/3;
  }
  .tile svg{position:absolute;inset:0;width:100%;height:100%}
  .tile::after{
    content:""; position:absolute; inset:auto -30% -30% auto; width:60%; height:60%;
    background: radial-gradient(closest-side, rgba(34,211,238,.25), transparent);
    transform: rotate(-12deg);
  }

  /* Bloques informativos */
  .grid{margin-top:34px;display:grid;grid-template-columns: repeat(3, 1fr);gap:16px}
  @media (max-width: 980px){ .grid{grid-template-columns:1fr} }
  .it{background:var(--panel);border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:16px}
  .it h3{margin:8px 0 6px}

  /* Footer + botón flotante */
  footer{border-top:1px solid rgba(255,255,255,.08);margin-top:28px;padding-top:14px;color:#b7bfcb;display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px}
  .wsp-float{position:fixed;right:18px;bottom:18px;z-index:9999}
  .wsp-btn{width:58px;height:58px;border-radius:50%;background:var(--wa);display:grid;place-items:center;box-shadow:0 10px 24px rgba(0,0,0,.25)}

  /* Animaciones suaves */
  @media (prefers-reduced-motion: no-preference){
    .parallax{animation: float 6s ease-in-out infinite}
    @keyframes float{ 0%{transform:translateY(0)} 50%{transform:translateY(-6px)} 100%{transform:translateY(0)} }
  }

  .sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
</style>
</head>
<body>
<a class="sr-only" href="#contenido">Saltar al contenido</a>
<div class="wrap">
  <!-- Header -->
  <header>
    <div class="brand" aria-label="<?php echo htmlspecialchars($brand); ?>">
      <div class="mark" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#0b0b0f" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.9L18.18 22 12 18.77 5.82 22 7 14.17l-5-4.9 6.91-1.01L12 2z"/></svg>
      </div>
      <span><?php echo htmlspecialchars($brand); ?></span>
    </div>
    <nav aria-label="principal">
      <a href="#beneficios">Beneficios</a>
      <a href="#como-funciona">Cómo funciona</a>
      <a href="#tyc">Términos</a>
    </nav>
  </header>

  <!-- Hero -->
  <main id="contenido" class="hero">
    <section class="card parallax" aria-labelledby="t1">
      <span class="badge">🎮 Juego virtual premium</span>
      <h1 id="t1">¡Reclamá tu <strong>bono <?php echo (int)$bonus; ?>%</strong> ahora!</h1>
      <p class="lead">
        Elegí tu juego favorito: dados, cartas, ruleta o slots. Atención inmediata por WhatsApp.
      </p>
      <div class="cta">
        <a id="cta-hero" class="btn primary" href="#" rel="noopener nofollow" target="_blank" aria-label="Abrir WhatsApp para reclamar bono">
          <!-- ícono WA -->
          <svg width="22" height="22" viewBox="0 0 24 24" fill="#0b0b0f" aria-hidden="true"><path d="M20.52 3.48A11.77 11.77 0 0 0 12.02 0C5.4 0 .05 5.35.05 11.97c0 2.11.55 4.17 1.6 6L0 24l6.17-1.6a12 12 0 0 0 5.84 1.49h.01c6.62 0 12.01-5.35 12.01-11.97a11.9 11.9 0 0 0-3.51-8.44ZM12.02 22a9.9 9.9 0 0 1-5.04-1.39l-.36-.21-3.66.95.98-3.57-.23-.37A9.93 9.93 0 0 1 2.1 12C2.1 6.47 6.5 2.08 12.02 2.08c2.66 0 5.16 1.04 7.04 2.92A9.94 9.94 0 0 1 21.95 12c0 5.53-4.5 10-9.93 10Zm5.79-7.46c-.31-.16-1.87-.92-2.16-1.02-.29-.11-.5-.16-.72.16-.22.31-.83 1.02-1.02 1.23-.19.2-.37.23-.69.08-1.87-.92-3.1-1.65-4.33-3.74-.33-.57.33-.53.92-1.77.1-.2.05-.36-.02-.52-.08-.16-.72-1.72-.98-2.36-.26-.64-.52-.55-.72-.56h-.62c-.2 0-.52.08-.79.36-.27.28-1.04 1.02-1.04 2.48 0 1.46 1.06 2.86 1.21 3.05.15.19 2.08 3.17 5.04 4.45.7.3 1.24.47 1.67.61.7.22 1.33.19 1.83.11.56-.08 1.87-.76 2.13-1.49.26-.73.26-1.36.18-1.49-.08-.13-.28-.2-.59-.36Z"/></svg>
          Reclamar por WhatsApp
        </a>
        <a id="cta-desktop" class="btn secondary" href="#" rel="noopener nofollow" target="_blank">Abrir en mi computadora</a>
      </div>
      <p id="inAppHint" class="hint hidden">Si abriste esto desde una app (Instagram/FB/TikTok), usá ▸ <b>Abrir en el navegador</b> y probá de nuevo.</p>
      <p class="hint">*Sujeto a Términos y Condiciones. +18. Jugá responsable.</p>
    </section>

    <!-- Ilustración hero (dados + cartas) -->
    <aside class="card" aria-hidden="true">
      <svg viewBox="0 0 560 360" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Ilustración dados y cartas elegante">
        <defs>
          <linearGradient id="gA" x1="0" x2="1">
            <stop stop-color="#7C3AED" offset="0"/>
            <stop stop-color="#22D3EE" offset="1"/>
          </linearGradient>
          <filter id="blur" x="-10%" y="-10%" width="120%" height="120%">
            <feGaussianBlur stdDeviation="26"/>
          </filter>
        </defs>
        <rect width="560" height="360" fill="#0f1424"/>
        <circle cx="460" cy="80" r="90" fill="#22D3EE" opacity=".16" filter="url(#blur)"/>
        <circle cx="120" cy="310" r="120" fill="#7C3AED" opacity=".16" filter="url(#blur)"/>
        <!-- Carta A♠ -->
        <g transform="translate(320,70) rotate(-8)">
          <rect x="0" y="0" rx="14" width="140" height="200" fill="#fff"/>
          <rect x="0" y="0" rx="14" width="140" height="200" fill="url(#gA)" opacity=".06"/>
          <text x="14" y="26" font-size="20" font-family="ui-sans-serif" fill="#000">A</text>
          <text x="114" y="186" font-size="20" font-family="ui-sans-serif" fill="#000" transform="rotate(180,114,186)">A</text>
          <path d="M70 70 l-24 48 h48z" fill="#000"/>
          <circle cx="70" cy="112" r="10" fill="#000"/>
        </g>
        <!-- Dado 3D -->
        <g transform="translate(160,140) rotate(-18)">
          <!-- cara superior -->
          <polygon points="0,0 120,0 160,30 40,30" fill="#e8ecf4"/>
          <!-- cara frontal -->
          <polygon points="40,30 160,30 160,140 40,140" fill="#dfe4ee"/>
          <!-- cara lateral -->
          <polygon points="0,0 40,30 40,140 0,110" fill="#cfd6e4"/>
          <!-- puntos -->
          <g fill="#0b0f19">
            <circle cx="62" cy="56" r="6"/>
            <circle cx="98" cy="92" r="6"/>
            <circle cx="130" cy="122" r="6"/>
          </g>
          <rect x="0" y="0" width="160" height="140" fill="url(#gA)" opacity=".07"/>
        </g>
        <!-- Ruleta minimal -->
        <g transform="translate(450,240)">
          <circle r="54" fill="#111827" stroke="url(#gA)" stroke-width="4"/>
          <circle r="44" fill="#0b1020"/>
          <?php
            // Generar 12 segmentos alternando rojo/negro
            for($i=0;$i<12;$i++):
              $a1 = ($i*30-90)*M_PI/180; $a2 = (($i+1)*30-90)*M_PI/180;
              $x1 = 44*cos($a1); $y1 = 44*sin($a1);
              $x2 = 44*cos($a2); $y2 = 44*sin($a2);
              $large = 0;
              $color = ($i%2==0) ? "#e63946" : "#111827";
              echo "<path d='M0,0 L$x1,$y1 A44,44 0 $large,1 $x2,$y2 Z' fill='$color'/>";
            endfor;
          ?>
          <circle r="20" fill="#111827" stroke="#F5D67B" stroke-width="2"/>
          <circle r="4" fill="#F5D67B"/>
        </g>
        <!-- Slots -->
        <g transform="translate(40,60)">
          <rect x="0" y="0" width="220" height="120" rx="14" fill="#101522" stroke="url(#gA)" stroke-width="2"/>
          <g transform="translate(14,18)">
            <rect x="0" y="0" width="60" height="84" rx="8" fill="#0b1020" stroke="#263043"/>
            <rect x="70" y="0" width="60" height="84" rx="8" fill="#0b1020" stroke="#263043"/>
            <rect x="140" y="0" width="60" height="84" rx="8" fill="#0b1020" stroke="#263043"/>
            <text x="30" y="54" text-anchor="middle" font-size="36" font-family="ui-sans-serif" fill="#F5D67B">7</text>
            <text x="100" y="54" text-anchor="middle" font-size="36" font-family="ui-sans-serif" fill="#F5D67B">7</text>
            <text x="170" y="54" text-anchor="middle" font-size="36" font-family="ui-sans-serif" fill="#F5D67B">7</text>
          </g>
        </g>
      </svg>
    </aside>
  </main>

  <!-- Galería de juegos (SVGs elegantes) -->
  <section class="gallery" aria-label="Juegos destacados">
    <!-- DADOS -->
    <div class="tile">
      <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" aria-label="Dados">
        <rect width="400" height="300" fill="url(#gradBack1)"/>
        <defs>
          <linearGradient id="gradBack1" x1="0" x2="1">
            <stop stop-color="#101522" offset="0"/>
            <stop stop-color="#0c1120" offset="1"/>
          </linearGradient>
        </defs>
        <g transform="translate(140,70) rotate(-12)">
          <rect x="0" y="0" width="120" height="120" rx="20" fill="#e8ecf4"/>
          <circle cx="30" cy="30" r="10" fill="#0b0f19"/>
          <circle cx="60" cy="60" r="10" fill="#0b0f19"/>
          <circle cx="90" cy="90" r="10" fill="#0b0f19"/>
        </g>
        <g transform="translate(200,110) rotate(18)">
          <rect x="0" y="0" width="120" height="120" rx="20" fill="#e8ecf4"/>
          <circle cx="30" cy="30" r="10" fill="#0b0f19"/>
          <circle cx="90" cy="30" r="10" fill="#0b0f19"/>
          <circle cx="60" cy="60" r="10" fill="#0b0f19"/>
          <circle cx="30" cy="90" r="10" fill="#0b0f19"/>
          <circle cx="90" cy="90" r="10" fill="#0b0f19"/>
        </g>
      </svg>
    </div>

    <!-- CARTAS -->
    <div class="tile">
      <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" aria-label="Cartas">
        <rect width="400" height="300" fill="#0d1322"/>
        <g transform="translate(70,60) rotate(-8)">
          <rect width="120" height="180" rx="14" fill="#fff" />
          <text x="12" y="26" font-size="18" font-family="ui-sans-serif" fill="#d10000">A</text>
          <text x="98" y="168" font-size="18" font-family="ui-sans-serif" fill="#d10000" transform="rotate(180,98,168)">A</text>
          <path d="M60 76 a20 20 0 0 1 40 0 c0 22-40 42-40 42s-40-20-40-42a20 20 0 0 1 40 0z" fill="#d10000"/>
        </g>
        <g transform="translate(120,80) rotate(12)">
          <rect width="120" height="180" rx="14" fill="#fff"/>
          <text x="12" y="26" font-size="18" font-family="ui-sans-serif" fill="#000">A</text>
          <text x="98" y="168" font-size="18" font-family="ui-sans-serif" fill="#000" transform="rotate(180,98,168)">A</text>
          <path d="M60 60 l-20 40 h40z" fill="#000"/>
          <circle cx="60" cy="96" r="8" fill="#000"/>
        </g>
      </svg>
    </div>

    <!-- RULETA -->
    <div class="tile">
      <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" aria-label="Ruleta">
        <rect width="400" height="300" fill="#0c1221"/>
        <g transform="translate(200,150)">
          <circle r="104" fill="#111827" stroke="url(#gRu)" stroke-width="4"/>
          <defs><linearGradient id="gRu" x1="0" x2="1"><stop stop-color="#7C3AED"/><stop stop-color="#22D3EE" offset="1"/></linearGradient></defs>
          <circle r="90" fill="#0b0f19"/>
          <!-- 18 segmentos -->
          <?php for($i=0;$i<18;$i++):
            $a1 = ($i*20-90)*M_PI/180; $a2=(($i+1)*20-90)*M_PI/180;
            $x1=90*cos($a1); $y1=90*sin($a1); $x2=90*cos($a2); $y2=90*sin($a2);
            $color = ($i%2==0) ? "#e63946" : "#0b0f19";
            echo "<path d='M0,0 L$x1,$y1 A90,90 0 0,1 $x2,$y2 Z' fill='$color'/>"; endfor; ?>
          <circle r="40" fill="#111827" stroke="#F5D67B" stroke-width="2"/>
          <circle r="5" fill="#F5D67B"/>
        </g>
      </svg>
    </div>

    <!-- SLOTS -->
    <div class="tile">
      <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" aria-label="Slots">
        <rect width="400" height="300" fill="#0d1424"/>
        <rect x="60" y="70" width="280" height="160" rx="16" fill="#101522" stroke="url(#gSl)" stroke-width="2"/>
        <defs><linearGradient id="gSl" x1="0" x2="1"><stop stop-color="#22D3EE"/><stop stop-color="#7C3AED" offset="1"/></linearGradient></defs>
        <g transform="translate(86,98)">
          <rect width="70" height="104" rx="10" fill="#0b1020" stroke="#263043"/>
          <rect x="84" width="70" height="104" rx="10" fill="#0b1020" stroke="#263043"/>
          <rect x="168" width="70" height="104" rx="10" fill="#0b1020" stroke="#263043"/>
          <text x="35" y="66" text-anchor="middle" font-size="40" font-family="ui-sans-serif" fill="#F5D67B">7</text>
          <text x="119" y="66" text-anchor="middle" font-size="40" font-family="ui-sans-serif" fill="#F5D67B">7</text>
          <text x="203" y="66" text-anchor="middle" font-size="40" font-family="ui-sans-serif" fill="#F5D67B">7</text>
        </g>
      </svg>
    </div>
  </section>

  <!-- Beneficios -->
  <section id="beneficios" class="grid" aria-label="Beneficios">
    <div class="it"><h3>Bonificación inmediata</h3><p>Sumá <strong><?php echo (int)$bonus; ?>%</strong> extra al activar por WhatsApp.</p></div>
    <div class="it"><h3>Atención 1 a 1</h3><p>Un asesor confirma tu elegibilidad y te guía en minutos.</p></div>
    <div class="it"><h3>Transparencia</h3><p>Condiciones claras antes de aplicar. Sin letras chicas.</p></div>
  </section>

  <!-- Cómo funciona -->
  <section id="como-funciona" class="grid" aria-label="Cómo funciona">
    <div class="it"><h3>1) Tocá WhatsApp</h3><p>Se abre el chat con el mensaje “Quiero mi bono <?php echo (int)$bonus; ?>%”.</p></div>
    <div class="it"><h3>2) Validación</h3><p>Verificamos identidad y requisitos de la promo.</p></div>
    <div class="it"><h3>3) Activación</h3><p>Aplicamos el bono y te confirmamos en el chat.</p></div>
  </section>

  <!-- Términos -->
  <section id="tyc" class="card" aria-label="Términos y Condiciones">
    <h3 style="margin-top:0">Términos & Condiciones</h3>
    <ul>
      <li>Válido para mayores de 18 años. Jugá responsable. <em>Si necesitás ayuda, consultá líneas locales de atención sobre juego responsable.</em></li>
      <li>El bono del <?php echo (int)$bonus; ?>% aplica sobre el subtotal elegible. Puede requerir depósito mínimo y condiciones de liberación.</li>
      <li>No acumulable con otras promos salvo aclaración expresa. Cupos limitados.</li>
      <li>Vigencia: actualizar fecha exacta antes de publicar.</li>
    </ul>
  </section>

  <footer>
    <small>© <span id="year"></span> <?php echo htmlspecialchars($brand); ?> — Todos los derechos reservados.</small>
    <small>Privacidad: usamos tus datos solo para gestionar tu beneficio por WhatsApp.</small>
  </footer>
</div>

<!-- Botón flotante a WhatsApp (manual, sin auto-open) -->
<div class="wsp-float">
  <a id="cta-float" class="wsp-btn" href="#" rel="noopener nofollow" target="_blank" aria-label="Abrir WhatsApp (flotante)">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="#0b0b0f" aria-hidden="true"><path d="M20.52 3.48A11.77 11.77 0 0 0 12.02 0C5.4 0 .05 5.35.05 11.97c0 2.11.55 4.17 1.6 6L0 24l6.17-1.6a12 12 0 0 0 5.84 1.49h.01c6.62 0 12.01-5.35 12.01-11.97a11.9 11.9 0 0 0-3.51-8.44ZM12.02 22a9.9 9.9 0 0 1-5.04-1.39l-.36-.21-3.66.95.98-3.57-.23-.37A9.93 9.93 0 0 1 2.1 12C2.1 6.47 6.5 2.08 12.02 2.08c2.66 0 5.16 1.04 7.04 2.92A9.94 9.94 0 0 1 21.95 12c0 5.53-4.5 10-9.93 10Zm5.79-7.46c-.31-.16-1.87-.92-2.16-1.02-.29-.11-.5-.16-.72.16-.22.31-.83 1.02-1.02 1.23-.19.2-.37.23-.69.08-1.87-.92-3.1-1.65-4.33-3.74-.33-.57.33-.53.92-1.77.1-.2.05-.36-.02-.52-.08-.16-.72-1.72-.98-2.36-.26-.64-.52-.55-.72-.56h-.62c-.2 0-.52.08-.79.36-.27.28-1.04 1.02-1.04 2.48 0 1.46 1.06 2.86 1.21 3.05.15.19 2.08 3.17 5.04 4.45.7.3 1.24.47 1.67.61.7.22 1.33.19 1.83.11.56-.08 1.87-.76 2.13-1.49.26-.73.26-1.36.18-1.49-.08-.13-.28-.2-.59-.36Z"/></svg>
  </a>
</div>

<script>
  // ===== Utils (sin acciones automáticas) =====
  const UA = navigator.userAgent || "";
  const isAndroid = () => /Android/i.test(UA);
  const isiOS     = () => /iPhone|iPad|iPod/i.test(UA);
  const isMobile  = () => /iPhone|iPad|iPod|Android/i.test(UA);
  const isInAppBrowser = () => /(FBAN|FBAV|FB_IAB|Instagram|TikTok|Line|MicroMessenger|Snapchat|Twitter|TwitterAndroid|Pinterest|OKApp|YaApp_Android)/i.test(UA);

  const PHONE        = <?php echo json_encode($phone_digits); ?>;      // solo dígitos
  const BRAND        = <?php echo json_encode($brand); ?>;
  const BONUS        = <?php echo (int)$bonus; ?>;
  const MESSAGE_BASE = <?php echo json_encode($message_base); ?>;

  function getUTMs(){
    const p = new URLSearchParams(location.search);
    const keys = ["utm_source","utm_medium","utm_campaign","utm_content","utm_term"];
    const parts = [];
    for(const k of keys){ const v = p.get(k); if(v) parts.push(`${k}=${v}`); }
    return parts.length ? " | " + parts.join(" | ") : "";
  }

  function buildMsg(){
    return encodeURIComponent((MESSAGE_BASE || `Hola ${BRAND}, vengo a reclamar mi BONO ${BONUS}%`) + getUTMs());
  }
  function openUri(u){ window.location.href = u; }
  function openNew(u){ try{ return window.open(u, '_blank', 'noopener'); }catch(e){ return null; } }

  // Flujo manual (solo clic)
  let attempted = false;
  function directFlow(){
    if (attempted) return; attempted = true;
    const MSG = buildMsg();

    // 0) nueva pestaña (algunos in-app la requieren)
    openNew("whatsapp://send?phone=" + PHONE + "&text=" + MSG);

    // 1) esta pestaña
    setTimeout(()=>openUri("whatsapp://send?phone=" + PHONE + "&text=" + MSG), 60);

    // 2) intents Android (normal + business)
    setTimeout(()=>{ if(isAndroid()) openUri("intent://send/?phone=" + PHONE + "&text=" + MSG + "#Intent;scheme=whatsapp;package=com.whatsapp;end;"); }, 600);
    setTimeout(()=>{ if(isAndroid()) openUri("intent://send/?phone=" + PHONE + "&text=" + MSG + "#Intent;scheme=whatsapp;package=com.whatsapp.w4b;end;"); }, 1100);

    // 3) iOS iframe fallback
    setTimeout(()=>{
      if(isiOS()){
        try{
          const i=document.createElement('iframe');
          i.style.display='none';
          i.src="whatsapp://send?phone=" + PHONE + "&text=" + MSG;
          document.body.appendChild(i);
          setTimeout(()=>{ if(i && i.parentNode) i.parentNode.removeChild(i); }, 1000);
        }catch(e){}
      }
    }, 320);

    // 4) fallback oficial
    setTimeout(()=>openUri("https://api.whatsapp.com/send?phone=" + PHONE + "&text=" + MSG), 1800);

    setTimeout(()=>{ attempted=false; }, 4000); // permitir reintento
  }

  function openDesktop(){ openUri("https://web.whatsapp.com/send?phone=" + PHONE + "&text=" + buildMsg()); }

  document.addEventListener('DOMContentLoaded', ()=>{
    document.getElementById('year').textContent = new Date().getFullYear();
    if (isInAppBrowser()) document.getElementById('inAppHint').classList.remove('hidden');

    document.getElementById('cta-hero').addEventListener('click', e=>{ e.preventDefault(); directFlow(); });
    document.getElementById('cta-float').addEventListener('click', e=>{ e.preventDefault(); directFlow(); });

    if (!isMobile()){
      const btnDesk = document.getElementById('cta-desktop');
      btnDesk.addEventListener('click', e=>{ e.preventDefault(); openDesktop(); });
    } else {
      document.getElementById('cta-desktop').classList.add('hidden');
    }
  });
</script>

<noscript>
  <div style="padding:14px;background:#ffedcc;color:#1a1a1a">
    Para reclamar tu bono escribinos por WhatsApp al <strong>+<?php echo htmlspecialchars($phone_digits); ?></strong>.
  </div>
</noscript>
</body>
</html>
