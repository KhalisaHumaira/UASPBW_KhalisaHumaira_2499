<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>@yield('title','Sweetly') — Sweetly Bakery</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=DM+Sans:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
/* ======== DESIGN SYSTEM ======== */
:root{
  /* Primary Palette */
  --rose: #e11d48;
  --rose-hover: #be123c;
  --rose-glow: rgba(225,29,72,.15);
  --rose-light: #fb7185;
  --rose-dim: #ffe4e6;
  --rose-subtle: #fff0f3;

  /* Warm Neutrals */
  --cream: #faf7f2;
  --cream-dark: #f5efe6;
  --white: #ffffff;
  --brown: #78350f;
  --brown-deep: #451a03;
  --brown-light: #a16207;
  --caramel: #d97706;
  --gold: #f59e0b;

  /* Accents */
  --pink: #fdf2f8;
  --peach: #fff7ed;
  --lavender: #faf5ff;

  /* Text */
  --text: #1c1917;
  --text-secondary: #57534e;
  --muted: #78716c;
  --muted-light: #a8a29e;

  /* Borders & Shadows */
  --border: #e7e0d5;
  --border-light: #f0ebe3;
  --shadow-sm: 0 1px 3px rgba(120,53,15,.06);
  --shadow: 0 4px 16px rgba(120,53,15,.08);
  --shadow-lg: 0 12px 40px rgba(120,53,15,.12);
  --shadow-xl: 0 20px 60px rgba(120,53,15,.16);

  /* Radius */
  --radius-sm: 8px;
  --radius: 12px;
  --radius-lg: 16px;
  --radius-xl: 20px;
  --radius-2xl: 24px;
  --radius-full: 9999px;

  /* Transitions */
  --ease: cubic-bezier(0.4, 0, 0.2, 1);
  --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
  --duration: 0.25s;
  --duration-slow: 0.4s;
}

/* ======== RESET & BASE ======== */
*{margin:0;padding:0;box-sizing:border-box;}
*::before,*::after{box-sizing:border-box;}

html{scroll-behavior:smooth;}

body{
  font-family:'DM Sans',sans-serif;
  background:var(--cream);
  color:var(--text);
  min-height:100vh;
  line-height:1.6;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  overflow-x:hidden;
}

a{color:inherit;text-decoration:none;transition:color var(--duration) var(--ease);}

/* ======== ANIMATED BACKGROUND ======== */
body::before{
  content:'';
  position:fixed;
  top:0;left:0;right:0;bottom:0;
  background:
    radial-gradient(ellipse at 20% 50%, rgba(253,242,248,.6) 0%, transparent 50%),
    radial-gradient(ellipse at 80% 20%, rgba(255,247,237,.6) 0%, transparent 50%),
    radial-gradient(ellipse at 50% 80%, rgba(250,245,255,.4) 0%, transparent 50%);
  z-index:-1;
  animation:bgShift 20s ease-in-out infinite alternate;
}

@keyframes bgShift{
  0%{opacity:1;transform:scale(1);}
  50%{opacity:.8;transform:scale(1.05);}
  100%{opacity:1;transform:scale(1);}
}

/* ======== HEADER / NAVBAR ======== */
.header{
  background:rgba(255,255,255,.82);
  backdrop-filter:blur(20px) saturate(180%);
  -webkit-backdrop-filter:blur(20px) saturate(180%);
  border-bottom:1px solid rgba(231,224,213,.6);
  padding:0 32px;
  height:68px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  position:sticky;
  top:0;
  z-index:100;
  transition:all var(--duration-slow) var(--ease);
}

.header.scrolled{
  box-shadow:0 4px 30px rgba(120,53,15,.08);
  height:60px;
}

