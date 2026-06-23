@extends('layouts.app')
@section('title','Pesanan Saya')
@push('styles')
<style>
.orders-empty{
  text-align:center;padding:100px 40px;color:#78716c;
}
.orders-empty-icon{
  width:100px;height:100px;
  background:linear-gradient(135deg,rgba(253,242,248,.8),rgba(255,247,237,.8));
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:48px;margin:0 auto 20px;
  box-shadow:0 8px 30px rgba(120,53,15,.08);
  animation:emptyFloat 3s ease-in-out infinite;
}
@keyframes emptyFloat{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}

.orders-list{display:flex;flex-direction:column;gap:18px;}

.order-card{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  padding:24px 28px;
  box-shadow:0 4px 16px rgba(120,53,15,.06);
  transition:all .3s ease;
  opacity:0;
  animation:cardSlide .5s ease forwards;
}
.order-card:nth-child(1){animation-delay:.05s;}
.order-card:nth-child(2){animation-delay:.1s;}
.order-card:nth-child(3){animation-delay:.15s;}
.order-card:nth-child(4){animation-delay:.2s;}
.order-card:nth-child(5){animation-delay:.25s;}
@keyframes cardSlide{
  from{opacity:0;transform:translateY(12px);}
  to{opacity:1;transform:translateY(0);}
}
.order-card:hover{
  box-shadow:0 12px 36px rgba(120,53,15,.1);
  transform:translateY(-3px);
  border-color:rgba(251,207,232,.5);
}

.order-top{
  display:flex;justify-content:space-between;
  align-items:flex-start;flex-wrap:wrap;gap:14px;
}
.order-code{
  font-size:12px;color:#78716c;margin-bottom:5px;
  display:flex;align-items:center;gap:6px;
}
.order-code span{
  background:rgba(245,239,230,.6);
  padding:2px 8px;border-radius:6px;
  font-weight:600;font-size:11px;
}
.order-items{font-weight:600;font-size:15px;margin-bottom:6px;color:#1c1917;line-height:1.4;}
.order-meta{
  font-size:12px;color:#78716c;
  display:flex;align-items:center;gap:12px;flex-wrap:wrap;
}
.order-meta-item{
  display:flex;align-items:center;gap:4px;
}
.order-right{text-align:right;}
.order-total{
  font-weight:700;font-size:18px;color:#78350f;margin-bottom:8px;
  font-family:'DM Sans',sans-serif;
}

.order-actions{
  display:flex;gap:10px;
  margin-top:16px;
  padding-top:16px;
  border-top:1px solid rgba(240,230,211,.5);
}
</style>
@endpush
@section('content')
<h2 class="page-title">📋 Pesanan Saya</h2>
@if($orders->isEmpty())
  <div class="orders-empty">
    <div class="orders-empty-icon">📋</div>
    <p style="font-size:15px;font-weight:500;">Belum ada pesanan</p>
    <p style="font-size:13px;margin-top:6px;margin-bottom:20px;color:#a8a29e;">Yuk pesan kue favorit kamu sekarang!</p>
    <a href="{{ route('products.index') }}" class="btn btn-rose" style="padding:12px 28px;font-size:14px;">🎂 Pesan Sekarang</a>
  </div>
@else
<div class="orders-list">
  @foreach($orders as $o)
  <div class="order-card">
    <div class="order-top">
      <div>
        <div class="order-code">
          <span>#{{ $o->order_code }}</span>
          · {{ $o->created_at->format('d M Y, H:i') }}
        </div>
        <div class="order-items">{{ $o->items->map(fn($i)=>$i->product->name.' x'.$i->qty)->implode(', ') }}</div>
        <div class="order-meta">
          <div class="order-meta-item">📅 {{ $o->delivery_date->format('d M Y') }}</div>
          <div class="order-meta-item">📍 {{ Str::limit($o->delivery_address,40) }}</div>
        </div>
      </div>
      <div class="order-right">
        <div class="order-total">Rp {{ number_format($o->total_price,0,',','.') }}</div>
        <span class="badge badge-{{ $o->status }}">{{ $o->status_label }}</span>
      </div>
    </div>
    <div class="order-actions">
      <a href="{{ route('orders.show',$o) }}" class="btn btn-sm btn-outline">Lihat Detail</a>
      @if(in_array($o->status,['pending','confirmed']))
      <form method="POST" action="{{ route('orders.cancel',$o) }}" onsubmit="return confirm('Batalkan pesanan ini?')">
        @csrf @method('PATCH')
        <button type="submit" class="btn btn-sm btn-del">Batalkan</button>
      </form>
      @endif
    </div>
  </div>
  @endforeach
</div>
@endif
@endsection
