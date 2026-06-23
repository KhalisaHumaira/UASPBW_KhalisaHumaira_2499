@extends('layouts.app')
@section('title', $product->name)
@push('styles')
<style>
.back-link{
  display:inline-flex;align-items:center;gap:8px;
  color:#78716c;font-size:13px;font-weight:500;
  margin-bottom:24px;padding:8px 16px;
  border-radius:10px;
  transition:all .25s ease;
  border:1px solid transparent;
}
.back-link:hover{
  color:#e11d48;
  background:rgba(255,240,243,.5);
  border-color:rgba(251,207,232,.5);
  transform:translateX(-4px);
}

.product-layout{
  display:grid;
  grid-template-columns:420px 1fr;
  gap:32px;
  align-items:start;
  animation:fadeInUp .5s ease both;
}
@keyframes fadeInUp{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}

.product-image{
  border-radius:24px;
  height:360px;
  display:flex;align-items:center;justify-content:center;
  font-size:120px;
  border:1px solid rgba(231,224,213,.6);
  position:relative;
  overflow:hidden;
  box-shadow:0 12px 40px rgba(120,53,15,.1);
  transition:transform .5s ease;
}
.product-image:hover{transform:scale(1.02);}
.product-image::after{
  content:'';position:absolute;inset:0;
  background:linear-gradient(180deg,transparent 60%,rgba(0,0,0,.04) 100%);
}