.header-brand{
  font-family:'Playfair Display',serif;
  font-size:26px;
  font-weight:700;
  color:var(--rose);
  display:flex;
  align-items:center;
  gap:10px;
  transition:transform var(--duration) var(--ease);
}
.header-brand:hover{transform:scale(1.03);}
.header-brand span{color:var(--brown);font-style:italic;font-weight:500;}
.header-brand .brand-icon{
  width:36px;height:36px;
  background:linear-gradient(135deg,var(--rose),var(--rose-light));
  border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  font-size:18px;
  box-shadow:0 4px 12px rgba(225,29,72,.2);
  transition:transform var(--duration) var(--ease-bounce);
}
.header-brand:hover .brand-icon{transform:rotate(-8deg) scale(1.1);}

.header-nav{display:flex;align-items:center;gap:4px;}

.nav-link{
  padding:8px 18px;
  border-radius:var(--radius-full);
  font-size:13px;
  font-weight:500;
  color:var(--muted);
  transition:all var(--duration) var(--ease);
  position:relative;
  overflow:hidden;
}
.nav-link::before{
  content:'';
  position:absolute;
  inset:0;
  background:linear-gradient(135deg,var(--rose-subtle),var(--rose-dim));
  border-radius:var(--radius-full);
  opacity:0;
  transition:opacity var(--duration) var(--ease);
}
.nav-link:hover::before,.nav-link.active::before{opacity:1;}
.nav-link:hover{color:var(--rose);}
.nav-link.active{color:var(--rose);font-weight:600;}
.nav-link span{position:relative;z-index:1;}

.header-right{display:flex;align-items:center;gap:14px;}

.cart-btn{
  display:flex;align-items:center;gap:8px;
  background:linear-gradient(135deg,var(--rose),#c2185b);
  color:white;
  padding:9px 20px;
  border-radius:var(--radius-full);
  font-size:13px;font-weight:600;
  transition:all var(--duration) var(--ease);
  box-shadow:0 4px 16px rgba(225,29,72,.25);
  position:relative;
  overflow:hidden;
}
.cart-btn::before{
  content:'';
  position:absolute;
  top:-50%;left:-50%;
  width:200%;height:200%;
  background:linear-gradient(45deg,transparent 30%,rgba(255,255,255,.15) 50%,transparent 70%);
  transition:transform .6s var(--ease);
  transform:translateX(-100%);
}
.cart-btn:hover::before{transform:translateX(100%);}
.cart-btn:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(225,29,72,.35);}
.cart-badge{
  background:white;color:var(--rose);
  width:20px;height:20px;
  border-radius:50%;
  display:inline-flex;align-items:center;justify-content:center;
  font-size:10px;font-weight:800;
  animation:badgePop .4s var(--ease-bounce);
}
@keyframes badgePop{0%{transform:scale(0);}100%{transform:scale(1);}}

.user-pill{
  display:flex;align-items:center;gap:8px;
  padding:6px 14px 6px 8px;
  background:var(--cream-dark);
  border-radius:var(--radius-full);
  font-size:13px;color:var(--text-secondary);
  border:1px solid var(--border-light);
}
.user-avatar{
  width:28px;height:28px;
  border-radius:50%;
  background:linear-gradient(135deg,var(--rose-dim),var(--peach));
  display:flex;align-items:center;justify-content:center;
  font-size:12px;font-weight:700;
  color:var(--rose);
}

.btn-logout{
  background:transparent;
  border:1.5px solid var(--border);
  color:var(--muted);
  padding:8px 16px;
  border-radius:var(--radius-full);
  cursor:pointer;
  font-size:13px;
  font-family:'DM Sans',sans-serif;
  font-weight:500;
  transition:all var(--duration) var(--ease);
}
.btn-logout:hover{
  border-color:var(--rose);
  color:var(--rose);
  background:var(--rose-subtle);
  transform:translateY(-1px);
}

