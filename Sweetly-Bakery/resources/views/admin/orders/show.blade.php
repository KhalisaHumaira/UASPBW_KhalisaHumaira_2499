@extends('layouts.app')
@section('title','Detail Pesanan')
@push('styles')
<style>
.back-link{
  display:inline-flex;align-items:center;gap:8px;
  color:#78716c;font-size:13px;font-weight:500;
  margin-bottom:24px;padding:8px 16px;
  border-radius:10px;transition:all .25s ease;
  border:1px solid transparent;
}
.back-link:hover{
  color:#e11d48;background:rgba(255,240,243,.5);
  border-color:rgba(251,207,232,.5);
  transform:translateX(-4px);
}

.order-detail-layout{
  display:grid;
  grid-template-columns:1fr 320px;
  gap:24px;
  max-width:960px;
  animation:fadeInUp .5s ease both;
}
@keyframes fadeInUp{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}

.detail-card{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 4px 16px rgba(120,53,15,.06);
  margin-bottom:20px;
  transition:all .3s ease;
}
.detail-card:hover{box-shadow:0 8px 28px rgba(120,53,15,.1);}
.detail-header{
  padding:20px 24px;
  border-bottom:1px solid rgba(231,224,213,.5);
  display:flex;align-items:center;justify-content:space-between;
}
.detail-header h3{
  font-family:'Playfair Display',serif;
  font-size:18px;font-weight:600;color:#78350f;
}
.detail-body{padding:24px;}

.order-item{
  display:flex;align-items:center;gap:16px;
  padding:14px 0;
  border-bottom:1px solid rgba(240,230,211,.4);
  transition:background .2s ease;
}
.order-item:last-child{border-bottom:none;}
.order-item:hover{background:rgba(253,242,248,.2);margin:0 -8px;padding:14px 8px;border-radius:10px;}
.order-item-emoji{
  font-size:34px;
  width:56px;height:56px;
  background:linear-gradient(135deg,rgba(253,242,248,.6),rgba(255,247,237,.4));
  border-radius:14px;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
  border:1px solid rgba(231,224,213,.3);
}
.order-item-info{flex:1;}
.order-item-name{font-weight:600;font-size:14px;color:#1c1917;margin-bottom:2px;}
.order-item-qty{font-size:12px;color:#78716c;}
.order-item-note{font-size:11px;color:#e11d48;margin-top:3px;}
.order-item-price{font-weight:700;color:#78350f;}

.order-total-row{
  display:flex;justify-content:space-between;
  font-weight:700;font-size:18px;color:#78350f;
  padding-top:16px;
}

.info-row{
  display:flex;justify-content:space-between;
  padding:12px 0;
  border-bottom:1px solid rgba(240,230,211,.4);
  font-size:13px;
  transition:background .2s ease;
}
.info-row:last-child{border-bottom:none;}
.info-row:hover{background:rgba(253,242,248,.2);margin:0 -8px;padding:12px 8px;border-radius:8px;}
.info-label{color:#78716c;min-width:100px;}
.info-value{font-weight:600;text-align:right;max-width:300px;}

.status-card{
  position:sticky;top:84px;
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 4px 16px rgba(120,53,15,.06);
  transition:all .3s ease;
}
.status-card:hover{box-shadow:0 8px 28px rgba(120,53,15,.1);}
.status-card-header{
  padding:20px 24px;
  border-bottom:1px solid rgba(231,224,213,.5);
  font-family:'Playfair Display',serif;
  font-size:18px;font-weight:600;color:#78350f;
}
.status-card-body{padding:24px;}
.btn-update{
  width:100%;padding:14px;
  background:linear-gradient(135deg,#e11d48,#c2185b);
  color:white;border:none;border-radius:14px;
  font-family:'DM Sans',sans-serif;font-size:14px;font-weight:700;
  cursor:pointer;transition:all .3s ease;
  box-shadow:0 6px 20px rgba(225,29,72,.3);
  position:relative;overflow:hidden;
}
.btn-update::before{
  content:'';position:absolute;top:-50%;left:-50%;
  width:200%;height:200%;
  background:linear-gradient(45deg,transparent 30%,rgba(255,255,255,.15) 50%,transparent 70%);
  transform:translateX(-100%);transition:transform .6s ease;
}
.btn-update:hover::before{transform:translateX(100%);}
.btn-update:hover{transform:translateY(-2px);box-shadow:0 10px 30px rgba(225,29,72,.4);}

@media(max-width:768px){
  .order-detail-layout{grid-template-columns:1fr;}
}
</style>
@endpush
@section('content')
<a href="{{ route('admin.orders.index') }}" class="back-link">← Semua Pesanan</a>
<div class="order-detail-layout">
  <div>
    <div class="detail-card">
      <div class="detail-header">
        <h3>{{ $order->order_code }}</h3>
        <span class="badge badge-{{ $order->status }}">{{ $order->status_label }}</span>
      </div>
      <div class="detail-body">
        @foreach($order->items as $item)
        <div class="order-item">
          <div class="order-item-emoji">{{ $item->product->emoji }}</div>
          <div class="order-item-info">
            <div class="order-item-name">{{ $item->product->name }}</div>
            <div class="order-item-qty">{{ $item->qty }}x @ Rp {{ number_format($item->price,0,',','.') }}</div>
            @if($item->custom_note)<div class="order-item-note">📝 {{ $item->custom_note }}</div>@endif
          </div>
          <div class="order-item-price">Rp {{ number_format($item->subtotal,0,',','.') }}</div>
        </div>
        @endforeach
        <div class="order-total-row">
          <span>Total</span><span>Rp {{ number_format($order->total_price,0,',','.') }}</span>
        </div>
      </div>
    </div>

    <div class="detail-card">
      <div class="detail-header"><h3>🚚 Info Pengiriman</h3></div>
      <div class="detail-body">
        @foreach(['Pelanggan'=>$order->user->name,'HP'=>$order->user->phone,'Alamat'=>$order->delivery_address,'Tanggal'=>$order->delivery_date->format('d M Y').' pukul '.$order->delivery_time,'Pembayaran'=>strtoupper($order->payment_method),'Catatan'=>$order->note??'-'] as $l=>$v)
        <div class="info-row">
          <span class="info-label">{{ $l }}</span>
          <span class="info-value">{{ $v }}</span>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="status-card">
    <div class="status-card-header">⚡ Update Status</div>
    <div class="status-card-body">
      <form method="POST" action="{{ route('admin.orders.status',$order) }}">
        @csrf @method('PATCH')
        <div class="form-group"><label>Status Pesanan</label>
          <select name="status" class="form-control">
            @foreach(['pending'=>'⏳ Pending','confirmed'=>'✅ Confirmed','process'=>'👩‍🍳 Diproses','ready'=>'📦 Siap Kirim','delivered'=>'🎉 Terkirim','cancelled'=>'❌ Dibatal'] as $v=>$l)
              <option value="{{ $v }}" {{ $order->status===$v?'selected':'' }}>{{ $l }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><label>Status Pembayaran</label>
          <select name="payment_status" class="form-control">
            <option value="unpaid" {{ $order->payment_status==='unpaid'?'selected':'' }}>⏳ Belum Bayar</option>
            <option value="paid" {{ $order->payment_status==='paid'?'selected':'' }}>✅ Lunas</option>
          </select>
        </div>
        <button type="submit" class="btn-update">🔄 Update Status</button>
      </form>
    </div>
  </div>
</div>
@endsection