.product-info-panel{
  background:rgba(255,255,255,.75);
  backdrop-filter:blur(12px);
  border-radius:18px;
  padding:22px;
  border:1px solid rgba(231,224,213,.5);
  box-shadow:0 4px 16px rgba(120,53,15,.06);
  margin-top:18px;
}
.info-title{
  font-size:12px;font-weight:700;
  color:#78716c;text-transform:uppercase;
  letter-spacing:.08em;margin-bottom:14px;
  display:flex;align-items:center;gap:6px;
}
.info-row{
  display:flex;justify-content:space-between;
  padding:10px 0;
  border-bottom:1px solid rgba(240,230,211,.5);
  font-size:13px;
  transition:background .2s ease;
}
.info-row:last-child{border-bottom:none;}
.info-row:hover{background:rgba(253,242,248,.3);margin:0 -8px;padding:10px 8px;border-radius:8px;}
.info-label{color:#78716c;}
.info-value{font-weight:600;color:#1c1917;}

.product-category{
  font-size:11px;font-weight:700;
  color:#e11d48;text-transform:uppercase;
  letter-spacing:.12em;margin-bottom:8px;
  display:inline-flex;align-items:center;gap:6px;
  padding:4px 12px;
  background:rgba(255,240,243,.6);
  border-radius:20px;
  border:1px solid rgba(251,207,232,.4);
}

.product-title{
  font-family:'Playfair Display',serif;
  font-size:34px;font-weight:700;
  color:#78350f;margin-bottom:10px;line-height:1.25;
}
.product-price{
  font-family:'Playfair Display',serif;
  font-size:30px;color:#e11d48;font-weight:700;
  margin-bottom:20px;
  display:flex;align-items:center;gap:8px;
}
.product-price::before{
  content:'';width:4px;height:28px;
  background:linear-gradient(180deg,#e11d48,#fb7185);
  border-radius:4px;
}
.product-description{
  font-size:15px;color:#57534e;
  line-height:1.8;margin-bottom:28px;
}

.order-card{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  padding:28px;
  box-shadow:0 8px 28px rgba(120,53,15,.08);
  transition:all .3s ease;
}
.order-card:hover{box-shadow:0 12px 40px rgba(120,53,15,.12);}

.qty-input{
  width:100px;padding:10px;
  border:1.5px solid #e7e0d5;border-radius:12px;
  font-family:'DM Sans',sans-serif;font-size:14px;
  text-align:center;outline:none;
  transition:all .25s ease;
  background:rgba(255,255,255,.8);
}
.qty-input:focus{border-color:#e11d48;box-shadow:0 0 0 4px rgba(225,29,72,.1);}

.btn-add-cart{
  width:100%;
  padding:15px;
  background:linear-gradient(135deg,#e11d48,#c2185b);
  color:white;border:none;
  border-radius:14px;
  font-family:'DM Sans',sans-serif;
  font-size:16px;font-weight:700;
  cursor:pointer;
  transition:all .3s ease;
  box-shadow:0 6px 20px rgba(225,29,72,.3);
  display:flex;align-items:center;justify-content:center;gap:8px;
  position:relative;overflow:hidden;
}
.btn-add-cart::before{
  content:'';position:absolute;top:-50%;left:-50%;
  width:200%;height:200%;
  background:linear-gradient(45deg,transparent 30%,rgba(255,255,255,.15) 50%,transparent 70%);
  transform:translateX(-100%);transition:transform .6s ease;
}
.btn-add-cart:hover::before{transform:translateX(100%);}
.btn-add-cart:hover{
  transform:translateY(-2px);
  box-shadow:0 10px 30px rgba(225,29,72,.4);
}

.oos-banner{
  background:linear-gradient(135deg,rgba(255,247,237,.8),rgba(254,243,199,.5));
  border:1px solid #fed7aa;
  border-radius:16px;
  padding:24px;
  text-align:center;
  color:#78350f;
  font-weight:600;
  font-size:15px;
  box-shadow:0 4px 16px rgba(217,119,6,.1);
}

@media(max-width:768px){
  .product-layout{grid-template-columns:1fr;}
  .product-image{height:280px;font-size:90px;}
  .product-title{font-size:26px;}
  .product-price{font-size:24px;}
}
</style>
@endpush
@section('content')
<a href="{{ route('products.index') }}" class="back-link">← Kembali ke Menu</a>

<div class="product-layout">
  <div>
    <div class="product-image" style="background:{{ $product->bg_color }};">
    @if($product->image)
      <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">
    @else
      {{ $product->emoji }}
    @endif
  </div>
    <div class="product-info-panel">
      <div class="info-title">📋 Info Produk</div>
      <div class="info-row">
        <span class="info-label">Kategori</span>
        <span class="info-value">{{ $product->category->icon }} {{ $product->category->name }}</span>
      </div>
      <div class="info-row">
        <span class="info-label">Stok</span>
        <span class="info-value" style="color:{{ $product->stock > 0 ? '#16a34a':'#e11d48' }}">{{ $product->stock > 0 ? $product->stock.' tersedia' : 'Habis' }}</span>
      </div>
      <div class="info-row">
        <span class="info-label">Custom Order</span>
        <span class="info-value">{{ $product->is_custom_order ? '✅ Ya' : '❌ Tidak' }}</span>
      </div>
    </div>
  </div>

  <div>
    <div class="product-category">{{ $product->category->icon }} {{ $product->category->name }}</div>
    <h1 class="product-title">{{ $product->name }}</h1>
    <div class="product-price">Rp {{ number_format($product->price,0,',','.') }}</div>
    <p class="product-description">{{ $product->description }}</p>

    @if($product->stock > 0)
    <div class="order-card">
      <form method="POST" action="{{ route('cart.add') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" name="qty" class="qty-input" value="1" min="1" max="{{ min(10,$product->stock) }}">
        </div>
        @if($product->is_custom_order)
        <div class="form-group">
          <label>Permintaan Khusus (opsional)</label>
          <textarea name="custom_note" class="form-control" rows="3" placeholder="Contoh: Tulisan 'Happy Birthday Budi', warna merah muda, fondant..." style="resize:vertical;"></textarea>
        </div>
        @endif
        <button type="submit" class="btn-add-cart">🛒 Tambah ke Keranjang</button>
      </form>
    </div>
    @else
      <div class="oos-banner">😢 Produk sedang habis — silakan cek kembali nanti</div>
    @endif
  </div>
</div>
@endsection