/* ======== ADMIN NAV ======== */
.admin-nav{
  background:linear-gradient(135deg,var(--brown-deep),var(--brown));
  display:flex;
  overflow-x:auto;
  border-bottom:1px solid rgba(255,255,255,.08);
  padding:0 32px;
}
.admin-nav a{
  padding:14px 22px;
  color:rgba(255,255,255,.55);
  font-size:13px;
  font-weight:500;
  white-space:nowrap;
  border-bottom:2px solid transparent;
  transition:all var(--duration) var(--ease);
  position:relative;
}
.admin-nav a:hover{color:rgba(255,255,255,.9);}
.admin-nav a.active{color:white;border-bottom-color:var(--gold);}
.admin-nav a.active::after{
  content:'';
  position:absolute;
  bottom:-1px;left:20%;right:20%;
  height:2px;
  background:var(--gold);
  border-radius:2px;
  box-shadow:0 0 8px rgba(245,158,11,.4);
}

/* ======== CONTAINER ======== */
.container{
  max-width:1180px;
  margin:0 auto;
  padding:36px 28px;
  animation:fadeInUp .5s var(--ease) both;
}

@keyframes fadeInUp{
  from{opacity:0;transform:translateY(16px);}
  to{opacity:1;transform:translateY(0);}
}

/* ======== ALERTS ======== */
.alert{
  padding:14px 20px;
  border-radius:var(--radius);
  margin-bottom:24px;
  font-size:13px;
  border:1px solid;
  display:flex;
  align-items:center;
  gap:10px;
  animation:slideDown .4s var(--ease-bounce) both;
  backdrop-filter:blur(10px);
}
@keyframes slideDown{
  from{opacity:0;transform:translateY(-12px);}
  to{opacity:1;transform:translateY(0);}
}
.alert-success{
  background:rgba(253,242,248,.85);
  border-color:#fbcfe8;
  color:#9d174d;
  box-shadow:0 4px 12px rgba(251,207,232,.3);
}
.alert-error{
  background:rgba(255,228,230,.85);
  border-color:#fda4af;
  color:var(--rose);
  box-shadow:0 4px 12px rgba(253,164,175,.3);
}

/* ======== CARDS ======== */
.card{
  background:rgba(255,255,255,.85);
  backdrop-filter:blur(12px);
  -webkit-backdrop-filter:blur(12px);
  border:1px solid var(--border-light);
  border-radius:var(--radius-xl);
  box-shadow:var(--shadow);
  transition:all var(--duration-slow) var(--ease);
}
.card:hover{
  box-shadow:var(--shadow-lg);
}
.card-header{
  padding:20px 24px;
  border-bottom:1px solid var(--border-light);
  display:flex;
  align-items:center;
  justify-content:space-between;
}
.card-header h3{
  font-family:'Playfair Display',serif;
  font-size:18px;
  font-weight:600;
  color:var(--brown);
}
.card-body{padding:24px;}

/* ======== BUTTONS ======== */
.btn{
  padding:10px 22px;
  border-radius:var(--radius);
  font-family:'DM Sans',sans-serif;
  font-size:13px;
  font-weight:600;
  cursor:pointer;
  border:none;
  transition:all var(--duration) var(--ease);
  display:inline-flex;
  align-items:center;
  gap:8px;
  position:relative;
  overflow:hidden;
}
.btn::after{
  content:'';
  position:absolute;
  inset:0;
  background:linear-gradient(45deg,transparent,rgba(255,255,255,.1),transparent);
  transform:translateX(-100%);
  transition:transform .5s var(--ease);
}
.btn:hover::after{transform:translateX(100%);}

