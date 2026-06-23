@extends('layouts.app')
@section('title','Menu')
@push('styles')
<style>
/* ======== HERO SECTION ======== */
.hero{
  background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
  background-image: 
    radial-gradient(rgba(217, 119, 6, 0.05) 1.5px, transparent 0),
    radial-gradient(rgba(217, 119, 6, 0.05) 1.5px, transparent 0);
  background-size: 24px 24px;
  background-position: 0 0, 12px 12px;
  border-radius: 24px;
  padding: 56px 44px;
  margin-bottom: 36px;
  position: relative;
  overflow: hidden;
  border: 1.5px solid rgba(251, 191, 36, 0.35);
  box-shadow: 0 10px 30px rgba(120, 53, 15, 0.04);
  display: flex;
  align-items: center;
}
.hero-content {
  position: relative;
  z-index: 2;
}
.hero-tagline {
  display: inline-block;
  font-size: 11px;
  font-weight: 800;
  color: #b45309;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  margin-bottom: 12px;
  background: rgba(251, 191, 36, 0.2);
  padding: 4px 14px;
  border-radius: 9999px;
  border: 1px solid rgba(251, 191, 36, 0.4);
}
.hero h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  font-weight: 800;
  color: #451a03;
  margin-bottom: 8px;
  line-height: 1.2;
}
.hero p {
  font-size: 14.5px;
  color: #78350f;
  line-height: 1.7;
  max-width: 520px;
}
.hero-deco {
  position: absolute;
  font-size: 40px;
  opacity: 0.16;
  user-select: none;
  z-index: 1;
}
.hero-deco-1 { top: 20px; left: 30px; animation: floatDeco 6s ease-in-out infinite; }
.hero-deco-2 { bottom: 20px; right: 80px; animation: floatDecoReverse 7s ease-in-out infinite; font-size: 56px; }
.hero-deco-3 { top: 40px; right: 180px; animation: floatDeco 5s ease-in-out infinite; }
.hero-deco-4 { bottom: 40px; left: 240px; animation: floatDecoReverse 8s ease-in-out infinite; }

@keyframes floatDeco {
  0% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-10px) rotate(5deg); }
  100% { transform: translateY(0px) rotate(0deg); }
}
@keyframes floatDecoReverse {
  0% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(8px) rotate(-6deg); }
  100% { transform: translateY(0px) rotate(0deg); }
}

