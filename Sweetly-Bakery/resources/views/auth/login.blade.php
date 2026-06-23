<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Masuk — Sweetly Bakery</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --rose:#e11d48;--rose-hover:#be123c;--rose-glow:rgba(225,29,72,.15);--rose-dim:#ffe4e6;--rose-subtle:#fff0f3;
  --brown:#78350f;--brown-deep:#451a03;--cream:#faf7f2;--cream-dark:#f5efe6;
  --border:#e7e0d5;--border-light:#f0ebe3;--muted:#78716c;--text:#1c1917;
  --ease:cubic-bezier(0.4,0,0.2,1);--ease-bounce:cubic-bezier(0.34,1.56,0.64,1);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{
  font-family:'DM Sans',sans-serif;
  background:var(--cream);
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:24px;
  overflow:hidden;
  position:relative;
}

/* Animated background */
body::before{
  content:'';position:fixed;inset:0;z-index:-2;
  background:
    linear-gradient(135deg,#faf7f2 0%,#fdf2f8 25%,#fff0f3 50%,#fffbf7 75%,#faf7f2 100%);
  animation:bgPulse 15s ease-in-out infinite alternate;
  background-size:200% 200%;
}
@keyframes bgPulse{
  0%{background-position:0% 50%;}
  100%{background-position:100% 50%;}
}

/* Floating bakery items */
.float-item{
  position:fixed;font-size:48px;opacity:.04;z-index:-1;
  animation:floatAround 25s ease-in-out infinite;
  pointer-events:none;
  font-weight:bold;
}
.float-item:nth-child(1){top:10%;left:5%;animation-delay:0s;animation-duration:20s;}
.float-item:nth-child(2){top:70%;left:90%;animation-delay:-5s;animation-duration:28s;}
.float-item:nth-child(3){top:20%;left:80%;animation-delay:-10s;animation-duration:22s;}
.float-item:nth-child(4){top:80%;left:15%;animation-delay:-15s;animation-duration:25s;}
.float-item:nth-child(5){top:50%;left:50%;animation-delay:-8s;animation-duration:30s;}
.float-item:nth-child(6){top:30%;left:40%;animation-delay:-3s;animation-duration:18s;}
@keyframes floatAround{
  0%,100%{transform:translate(0,0) rotate(0deg);}
  25%{transform:translate(30px,-40px) rotate(10deg);}
  50%{transform:translate(-20px,30px) rotate(-5deg);}
  75%{transform:translate(40px,20px) rotate(8deg);}
}

.wrap{
  display:grid;
  grid-template-columns:1fr 420px;
  max-width:880px;
  width:100%;
  background:rgba(255,255,255,.95);
  backdrop-filter:blur(32px) saturate(200%);
  -webkit-backdrop-filter:blur(32px) saturate(200%);
  border-radius:32px;
  overflow:hidden;
  box-shadow:0 40px 100px rgba(120,53,15,.18),0 0 0 1px rgba(255,255,255,.6) inset,0 8px 20px rgba(225,29,72,.08);
  animation:cardPop .6s cubic-bezier(0.34,1.56,0.64,1) both;
  border:1px solid rgba(231,224,213,.6);
}
@keyframes cardPop{
  from{opacity:0;transform:scale(.94) translateY(20px);}
  to{opacity:1;transform:scale(1) translateY(0);}
}

.left{
  background:linear-gradient(135deg,rgba(253,242,248,.8),rgba(255,247,237,.8),rgba(250,245,255,.6));
  padding:52px 44px;
  display:flex;flex-direction:column;justify-content:center;
  position:relative;overflow:hidden;
}
.left::before{
  content:'';position:absolute;top:-50%;right:-50%;
  width:200%;height:200%;
  background:radial-gradient(circle,rgba(225,29,72,.04) 0%,transparent 60%);
  animation:leftGlow 10s ease-in-out infinite alternate;
}
@keyframes leftGlow{
  0%{transform:translate(0,0);}
  100%{transform:translate(-10%,10%);}
}
.left::after{
  content:'🎂';position:absolute;right:-30px;bottom:-30px;
  font-size:180px;opacity:.05;
  animation:cakeFloat 8s ease-in-out infinite;
}
@keyframes cakeFloat{
  0%,100%{transform:translateY(0) rotate(0deg);}
  50%{transform:translateY(-15px) rotate(3deg);}
}

.left h1{
  font-family:'Playfair Display',serif;
  font-size:42px;font-weight:700;
  background:linear-gradient(135deg,var(--rose),#9d174d);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:6px;
  position:relative;
  line-height:1.2;
  letter-spacing:-0.5px;
}
.left h1 .emoji{
  display:inline-block;
  animation:waveEmoji 3s ease-in-out infinite;
}
@keyframes waveEmoji{
  0%,100%{transform:rotate(0);}
  25%{transform:rotate(15deg);}
  75%{transform:rotate(-10deg);}
}
.left p{
  font-size:15px;color:var(--muted);line-height:1.8;
  margin-bottom:8px;position:relative;
  font-weight:500;
}
.promo-label{
  font-size:11px;font-weight:700;
  text-transform:uppercase;letter-spacing:.1em;
  color:var(--rose);
  margin-bottom:16px;
  margin-top:4px;
  display:flex;align-items:center;gap:6px;
  animation:slideInPromo .6s cubic-bezier(0.34,1.56,0.64,1) .2s backwards;
}
.promo-label::before{
  content:'✦';
  font-size:8px;
  animation:spinBefore .8s ease-in-out infinite;
}
@keyframes slideInPromo{
  from{opacity:0;transform:translateX(-12px);}
  to{opacity:1;transform:translateX(0);}
}
@keyframes spinBefore{
  0%,100%{transform:scale(1) rotate(0deg);}
  50%{transform:scale(1.2) rotate(180deg);}
}
.feat{
  display:flex;align-items:center;gap:14px;
  margin-bottom:12px;font-size:13px;color:white;
  padding:16px 18px;
  background:linear-gradient(135deg,rgba(225,29,72,.85),rgba(244,114,182,.85));
  border-radius:16px;
  border:1px solid rgba(255,255,255,.2);
  transition:all .35s cubic-bezier(0.34,1.56,0.64,1);
  position:relative;overflow:hidden;
  box-shadow:0 8px 24px rgba(225,29,72,.25),inset 0 1px 0 rgba(255,255,255,.3);
  animation:slideInFeat .5s cubic-bezier(0.34,1.56,0.64,1) backwards;
  animation-fill-mode:both;
}
.feat:nth-child(3),
.feat:nth-child(4),
.feat:nth-child(5){
  animation-delay:0s;
}
@keyframes slideInFeat{
  from{opacity:0;transform:translateY(12px);}
  to{opacity:1;transform:translateY(0);}
}
.feat::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,transparent 0%,rgba(255,255,255,.1) 100%);
  pointer-events:none;
}
.feat::after{
  content:'';position:absolute;inset:-50%;
  background:radial-gradient(circle,rgba(255,255,255,.3) 0%,transparent 70%);
  opacity:0;animation:promoGlow 3s ease-in-out infinite;
  pointer-events:none;
}
@keyframes promoGlow{
  0%,100%{opacity:0;transform:scale(1);}
  50%{opacity:.4;transform:scale(1.2);}
}
.feat:hover{
  transform:translateY(-4px) scale(1.02);
  box-shadow:0 16px 40px rgba(225,29,72,.35),inset 0 1px 0 rgba(255,255,255,.3);
  background:linear-gradient(135deg,rgba(225,29,72,.95),rgba(244,114,182,.95));
}
.feat:hover::after{
  animation:promoGlowActive .5s ease-out forwards;
}
@keyframes promoGlowActive{
  0%{opacity:0;transform:scale(1);}
  100%{opacity:.6;transform:scale(1.5);}
}
.feat-icon{
  width:40px;height:40px;
  background:linear-gradient(135deg,rgba(255,255,255,.3),rgba(255,255,255,.1));
  border-radius:12px;
  display:flex;align-items:center;justify-content:center;
  font-size:20px;
  flex-shrink:0;
  border:1px solid rgba(255,255,255,.2);
  box-shadow:0 4px 12px rgba(0,0,0,.15);
  backdrop-filter:blur(8px);
  transition:all .3s ease;
}
.feat:hover .feat-icon{
  background:linear-gradient(135deg,rgba(255,255,255,.4),rgba(255,255,255,.2));
  transform:scale(1.1) rotate(8deg);
  box-shadow:0 6px 16px rgba(0,0,0,.2);
}