.btn-rose{
  background:linear-gradient(135deg,var(--rose),#c2185b);
  color:white;
  box-shadow:0 4px 14px rgba(225,29,72,.25);
}
.btn-rose:hover{
  transform:translateY(-2px);
  box-shadow:0 8px 24px rgba(225,29,72,.35);
}
.btn-brown{
  background:linear-gradient(135deg,var(--brown),var(--brown-deep));
  color:white;
  box-shadow:0 4px 14px rgba(120,53,15,.2);
}
.btn-brown:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(120,53,15,.3);}
.btn-outline{
  background:transparent;
  border:1.5px solid var(--border);
  color:var(--text-secondary);
}
.btn-outline:hover{
  border-color:var(--rose);
  color:var(--rose);
  background:var(--rose-subtle);
  transform:translateY(-1px);
}
.btn-sm{padding:6px 14px;font-size:12px;border-radius:var(--radius-sm);}
.btn-edit{
  background:transparent;
  border:1.5px solid #fde68a;
  color:var(--caramel);
}
.btn-edit:hover{background:#fffbeb;transform:translateY(-1px);}
.btn-del{
  background:transparent;
  border:1.5px solid #fecaca;
  color:var(--rose);
}
.btn-del:hover{background:var(--rose-dim);transform:translateY(-1px);}

/* ======== FORMS ======== */
.form-group{margin-bottom:18px;}
.form-group label{
  display:block;
  font-size:11px;
  font-weight:700;
  color:var(--muted);
  margin-bottom:6px;
  text-transform:uppercase;
  letter-spacing:.08em;
}
.form-control{
  width:100%;
  padding:11px 16px;
  border:1.5px solid var(--border);
  border-radius:var(--radius);
  font-family:'DM Sans',sans-serif;
  font-size:13px;
  color:var(--text);
  outline:none;
  background:rgba(255,255,255,.7);
  backdrop-filter:blur(4px);
  transition:all var(--duration) var(--ease);
}
.form-control:focus{
  border-color:var(--rose);
  box-shadow:0 0 0 4px var(--rose-glow);
  background:white;
}
.form-control:hover{border-color:var(--muted-light);}
.form-control.is-invalid{border-color:var(--rose);box-shadow:0 0 0 4px var(--rose-glow);}
.invalid-feedback{color:var(--rose);font-size:11px;margin-top:4px;font-weight:500;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;}

/* ======== TABLES ======== */
table{width:100%;border-collapse:collapse;}
th{
  background:linear-gradient(135deg,var(--pink),var(--peach));
  padding:12px 18px;
  text-align:left;
  font-size:11px;
  text-transform:uppercase;
  letter-spacing:.06em;
  color:var(--muted);
  font-weight:700;
}
td{
  padding:14px 18px;
  font-size:13px;
  border-bottom:1px solid var(--border-light);
  transition:background var(--duration) var(--ease);
}
tr:last-child td{border-bottom:none;}
tr:hover td{background:rgba(253,242,248,.4);}

/* ======== BADGES ======== */
.badge{
  display:inline-flex;
  align-items:center;
  padding:4px 12px;
  border-radius:var(--radius-full);
  font-size:11px;
  font-weight:600;
  letter-spacing:.02em;
  transition:transform var(--duration) var(--ease);
}
.badge:hover{transform:scale(1.05);}
.badge-pending{background:#fef3c7;color:#92400e;border:1px solid #fde68a;}
.badge-confirmed{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;}
.badge-process{background:#dbeafe;color:#1e40af;border:1px solid #93c5fd;}
.badge-ready{background:#ede9fe;color:#5b21b6;border:1px solid #c4b5fd;}
.badge-delivered{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;}
.badge-cancelled{background:var(--rose-dim);color:var(--rose);border:1px solid #fda4af;}

/* ======== PAGE TITLE ======== */
.page-title{
  font-family:'Playfair Display',serif;
  font-size:30px;
  font-weight:700;
  color:var(--brown);
  margin-bottom:28px;
  position:relative;
  display:inline-block;
}
.page-title::after{
  content:'';
  position:absolute;
  bottom:-6px;left:0;
  width:50px;height:3px;
  background:linear-gradient(90deg,var(--rose),var(--rose-light));
  border-radius:3px;
}

/* ======== SCROLLBAR ======== */
::-webkit-scrollbar{width:8px;height:8px;}
::-webkit-scrollbar-track{background:var(--cream);}
::-webkit-scrollbar-thumb{background:var(--border);border-radius:10px;}
::-webkit-scrollbar-thumb:hover{background:var(--muted-light);}

/* ======== RESPONSIVE ======== */
@media(max-width:768px){
  .form-row{grid-template-columns:1fr;}
  .container{padding:20px 16px;}
  .header{padding:0 16px;}
  .header-nav{display:none;}
  .header-brand{font-size:20px;}
  .admin-nav{padding:0 16px;}
  .page-title{font-size:24px;}
}

/* ======== UTILITY ANIMATIONS ======== */
.fade-in{animation:fadeInUp .5s var(--ease) both;}
.fade-in-delay-1{animation-delay:.1s;}
.fade-in-delay-2{animation-delay:.2s;}
.fade-in-delay-3{animation-delay:.3s;}

/* Selection */
::selection{background:var(--rose-dim);color:var(--rose);}

/* Cart Success Modal (Non-blocking Toast with Glow & Progress Bar) */
.cart-modal-overlay {
  position: fixed;
  top: 80px;
  right: 24px;
  z-index: 1000;
  display: flex;
  align-items: flex-start;
  justify-content: flex-end;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease, transform 0.3s ease;
}
.cart-modal-overlay.show {
  opacity: 1;
}
.cart-modal-card {
  pointer-events: auto;
  background: rgba(255, 255, 255, 0.88);
  backdrop-filter: blur(20px) saturate(180%);
  -webkit-backdrop-filter: blur(20px) saturate(180%);
  border: 1px solid rgba(225, 29, 72, 0.15);
  border-radius: 20px;
  padding: 22px 24px;
  width: 360px;
  box-shadow: 
    0 15px 35px rgba(225, 29, 72, 0.08), 
    0 5px 15px rgba(120, 53, 15, 0.05),
    inset 0 0 0 1px rgba(255, 255, 255, 0.5);
  transform: translateY(-20px) scale(0.95);
  transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  overflow: hidden;
  position: relative;
}
.cart-modal-overlay.show .cart-modal-card {
  transform: translateY(0) scale(1);
}
.cart-modal-icon {
  font-size: 24px;
  width: 48px;
  height: 48px;
  background: linear-gradient(135deg, var(--rose), var(--rose-light));
  color: white;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  box-shadow: 0 8px 20px rgba(225, 29, 72, 0.2);
  animation: modalIconPop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
}
@keyframes modalIconPop {
  0% { transform: scale(0) rotate(-15deg); }
  100% { transform: scale(1) rotate(0); }
}
.cart-modal-title {
  font-family: 'Playfair Display', serif;
  font-size: 17px;
  color: var(--brown);
  margin-bottom: 2px;
  font-weight: 700;
}
.cart-modal-message {
  font-size: 13px;
  color: var(--text-secondary);
  margin-bottom: 0;
  line-height: 1.45;
}
.cart-modal-actions {
  display: flex;
  gap: 12px;
  justify-content: flex-end;
  margin-top: 18px;
  border-top: 1px solid rgba(231, 224, 213, 0.5);
  padding-top: 14px;
}
.cart-modal-actions .btn {
  padding: 8px 18px;
  font-size: 12px;
  border-radius: 12px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
}
.cart-modal-actions .btn-outline {
  background: rgba(255, 255, 255, 0.5);
}
.cart-modal-actions .btn-rose {
  box-shadow: 0 4px 12px rgba(225, 29, 72, 0.2);
}
.cart-modal-actions .btn-rose:hover {
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(225, 29, 72, 0.3);
}

/* Toast Progress Bar */
.toast-progress {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 4px;
  width: 100%;
  background: linear-gradient(90deg, var(--rose-light), var(--rose));
  transform-origin: left;
  animation: toastProgress 5s linear forwards;
}
@keyframes toastProgress {
  from { transform: scaleX(1); }
  to { transform: scaleX(0); }
}
</style>
@stack('styles')
</head>
<body>

<header class="header" id="main-header">
  <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('products.index') }}" class="header-brand">
    <span class="brand-icon">🎂</span>
    Sweetly <span>Bakery</span>
  </a>

  @if(!Auth::user()->isAdmin())
  <nav class="header-nav">
    <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*')?'active':'' }}"><span>🎂 Menu</span></a>
    <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.*')?'active':'' }}"><span>📋 Pesanan Saya</span></a>
  </nav>
  @endif

  <div class="header-right">
    <div class="user-pill">
      <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
      {{ Auth::user()->name }}
    </div>
    @if(!Auth::user()->isAdmin())
    @php $cartCount = count(session('cart',[])); @endphp
    <a href="{{ route('cart.index') }}" class="cart-btn">
      🛒 Keranjang @if($cartCount > 0)<span class="cart-badge">{{ $cartCount }}</span>@endif
    </a>
    @endif
    <form method="POST" action="{{ route('logout') }}">
      @csrf <button type="submit" class="btn-logout">Keluar</button>
    </form>
  </div>
</header>

@if(Auth::user()->isAdmin())
<nav class="admin-nav">
  <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard')?'active':'' }}">📊 Dashboard</a>
  <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*')?'active':'' }}">🎂 Produk</a>
  <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*')?'active':'' }}">📋 Pesanan</a>
  <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users')?'active':'' }}">👥 Users</a>
</nav>
@endif

<div class="container">
  @if(session('success'))
    @if(str_contains(session('success'), 'ditambahkan ke keranjang'))
      <!-- Cart Success Modal Popup -->
      <div class="cart-modal-overlay" id="cartModalOverlay">
        <div class="cart-modal-card">
          <div style="display: flex; gap: 16px; align-items: center; text-align: left;">
            <div class="cart-modal-icon">🛍️</div>
            <div>
              <h3 class="cart-modal-title">Berhasil Ditambahkan!</h3>
              <p class="cart-modal-message">{{ session('success') }}</p>
            </div>
          </div>
          <div class="cart-modal-actions">
            <button type="button" class="btn btn-outline" id="btnShopMore">🎂 Belanja Lagi</button>
            <a href="{{ route('cart.index') }}" class="btn btn-rose">🛒 Ke Keranjang</a>
          </div>
          <div class="toast-progress"></div>
        </div>
      </div>
    @else
      <div class="alert alert-success">✨ {{ session('success') }}</div>
    @endif
  @endif
  @if(session('error'))<div class="alert alert-error">⚠️ {{ session('error') }}</div>@endif
  @yield('content')
</div>

<script>
// Sticky header scroll effect
const header = document.getElementById('main-header');
let lastScroll = 0;
window.addEventListener('scroll', () => {
  const scrollY = window.scrollY;
  header.classList.toggle('scrolled', scrollY > 10);
  lastScroll = scrollY;
}, { passive: true });

// Staggered fade-in for cards
document.addEventListener('DOMContentLoaded', () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        entry.target.style.animationDelay = `${i * 0.08}s`;
        entry.target.classList.add('fade-in');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.card, .prod-card, .stat-card').forEach(el => observer.observe(el));
});

// Cart modal popup handler
document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('cartModalOverlay');
  const btnClose = document.getElementById('btnShopMore');
  
  if (overlay) {
    let hideTimeout;
    
    setTimeout(() => {
      overlay.classList.add('show');
      
      // Auto close after 5 seconds
      hideTimeout = setTimeout(() => {
        overlay.classList.remove('show');
      }, 5000);
    }, 100);

    btnClose.addEventListener('click', () => {
      overlay.classList.remove('show');
      clearTimeout(hideTimeout);
    });
  }
});
</script>
@stack('scripts')
</body>
</html>