/* ======== FILTER BAR ======== */
.filter-bar{
  display:flex;gap:10px;margin-bottom:28px;flex-wrap:wrap;align-items:center;
  padding:16px 20px;
  background:rgba(255,255,255,.6);
  backdrop-filter:blur(12px);
  border-radius:16px;
  border:1px solid rgba(231,224,213,.5);
  box-shadow:0 2px 12px rgba(120,53,15,.04);
}
.filter-pill{
  padding:8px 18px;border-radius:9999px;
  font-size:13px;font-weight:500;
  cursor:pointer;
  border:1.5px solid #e7e0d5;
  background:rgba(255,255,255,.7);
  color:#78716c;
  transition:all .25s cubic-bezier(0.4,0,0.2,1);
  text-decoration:none;
}
.filter-pill:hover{
  border-color:#fb7185;color:#e11d48;
  background:rgba(255,240,243,.6);
  transform:translateY(-2px);
  box-shadow:0 4px 12px rgba(225,29,72,.1);
}
.filter-pill.active{
  background:linear-gradient(135deg,#e11d48,#c2185b);
  color:white;border-color:transparent;
  box-shadow:0 4px 14px rgba(225,29,72,.3);
  transform:translateY(-2px);
}
.search-wrap{
  display:flex;align-items:center;gap:8px;
  margin-left:auto;
}
.search-input{
  padding:10px 18px;
  border:1.5px solid #e7e0d5;
  border-radius:9999px;
  font-family:'DM Sans',sans-serif;
  font-size:13px;outline:none;
  min-width:220px;
  background:rgba(255,255,255,.7);
  backdrop-filter:blur(4px);
  transition:all .25s ease;
}
.search-input:focus{
  border-color:#e11d48;
  box-shadow:0 0 0 4px rgba(225,29,72,.1);
  background:white;
}
.search-input::placeholder{color:#a8a29e;}

/* ======== PRODUCT GRID ======== */
.grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
  gap:28px;
}

.prod-card{
  background: rgba(255, 255, 255, 0.75);
  backdrop-filter: blur(16px) saturate(180%);
  -webkit-backdrop-filter: blur(16px) saturate(180%);
  border-radius: 24px;
  overflow: hidden;
  border: 1px solid rgba(231, 224, 213, 0.5);
  transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  box-shadow: 0 8px 30px rgba(120, 53, 15, 0.03);
  position: relative;
  opacity: 0;
  animation: cardAppear .5s ease forwards;
}
.prod-card:nth-child(1){animation-delay:.05s;}
.prod-card:nth-child(2){animation-delay:.1s;}
.prod-card:nth-child(3){animation-delay:.15s;}
.prod-card:nth-child(4){animation-delay:.2s;}
.prod-card:nth-child(5){animation-delay:.25s;}
.prod-card:nth-child(6){animation-delay:.3s;}
.prod-card:nth-child(7){animation-delay:.35s;}
.prod-card:nth-child(8){animation-delay:.4s;}
@keyframes cardAppear{
  from{opacity:0;transform:translateY(20px);}
  to{opacity:1;transform:translateY(0);}
}

.prod-card:hover{
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(225, 29, 72, 0.08), 0 4px 12px rgba(120, 53, 15, 0.02);
  border-color: rgba(225, 29, 72, 0.25);
}

.prod-img{
  height: 190px;
  display: flex; align-items: center; justify-content: center;
  font-size: 72px;
  position: relative;
  overflow: hidden;
  transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.prod-card:hover .prod-img{transform: scale(1.04);}
.prod-img::before{
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(180deg, transparent 70%, rgba(69, 26, 3, 0.06) 100%);
  z-index: 1;
}
.prod-custom-badge{
  position: absolute; top: 12px; right: 12px;
  background: linear-gradient(135deg, #d97706, #b45309);
  color: white; font-size: 10px; font-weight: 800;
  padding: 4px 10px; border-radius: 20px;
  box-shadow: 0 4px 12px rgba(217, 119, 6, 0.25);
  z-index: 2;
  animation: badgePulse 2s ease-in-out infinite;
}
@keyframes badgePulse{
  0%,100%{box-shadow:0 4px 12px rgba(217, 119, 6, 0.25);}
  50%{box-shadow:0 4px 20px rgba(217, 119, 6, 0.4);}
}

.prod-body{padding: 20px 22px;}
.prod-cat{
  font-size: 9px; font-weight: 800;
  color: #b45309; text-transform: uppercase;
  letter-spacing: .08em; margin-bottom: 8px;
  background: rgba(251, 191, 36, 0.12);
  padding: 3px 8px; border-radius: 6px;
  display: inline-flex; align-items: center; gap: 3px;
  width: fit-content;
  border: 0.5px solid rgba(251, 191, 36, 0.3);
}
.prod-name{
  font-family: 'DM Sans', sans-serif;
  font-size: 16px; font-weight: 700;
  color: #451a03;
  margin-bottom: 6px; line-height: 1.4;
  letter-spacing: -0.01em;
}
.prod-desc{
  font-size: 12.5px; color: #78716c;
  line-height: 1.6; margin-bottom: 16px;
}
.prod-footer{
  display: flex;
  flex-direction: column;
  gap: 12px;
  padding-top: 16px;
  border-top: 1px solid rgba(231, 224, 213, 0.5);
}
.prod-price-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
}
.prod-button-row {
  display: flex;
  gap: 8px;
  align-items: center;
  width: 100%;
}
.prod-price{
  font-weight: 800; color: #78350f; font-size: 16px;
  font-family: 'DM Sans', sans-serif;
  white-space: nowrap;
}
.stock-badge{
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 10px;
  font-weight: 700;
  padding: 3px 8px;
  border-radius: 8px;
}
.stock-badge.available {
  background: rgba(34, 197, 94, 0.1);
  color: #16a34a;
}
.stock-badge.oos {
  background: rgba(225, 29, 72, 0.08);
  color: var(--rose);
}
.stock-badge::before {
  content: ''; width: 5px; height: 5px;
  border-radius: 50%;
  display: inline-block;
}
.stock-badge.available::before { background: #22c55e; }
.stock-badge.oos::before { background: var(--rose); }

.btn-add{
  background: linear-gradient(135deg, var(--rose), #c2185b);
  color: white; border: none;
  padding: 9px 18px;
  border-radius: 20px;
  font-size: 12px; font-weight: 700;
  cursor: pointer;
  font-family: 'DM Sans', sans-serif;
  transition: all .25s ease;
  box-shadow: 0 4px 12px rgba(225, 29, 72, 0.15);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 4px;
  width: 100%;
}
.btn-add:hover{
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(225, 29, 72, 0.3);
}
.btn-see {
  background: rgba(255, 255, 255, 0.6);
  border: 1.5px solid var(--border);
  color: var(--text-secondary);
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 12px; font-weight: 600;
  cursor: pointer;
  font-family: 'DM Sans', sans-serif;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  flex: 1;
}
.btn-see:hover {
  background: white;
  border-color: var(--rose);
  color: var(--rose);
  transform: translateY(-2px);
}

/* ======== EMPTY STATE ======== */
.empty{
  text-align:center;padding:100px 40px;
  color:#78716c;
}
.empty-icon{
  width:100px;height:100px;
  background:linear-gradient(135deg,rgba(253,242,248,.8),rgba(255,247,237,.8));
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:48px;
  margin:0 auto 20px;
  box-shadow:0 8px 30px rgba(120,53,15,.08);
  animation:emptyBounce 3s ease-in-out infinite;
}
@keyframes emptyBounce{
  0%,100%{transform:translateY(0);}
  50%{transform:translateY(-10px);}
}

@media(max-width:640px){
  .hero{padding:28px 24px;}
  .hero h2{font-size:24px;}
  .hero::after{display:none;}
  .grid{grid-template-columns:1fr;}
  .filter-bar{flex-direction:column;align-items:stretch;}
  .search-wrap{margin-left:0;}
  .search-input{min-width:auto;width:100%;}
}
</style>
@endpush
@section('content')
<div class="hero">
  <div class="hero-deco hero-deco-1">🥐</div>
  <div class="hero-deco hero-deco-2">🍰</div>
  <div class="hero-deco hero-deco-3">🍪</div>
  <div class="hero-deco hero-deco-4">🍞</div>
  <div class="hero-content">
    <span class="hero-tagline">✨ Freshly Baked Daily ✨</span>
    <h2>Menu Sweetly Bakery</h2>
    <p>Dibuat dengan cinta, menggunakan bahan premium pilihan, dan dipanggang segar setiap pagi untuk menghangatkan hari-harimu.</p>
  </div>
</div>

<form method="GET" class="filter-bar">
  <a href="{{ route('products.index') }}" class="filter-pill {{ !request('category')?'active':'' }}">🎂 Semua</a>
  @foreach($categories as $cat)
    <a href="{{ route('products.index',['category'=>$cat->id,'search'=>request('search')]) }}" class="filter-pill {{ request('category')==$cat->id?'active':'' }}">{{ $cat->icon }} {{ $cat->name }}</a>
  @endforeach
  <div class="search-wrap">
    <input type="hidden" name="category" value="{{ request('category') }}">
    <input class="search-input" type="text" name="search" placeholder="🔍  Cari produk..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-rose btn-sm">Cari</button>
    @if(request('search'))<a href="{{ route('products.index',['category'=>request('category')]) }}" style="font-size:12px;color:#78716c;white-space:nowrap;">✕ Reset</a>@endif
  </div>
</form>

@if($products->isEmpty())
  <div class="empty">
    <div class="empty-icon">🎂</div>
    <p style="font-size:15px;font-weight:500;">Produk tidak ditemukan.</p>
    <p style="font-size:13px;margin-top:6px;">Coba kata kunci lain atau lihat semua menu</p>
  </div>
@else
<div class="grid">
  @foreach($products as $p)
  <div class="prod-card">
    <div class="prod-img" style="background:{{ $p->bg_color }};">
      @if($p->image)
        <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">
      @else
        {{ $p->emoji }}
      @endif
      @if($p->is_custom_order)<span class="prod-custom-badge">✨ Custom Order</span>@endif
    </div>
    <div class="prod-body">
      <div class="prod-cat">{{ $p->category->icon }} {{ $p->category->name }}</div>
      <div class="prod-name">{{ $p->name }}</div>
      <div class="prod-desc">{{ Str::limit($p->description,60) }}</div>
      <div class="prod-footer">
        <div class="prod-price-row">
          <div class="prod-price">Rp{{ number_format($p->price,0,',','.') }}</div>
          @if($p->stock > 0)
            <div class="stock-badge available">Stok: {{ $p->stock }}</div>
          @else
            <div class="stock-badge oos">Habis</div>
          @endif
        </div>
        <div class="prod-button-row">
          <a href="{{ route('products.show',$p) }}" class="btn-see">Lihat</a>
          @if($p->stock > 0)
          <form method="POST" action="{{ route('cart.add') }}" style="flex: 1.2;">
            @csrf
            <input type="hidden" name="product_id" value="{{ $p->id }}">
            <input type="hidden" name="qty" value="1">
            <button type="submit" class="btn-add">Pesan</button>
          </form>
          @else
          <button type="button" class="btn-add" style="opacity:.6;cursor:not-allowed;flex: 1.2;">Habis</button>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif
@endsection