.right{padding:48px 40px;position:relative;}
.right::before{
  content:'';position:absolute;top:0;left:0;right:0;height:4px;
  background:linear-gradient(90deg,var(--rose),#f97316,var(--rose));
  background-size:200% 100%;
  animation:gradientSlide 4s ease infinite;
}
@keyframes gradientSlide{
  0%{background-position:0% 50%;}
  50%{background-position:100% 50%;}
  100%{background-position:0% 50%;}
}

.right h2{
  font-family:'Playfair Display',serif;
  font-size:26px;font-weight:700;
  margin-bottom:4px;color:var(--brown);
}
.right .sub{font-size:14px;color:var(--muted);margin-bottom:28px;}

.tabs{
  display:flex;gap:4px;
  background:rgba(245,239,230,.7);
  border-radius:14px;
  padding:5px;
  margin-bottom:26px;
  border:1px solid var(--border-light);
}
.tab{
  flex:1;padding:10px 16px;
  border:none;border-radius:10px;
  background:transparent;
  font-family:'DM Sans',sans-serif;
  font-size:14px;font-weight:600;
  cursor:pointer;color:var(--muted);
  transition:all .3s var(--ease);
  position:relative;
}
.tab.active{
  background:white;
  color:var(--rose);
  box-shadow:0 2px 10px rgba(0,0,0,.06),0 0 0 1px rgba(225,29,72,.08);
}
.tab:not(.active):hover{color:var(--text);}

.form-group{margin-bottom:16px;}
.form-group label{
  display:block;font-size:11px;font-weight:700;
  color:var(--muted);margin-bottom:6px;
  text-transform:uppercase;letter-spacing:.08em;
}
.form-control{
  width:100%;padding:12px 16px;
  border:1.5px solid var(--border);
  border-radius:12px;
  font-family:'DM Sans',sans-serif;
  font-size:14px;color:var(--text);
  outline:none;background:rgba(255,255,255,.6);
  backdrop-filter:blur(4px);
  transition:all .25s var(--ease);
}
.form-control:focus{
  border-color:var(--rose);
  box-shadow:0 0 0 4px rgba(225,29,72,.1);
  background:white;
}
.form-control:hover{border-color:var(--muted);}
.form-control::placeholder{color:#a8a29e;}
.form-control.is-invalid{border-color:var(--rose);box-shadow:0 0 0 4px rgba(225,29,72,.1);}
.invalid-feedback{color:var(--rose);font-size:11px;margin-top:4px;font-weight:500;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}

.btn-submit{
  width:100%;padding:14px;
  background:linear-gradient(135deg,var(--rose),#c2185b);
  color:white;border:none;border-radius:14px;
  font-family:'DM Sans',sans-serif;font-size:15px;font-weight:700;
  cursor:pointer;transition:all .3s var(--ease);
  margin-top:6px;
  box-shadow:0 6px 20px rgba(225,29,72,.3);
  position:relative;overflow:hidden;
}
.btn-submit::before{
  content:'';position:absolute;top:-50%;left:-50%;
  width:200%;height:200%;
  background:linear-gradient(45deg,transparent 30%,rgba(255,255,255,.15) 50%,transparent 70%);
  transform:translateX(-100%);
  transition:transform .6s ease;
}
.btn-submit:hover::before{transform:translateX(100%);}
.btn-submit:hover{
  transform:translateY(-2px);
  box-shadow:0 10px 30px rgba(225,29,72,.4);
}
.btn-submit:active{transform:translateY(0);box-shadow:0 4px 14px rgba(225,29,72,.3);}

.hint{
  background:rgba(250,247,242,.8);
  border:1px solid var(--border-light);
  border-radius:12px;
  padding:14px 18px;
  font-size:12px;
  color:var(--muted);
  margin-top:18px;
  text-align:center;
  line-height:1.9;
  backdrop-filter:blur(4px);
}
.hint strong{color:var(--brown);font-weight:700;}
.hint code{
  background:var(--rose-subtle);
  color:var(--rose);
  padding:2px 6px;
  border-radius:4px;
  font-size:11px;
  font-family:'DM Sans',sans-serif;
}

.alert-ok{
  background:rgba(253,242,248,.85);
  border:1px solid #fbcfe8;
  color:#9d174d;
  padding:12px 16px;
  border-radius:12px;
  font-size:13px;
  margin-bottom:16px;
  display:flex;align-items:center;gap:8px;
  animation:slideIn .4s var(--ease-bounce) both;
}
.alert-err{
  background:rgba(255,228,230,.85);
  border:1px solid #fda4af;
  color:var(--rose);
  padding:12px 16px;
  border-radius:12px;
  font-size:13px;
  margin-bottom:16px;
  display:flex;align-items:center;gap:8px;
  animation:slideIn .4s var(--ease-bounce) both;
}
@keyframes slideIn{
  from{opacity:0;transform:translateY(-10px);}
  to{opacity:1;transform:translateY(0);}
}

/* Form transition */
.form-panel{transition:opacity .3s ease,transform .3s ease;}
.form-panel.hidden{display:none;}

@media(max-width:768px){
  .wrap{grid-template-columns:1fr;max-width:420px;}
  .left{display:none;}
  .right{padding:32px 24px;}
}
@media(max-width:480px){
  .form-row{grid-template-columns:1fr;}
  .right{padding:28px 20px;}
}
</style>
</head>
<body>
<div class="float-item">🎂</div>
<div class="float-item">🧁</div>
<div class="float-item">🍰</div>
<div class="float-item">🍪</div>
<div class="float-item">🍫</div>
<div class="float-item">🥐</div>

<div class="wrap">
  <div class="left">
    <h1><span class="emoji">🎂</span> Sweetly Bakery</h1>
    <p>Pesan kue & bakery favorit kamu dengan mudah. Fresh, homemade, diantar ke pintu rumahmu!</p>    
    <div class="promo-label">Produk Unggulan</div>

    <div class="feat">
      <div class="feat-icon">🧇</div>
      <span>Waffle Crispy Premium</span>
    </div>
     <div class="feat">
      <div class="feat-icon">🍩</div>
      <span>Donat Lezat</span>
    </div>
    <div class="feat">
      <div class="feat-icon">🧆</div>
      <span>Dubai Series Viral</span>
    </div>
    <div class="feat">
      <div class="feat-icon">🎂</div>
      <span>Cake Custom Spesial</span>
    </div>
  </div>

  <div class="right">
    <h2>Selamat datang! 👋</h2>
    <p class="sub">Masuk atau daftar untuk mulai pesan</p>

    <div class="tabs">
      <button class="tab active" onclick="switchTab('login',this)">Masuk</button>
      <button class="tab" onclick="switchTab('register',this)">Daftar</button>
    </div>

    {{-- LOGIN --}}
    <div id="form-login" class="form-panel">
      @if(session('success'))<div class="alert-ok">✨ {{ session('success') }}</div>@endif
      @if($errors->any() && old('_form','login')==='login')<div class="alert-err">⚠️ {{ $errors->first() }}</div>@endif
      <form method="POST" action="{{ route('login') }}">
        @csrf <input type="hidden" name="_form" value="login">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="email@kamu.com" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-submit">Masuk →</button>
      </form>
      <div class="hint">
        <strong>🔑 Demo Account:</strong><br>
        Admin → <code>admin@sweetly.com</code> / <code>admin123</code><br>
        Customer → <code>user@sweetly.com</code> / <code>user123</code>
      </div>
    </div>

    {{-- REGISTER --}}
    <div id="form-register" class="form-panel hidden">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" class="form-control {{ $errors->has('name')?'is-invalid':'' }}" placeholder="Nama kamu" value="{{ old('name') }}" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" placeholder="email@kamu.com" value="{{ old('email') }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label>No. HP</label>
            <input type="tel" name="phone" class="form-control {{ $errors->has('phone')?'is-invalid':'' }}" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required>
            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="address" class="form-control {{ $errors->has('address')?'is-invalid':'' }}" placeholder="Alamat lengkap kamu" value="{{ old('address') }}" required>
          @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" placeholder="Min. 6 karakter" required>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label>Konfirmasi</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
          </div>
        </div>
        <button type="submit" class="btn-submit">Buat Akun →</button>
      </form>
    </div>
  </div>
</div>

<script>
function switchTab(tab, el) {
  const loginPanel = document.getElementById('form-login');
  const registerPanel = document.getElementById('form-register');

  if (tab === 'login') {
    loginPanel.classList.remove('hidden');
    registerPanel.classList.add('hidden');
  } else {
    loginPanel.classList.add('hidden');
    registerPanel.classList.remove('hidden');
  }

  document.querySelectorAll('.tab').forEach((b, i) =>
    b.classList.toggle('active', (i === 0 && tab === 'login') || (i === 1 && tab === 'register'))
  );
}
@if($errors->any() && old('_form')!=='login') switchTab('register',null); @endif
</script>
</body>
</html>
