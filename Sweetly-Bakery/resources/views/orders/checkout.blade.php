@extends('layouts.app')
@section('title','Checkout')
@push('styles')
<style>
.checkout-layout{
  display:grid;
  grid-template-columns:1fr 360px;
  gap:24px;
  align-items:start;
  animation:fadeInUp .5s ease both;
}
@keyframes fadeInUp{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}

.checkout-card{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 8px 28px rgba(120,53,15,.08);
}
.checkout-card-header{
  padding:20px 24px;
  border-bottom:1px solid rgba(231,224,213,.5);
  font-family:'Playfair Display',serif;
  font-size:18px;font-weight:600;
  color:#78350f;
}
.checkout-card-body{padding:24px;}

/* Payment Radio Cards */
.payment-options{display:flex;gap:12px;flex-wrap:wrap;}
.payment-option{
  flex:1;min-width:150px;
  display:flex;align-items:center;gap:10px;
  padding:14px 16px;
  border:1.5px solid #e7e0d5;
  border-radius:14px;
  cursor:pointer;font-size:13px;font-weight:500;
  transition:all .25s ease;
  background:rgba(255,255,255,.6);
  position:relative;
}
.payment-option:hover{
  border-color:#fb7185;
  background:rgba(255,240,243,.4);
}
.payment-option.selected{
  border-color:#e11d48;
  background:linear-gradient(135deg,rgba(255,240,243,.6),rgba(255,228,230,.4));
  box-shadow:0 4px 12px rgba(225,29,72,.1);
}
.payment-option input[type="radio"]{accent-color:#e11d48;width:16px;height:16px;}

/* Order Summary Sidebar */
.order-summary{
  position:sticky;top:84px;
}
.summary-card{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 8px 28px rgba(120,53,15,.08);
  margin-bottom:16px;
}
.summary-header{
  padding:20px 24px;
  border-bottom:1px solid rgba(231,224,213,.5);
  font-family:'Playfair Display',serif;
  font-size:18px;font-weight:600;
  color:#78350f;
}
.summary-body{padding:20px 24px;}
.summary-item{
  display:flex;gap:12px;
  padding:12px 0;
  border-bottom:1px solid rgba(240,230,211,.4);
  align-items:center;
  transition:background .2s ease;
}
.summary-item:last-of-type{border-bottom:none;}
.summary-item:hover{background:rgba(253,242,248,.2);margin:0 -8px;padding:12px 8px;border-radius:8px;}
.summary-item-emoji{font-size:26px;}
.summary-item-info{flex:1;}
.summary-item-name{font-size:13px;font-weight:600;color:#1c1917;}
.summary-item-qty{font-size:11px;color:#78716c;}
.summary-item-price{font-weight:600;font-size:13px;color:#78350f;}
.summary-total{
  display:flex;justify-content:space-between;
  font-weight:700;font-size:18px;
  color:#78350f;
  padding-top:14px;margin-top:6px;
}

.btn-order{
  width:100%;padding:16px;
  background:linear-gradient(135deg,#e11d48,#c2185b);
  color:white;border:none;border-radius:14px;
  font-family:'DM Sans',sans-serif;
  font-size:16px;font-weight:700;
  cursor:pointer;
  transition:all .3s ease;
  box-shadow:0 6px 20px rgba(225,29,72,.3);
  display:flex;align-items:center;justify-content:center;gap:8px;
  position:relative;overflow:hidden;
}
.btn-order::before{
  content:'';position:absolute;top:-50%;left:-50%;
  width:200%;height:200%;
  background:linear-gradient(45deg,transparent 30%,rgba(255,255,255,.15) 50%,transparent 70%);
  transform:translateX(-100%);transition:transform .6s ease;
}
.btn-order:hover::before{transform:translateX(100%);}
.btn-order:hover{
  transform:translateY(-2px);
  box-shadow:0 10px 30px rgba(225,29,72,.4);
}
.btn-back{
  width:100%;padding:12px;
  background:transparent;
  border:1.5px solid #e7e0d5;
  border-radius:12px;
  font-family:'DM Sans',sans-serif;
  font-size:13px;font-weight:600;
  color:#78716c;
  margin-top:12px;
  display:flex;align-items:center;justify-content:center;gap:6px;
  text-decoration:none;
  transition:all .25s ease;
}
.btn-back:hover{
  border-color:#e11d48;color:#e11d48;
  background:rgba(255,240,243,.4);
  transform:translateY(-1px);
}

@media(max-width:768px){
  .checkout-layout{grid-template-columns:1fr;}
  .payment-options{flex-direction:column;}
}
</style>
@endpush
@section('content')
<h2 class="page-title">📦 Checkout</h2>
<div class="checkout-layout">
  <div class="checkout-card">
    <div class="checkout-card-header">🚚 Detail Pengiriman</div>
    <div class="checkout-card-body">
      <form method="POST" action="{{ route('orders.store') }}" id="checkout-form">
        @csrf
        <div class="form-group">
          <label>Alamat Pengiriman</label>
          <textarea name="delivery_address" class="form-control {{ $errors->has('delivery_address')?'is-invalid':'' }}" rows="3" placeholder="Alamat lengkap pengiriman..." required style="resize:vertical;">{{ old('delivery_address', Auth::user()->address) }}</textarea>
          @error('delivery_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Tanggal Pengiriman</label>
            <input type="date" name="delivery_date" class="form-control {{ $errors->has('delivery_date')?'is-invalid':'' }}" value="{{ old('delivery_date', now()->addDays(2)->format('Y-m-d')) }}" min="{{ now()->addDay()->format('Y-m-d') }}" required>
            @error('delivery_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label>Jam Pengiriman</label>
            <select name="delivery_time" class="form-control" required>
              <option value="09:00">09:00 - 11:00</option>
              <option value="11:00">11:00 - 13:00</option>
              <option value="13:00">13:00 - 15:00</option>
              <option value="15:00">15:00 - 17:00</option>
              <option value="17:00">17:00 - 19:00</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Metode Pembayaran</label>
          <div class="payment-options">
            @foreach(['transfer'=>'🏦 Transfer Bank','cod'=>'💵 COD (Bayar di Tempat)','ewallet'=>'📱 E-Wallet'] as $val=>$label)
            <label class="payment-option {{ old('payment_method','transfer')===$val?'selected':'' }}" id="lbl-{{ $val }}">
              <input type="radio" name="payment_method" value="{{ $val }}" {{ old('payment_method','transfer')===$val?'checked':'' }} onchange="highlightPayment()">
              {{ $label }}
            </label>
            @endforeach
          </div>
          @error('payment_method')<div class="invalid-feedback" style="display:block;">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label>Catatan (opsional)</label>
          <textarea name="note" class="form-control" rows="2" placeholder="Pesan khusus untuk toko..." style="resize:vertical;">{{ old('note') }}</textarea>
        </div>
      </form>
    </div>
  </div>

  <div class="order-summary">
    <div class="summary-card">
      <div class="summary-header">📋 Ringkasan Pesanan</div>
      <div class="summary-body">
        @foreach($cart as $item)
        <div class="summary-item">
          <span class="summary-item-emoji">{{ $item['emoji'] }}</span>
          <div class="summary-item-info">
            <div class="summary-item-name">{{ $item['name'] }}</div>
            <div class="summary-item-qty">{{ $item['qty'] }}x Rp {{ number_format($item['price'],0,',','.') }}</div>
          </div>
          <div class="summary-item-price">Rp {{ number_format($item['price']*$item['qty'],0,',','.') }}</div>
        </div>
        @endforeach
        <div class="summary-total">
          <span>Total</span><span>Rp {{ number_format($total,0,',','.') }}</span>
        </div>
      </div>
    </div>
    <button type="submit" form="checkout-form" class="btn-order">🎂 Pesan Sekarang</button>
    <a href="{{ route('cart.index') }}" class="btn-back">← Kembali ke Keranjang</a>
  </div>
</div>
@endsection
@push('scripts')
<script>
function highlightPayment(){
  ['transfer','cod','ewallet'].forEach(v => {
    const checked = document.querySelector(`input[value="${v}"]`).checked;
    const lbl = document.getElementById('lbl-'+v);
    lbl.classList.toggle('selected', checked);
  });
}
highlightPayment();
</script>
@endpush
