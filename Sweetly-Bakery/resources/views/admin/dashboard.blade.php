@extends('layouts.app')
@section('title','Admin Dashboard')
@push('styles')
<style>
.dash-alert{
  background:linear-gradient(135deg,rgba(255,247,237,.85),rgba(254,243,199,.5));
  backdrop-filter:blur(8px);
  border:1px solid #fed7aa;
  border-radius:16px;
  padding:16px 22px;
  margin-bottom:24px;
  display:flex;align-items:center;gap:12px;
  animation:slideDown .4s cubic-bezier(0.34,1.56,0.64,1) both;
  box-shadow:0 4px 16px rgba(217,119,6,.1);
}
@keyframes slideDown{from{opacity:0;transform:translateY(-10px);}to{opacity:1;transform:translateY(0);}}
.dash-alert-icon{font-size:22px;}
.dash-alert-text{font-size:13px;color:#92400e;}
.dash-alert-text a{color:#e11d48;font-weight:600;transition:color .2s ease;}
.dash-alert-text a:hover{color:#be123c;}

.stat-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:18px;
  margin-bottom:28px;
}
.stat-card{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  padding:24px;
  position:relative;
  overflow:hidden;
  box-shadow:0 4px 16px rgba(120,53,15,.06);
  transition:all .35s ease;
  opacity:0;
  animation:statPop .5s ease forwards;
}
.stat-card:nth-child(1){animation-delay:.05s;}
.stat-card:nth-child(2){animation-delay:.1s;}
.stat-card:nth-child(3){animation-delay:.15s;}
.stat-card:nth-child(4){animation-delay:.2s;}
@keyframes statPop{from{opacity:0;transform:translateY(16px) scale(.96);}to{opacity:1;transform:translateY(0) scale(1);}}
.stat-card:hover{
  transform:translateY(-5px);
  box-shadow:0 16px 40px rgba(120,53,15,.12);
  border-color:rgba(251,207,232,.5);
}
.stat-card::before{
  content:'';position:absolute;top:-30%;right:-30%;
  width:100%;height:100%;
  border-radius:50%;
  opacity:.04;
  transition:transform .5s ease;
}
.stat-card:nth-child(1)::before{background:radial-gradient(circle,#e11d48 0%,transparent 70%);}
.stat-card:nth-child(2)::before{background:radial-gradient(circle,#f59e0b 0%,transparent 70%);}
.stat-card:nth-child(3)::before{background:radial-gradient(circle,#22c55e 0%,transparent 70%);}
.stat-card:nth-child(4)::before{background:radial-gradient(circle,#6366f1 0%,transparent 70%);}
.stat-card:hover::before{transform:scale(1.5);}

.stat-icon{
  width:48px;height:48px;
  border-radius:14px;
  display:flex;align-items:center;justify-content:center;
  font-size:24px;margin-bottom:14px;
  transition:transform .3s cubic-bezier(0.34,1.56,0.64,1);
}
.stat-card:hover .stat-icon{transform:scale(1.1) rotate(-5deg);}
.stat-card:nth-child(1) .stat-icon{background:linear-gradient(135deg,rgba(255,240,243,.8),rgba(255,228,230,.6));}
.stat-card:nth-child(2) .stat-icon{background:linear-gradient(135deg,rgba(254,243,199,.8),rgba(254,215,170,.6));}
.stat-card:nth-child(3) .stat-icon{background:linear-gradient(135deg,rgba(209,250,229,.8),rgba(167,243,208,.6));}
.stat-card:nth-child(4) .stat-icon{background:linear-gradient(135deg,rgba(237,233,254,.8),rgba(196,181,253,.6));}

.stat-label{
  font-size:11px;font-weight:700;
  color:#78716c;text-transform:uppercase;
  letter-spacing:.08em;margin-bottom:6px;
}
.stat-value{
  font-family:'Playfair Display',serif;
  font-size:26px;font-weight:700;color:#78350f;
  margin-bottom:4px;
}
.stat-sub{font-size:11px;color:#a8a29e;}

.recent-card{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 4px 16px rgba(120,53,15,.06);
}
.recent-header{
  padding:20px 24px;
  border-bottom:1px solid rgba(231,224,213,.5);
  display:flex;align-items:center;justify-content:space-between;
}
.recent-header h3{
  font-family:'Playfair Display',serif;
  font-size:18px;font-weight:600;color:#78350f;
}
.recent-header a{
  font-size:12px;color:#e11d48;font-weight:600;
  padding:6px 14px;border-radius:20px;
  background:rgba(255,240,243,.5);
  border:1px solid rgba(251,207,232,.4);
  transition:all .25s ease;
}
.recent-header a:hover{background:rgba(255,228,230,.6);transform:translateY(-1px);}

@media(max-width:1024px){.stat-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:640px){.stat-grid{grid-template-columns:1fr;}}
</style>
@endpush
@section('content')
<h2 class="page-title">📊 Dashboard Admin</h2>

@if($pendingOrders > 0)
<div class="dash-alert">
  <span class="dash-alert-icon">⚡</span>
  <span class="dash-alert-text">Ada <strong>{{ $pendingOrders }}</strong> pesanan menunggu konfirmasi. <a href="{{ route('admin.orders.index') }}">Lihat sekarang →</a></span>
</div>
@endif

<div class="stat-grid">
  @foreach([
    ['🎂','Total Produk',$totalProducts,'produk tersedia'],
    ['📋','Total Pesanan',$totalOrders,'semua waktu'],
    ['💰','Pendapatan','Rp '.number_format($totalRevenue,0,',','.'),'dari pesanan aktif'],
    ['👥','Pelanggan',$totalCustomers,'terdaftar']
  ] as $s)
  <div class="stat-card">
    <div class="stat-icon">{{ $s[0] }}</div>
    <div class="stat-label">{{ $s[1] }}</div>
    <div class="stat-value">{{ $s[2] }}</div>
    <div class="stat-sub">{{ $s[3] }}</div>
  </div>
  @endforeach
</div>

<div class="recent-card">
  <div class="recent-header">
    <h3>📦 Pesanan Terbaru</h3>
    <a href="{{ route('admin.orders.index') }}">Lihat semua →</a>
  </div>
  <table>
    <thead><tr><th>Kode</th><th>Pelanggan</th><th>Item</th><th>Total</th><th>Tgl Kirim</th><th>Status</th></tr></thead>
    <tbody>
      @foreach($recentOrders as $o)
      <tr>
        <td><a href="{{ route('admin.orders.show',$o) }}" style="color:#e11d48;font-weight:600;font-size:12px;">{{ $o->order_code }}</a></td>
        <td><strong>{{ $o->user->name }}</strong></td>
        <td style="font-size:12px;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $o->items->map(fn($i)=>$i->product->name.' x'.$i->qty)->implode(', ') }}</td>
        <td style="font-weight:700;color:#78350f;">Rp {{ number_format($o->total_price,0,',','.') }}</td>
        <td style="font-size:12px;color:#78716c;">{{ $o->delivery_date->format('d M Y') }}</td>
        <td><span class="badge badge-{{ $o->status }}">{{ $o->status_label }}</span></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
