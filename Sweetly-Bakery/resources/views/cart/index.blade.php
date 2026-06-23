@extends('layouts.app')
@section('title','Keranjang')
@push('styles')
<style>
.cart-empty{
  text-align:center;padding:100px 40px;color:#78716c;
}
.cart-empty-icon{
  width:100px;height:100px;
  background:linear-gradient(135deg,rgba(253,242,248,.8),rgba(255,247,237,.8));
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:48px;margin:0 auto 20px;
  box-shadow:0 8px 30px rgba(120,53,15,.08);
  animation:emptyFloat 3s ease-in-out infinite;
}
@keyframes emptyFloat{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}
.cart-empty p{font-size:15px;font-weight:500;margin-bottom:8px;}
.cart-empty .sub{font-size:13px;margin-bottom:20px;color:#a8a29e;}

.cart-layout{
  display:grid;
  grid-template-columns:1fr 340px;
  gap:24px;
  align-items:start;
  animation:fadeInUp .5s ease both;
}
@keyframes fadeInUp{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}

.cart-item{
  display:flex;align-items:center;gap:18px;
  padding:18px 24px;
  border-bottom:1px solid rgba(240,230,211,.5);
  transition:background .2s ease;
}
.cart-item:last-child{border-bottom:none;}
.cart-item:hover{background:rgba(253,242,248,.3);}

.cart-item-emoji{
  font-size:36px;width:64px;height:64px;
  background:linear-gradient(135deg,rgba(253,242,248,.8),rgba(255,247,237,.6));
  border-radius:14px;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
  border:1px solid rgba(231,224,213,.4);
  transition:transform .3s ease;
}
.cart-item:hover .cart-item-emoji{transform:scale(1.05) rotate(-3deg);}

.cart-item-info{flex:1;min-width:0;}
.cart-item-name{font-weight:600;font-size:14px;margin-bottom:3px;color:#1c1917;}
.cart-item-price{font-size:12px;color:#78716c;}
.cart-item-note{
  font-size:11px;color:#e11d48;margin-top:3px;
  display:flex;align-items:center;gap:4px;
}

.qty-form{
  display:flex;align-items:center;gap:8px;
}
.qty-field{
  width:56px;padding:7px;
  border:1.5px solid #e7e0d5;border-radius:10px;
  font-family:'DM Sans',sans-serif;font-size:13px;
  text-align:center;outline:none;
  transition:all .2s ease;
  background:rgba(255,255,255,.7);
}
.qty-field:focus{border-color:#e11d48;box-shadow:0 0 0 3px rgba(225,29,72,.1);}

.cart-item-total{
  font-weight:700;color:#78350f;
  min-width:110px;text-align:right;
  font-size:14px;
}

.summary-card{
  position:sticky;top:84px;
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 8px 28px rgba(120,53,15,.08);
}
.summary-header{
  padding:20px 24px;
  border-bottom:1px solid rgba(231,224,213,.5);
  font-family:'Playfair Display',serif;
  font-size:18px;font-weight:600;
  color:#78350f;
}
.summary-body{padding:24px;}
.summary-row{
  display:flex;justify-content:space-between;
  font-size:13px;padding:10px 0;
  border-bottom:1px solid rgba(240,230,211,.4);
}
.summary-row span:first-child{color:#78716c;}
.summary-row span:last-child{font-weight:600;}
.summary-total{
  display:flex;justify-content:space-between;
  font-size:18px;font-weight:700;
  color:#78350f;
  padding-top:14px;margin-top:4px;
  margin-bottom:20px;
}
.btn-checkout{
  width:100%;padding:15px;
  background:linear-gradient(135deg,#e11d48,#c2185b);
  color:white;border:none;border-radius:14px;
  font-family:'DM Sans',sans-serif;
  font-size:15px;font-weight:700;
  cursor:pointer;
  transition:all .3s ease;
  box-shadow:0 6px 20px rgba(225,29,72,.3);
  display:flex;align-items:center;justify-content:center;gap:8px;
  text-decoration:none;
  position:relative;overflow:hidden;
}
.btn-checkout::before{
  content:'';position:absolute;top:-50%;left:-50%;
  width:200%;height:200%;
  background:linear-gradient(45deg,transparent 30%,rgba(255,255,255,.15) 50%,transparent 70%);
  transform:translateX(-100%);transition:transform .6s ease;
}
.btn-checkout:hover::before{transform:translateX(100%);}
.btn-checkout:hover{
  transform:translateY(-2px);
  box-shadow:0 10px 30px rgba(225,29,72,.4);
  color:white;
}
.btn-continue{
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
.btn-continue:hover{
  border-color:#e11d48;color:#e11d48;
  background:rgba(255,240,243,.4);
  transform:translateY(-1px);
}

@media(max-width:768px){
  .cart-layout{grid-template-columns:1fr;}
  .cart-item{flex-wrap:wrap;gap:12px;}
  .cart-item-total{text-align:left;min-width:auto;}
}
</style>
@endpush
@section('content')
<h2 class="page-title">🛒 Keranjang Belanja</h2>

@if(empty($cart))
  <div class="cart-empty">
    <div class="cart-empty-icon">🛒</div>
    <p>Keranjang masih kosong</p>
    <p class="sub">Yuk mulai belanja kue favoritmu!</p>
    <a href="{{ route('products.index') }}" class="btn btn-rose" style="padding:12px 28px;font-size:14px;">🎂 Lihat Menu</a>
  </div>
@else
<div class="cart-layout">
  <div class="card">
    <div class="card-header">
      <h3>Item ({{ count($cart) }})</h3>
      <form method="POST" action="{{ route('cart.clear') }}">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-del" onclick="return confirm('Kosongkan keranjang?')">🗑️ Kosongkan</button>
      </form>
    </div>
    @foreach($cart as $key => $item)
    <div class="cart-item">
      <div class="cart-item-emoji">
        @if(!empty($item['image']))
          <img src="{{ asset('storage/'.$item['image']) }}" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">
        @else
          {{ $item['emoji'] }}
        @endif
      </div>
      <div class="cart-item-info">
        <div class="cart-item-name">{{ $item['name'] }}</div>
        <div class="cart-item-price">Rp {{ number_format($item['price'],0,',','.') }} /pcs</div>
        @if($item['custom_note'])<div class="cart-item-note">📝 {{ $item['custom_note'] }}</div>@endif
      </div>
      <form method="POST" action="{{ route('cart.update',$key) }}" class="qty-form">
        @csrf @method('PATCH')
        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="50" class="qty-field" data-key="{{ $key }}">
        <button type="submit" class="btn btn-sm btn-outline" style="font-size:11px; display: none;">Update</button>
      </form>
      <div class="cart-item-total" data-key="{{ $key }}">Rp {{ number_format($item['price']*$item['qty'],0,',','.') }}</div>
      <form method="POST" action="{{ route('cart.remove',$key) }}">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-del" style="padding:6px 10px;">✕</button>
      </form>
    </div>
    @endforeach
  </div>

  <div class="summary-card">
    <div class="summary-header">📋 Ringkasan</div>
    <div class="summary-body">
      <div class="summary-row">
        <span>Subtotal</span>
        <span class="cart-subtotal-val">Rp {{ number_format($total,0,',','.') }}</span>
      </div>
      <div class="summary-total">
        <span>Total</span>
        <span class="cart-total-val">Rp {{ number_format($total,0,',','.') }}</span>
      </div>
      <a href="{{ route('orders.checkout') }}" class="btn-checkout">Lanjut ke Checkout →</a>
      <a href="{{ route('products.index') }}" class="btn-continue">← Tambah Produk</a>
    </div>
  </div>
</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const qtyFields = document.querySelectorAll('.qty-field');
    qtyFields.forEach(field => {
        field.addEventListener('change', function() {
            updateCartQuantity(this);
        });
        field.addEventListener('keyup', debounce(function() {
            updateCartQuantity(this);
        }, 500));
    });

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    function updateCartQuantity(input) {
        const qty = parseInt(input.value);
        if (isNaN(qty) || qty < 1 || qty > 50) return;

        const key = input.dataset.key;
        const form = input.closest('form');
        const action = form.action;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Show a subtle loading indicator or opacity
        const itemRow = input.closest('.cart-item');
        if (itemRow) itemRow.style.opacity = '0.6';

        fetch(action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                _method: 'PATCH',
                qty: qty
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Gagal memperbarui keranjang.');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update item total
                const itemTotalEl = document.querySelector(`.cart-item-total[data-key="${key}"]`);
                if (itemTotalEl) itemTotalEl.textContent = data.item_total;

                // Update cart subtotal & total
                const subtotalEl = document.querySelector('.cart-subtotal-val');
                const totalEl = document.querySelector('.cart-total-val');
                if (subtotalEl) subtotalEl.textContent = data.total;
                if (totalEl) totalEl.textContent = data.total;
            }
        })
        .catch(error => {
            console.error('Error updating cart:', error);
            alert(error.message);
            window.location.reload();
        })
        .finally(() => {
            if (itemRow) itemRow.style.opacity = '1';
        });
    }
});
</script>
@endpush
