@extends('layouts.app')
@section('title','Kelola Pesanan')
@push('styles')
<style>
.orders-table{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 4px 16px rgba(120,53,15,.06);
}
.orders-table table{width:100%;border-collapse:collapse;}
.orders-table th{
  background:linear-gradient(135deg,rgba(253,242,248,.6),rgba(255,247,237,.6));
  padding:14px 18px;text-align:left;
  font-size:11px;text-transform:uppercase;
  letter-spacing:.06em;color:#78716c;font-weight:700;
}
.orders-table td{
  padding:14px 18px;font-size:13px;
  border-bottom:1px solid rgba(231,224,213,.4);
  transition:background .2s ease;
  vertical-align:middle;
}
.orders-table tr:last-child td{border-bottom:none;}
.orders-table tr:hover td{background:rgba(253,242,248,.3);}

.status-select{
  padding:6px 10px;
  border-radius:8px;
  border:1.5px solid #e7e0d5;
  font-size:11px;
  cursor:pointer;
  background:rgba(255,255,255,.7);
  font-family:'DM Sans',sans-serif;
  transition:all .25s ease;
  outline:none;
}
.status-select:hover{border-color:#fb7185;}
.status-select:focus{border-color:#e11d48;box-shadow:0 0 0 3px rgba(225,29,72,.1);}

.empty-orders{
  text-align:center;padding:60px;color:#78716c;
  font-size:14px;
}

.pagination-wrap{
  padding:18px 24px;
  border-top:1px solid rgba(231,224,213,.4);
}
</style>
@endpush
@section('content')
<h2 class="page-title">📋 Manajemen Pesanan</h2>
<div class="orders-table">
  <table>
    <thead><tr><th>Kode</th><th>Pelanggan</th><th>Total</th><th>Tgl Kirim</th><th>Bayar</th><th>Status</th></tr></thead>
    <tbody>
      @forelse($orders as $o)
      <tr>
        <td>
          <a href="{{ route('admin.orders.show',$o) }}" style="color:#e11d48;font-weight:700;font-size:12px;">{{ $o->order_code }}</a>
          <br><span style="font-size:10px;color:#a8a29e;">{{ $o->created_at->format('d M Y') }}</span>
        </td>
        <td><strong>{{ $o->user->name }}</strong></td>
        <td style="font-weight:700;color:#78350f;">Rp {{ number_format($o->total_price,0,',','.') }}</td>
        <td style="font-size:12px;color:#78716c;">{{ $o->delivery_date->format('d M Y') }}</td>
        <td>
          <form method="POST" action="{{ route('admin.orders.status',$o) }}">
            @csrf @method('PATCH')
            <input type="hidden" name="status" value="{{ $o->status }}">
            <select name="payment_status" onchange="this.form.submit()" class="status-select">
              <option value="unpaid" {{ $o->payment_status==='unpaid'?'selected':'' }}>⏳ Belum</option>
              <option value="paid" {{ $o->payment_status==='paid'?'selected':'' }}>✅ Lunas</option>
            </select>
          </form>
        </td>
        <td>
          <form method="POST" action="{{ route('admin.orders.status',$o) }}">
            @csrf @method('PATCH')
            <input type="hidden" name="payment_status" value="{{ $o->payment_status }}">
            <select name="status" onchange="this.form.submit()" class="status-select">
              <option value="pending" {{ $o->status==='pending'?'selected':'' }}>⏳ Pending</option>
              <option value="confirmed" {{ $o->status==='confirmed'?'selected':'' }}>✅ Confirmed</option>
              <option value="process" {{ $o->status==='process'?'selected':'' }}>👩‍🍳 Proses</option>
              <option value="ready" {{ $o->status==='ready'?'selected':'' }}>📦 Siap</option>
              <option value="delivered" {{ $o->status==='delivered'?'selected':'' }}>🎉 Terkirim</option>
              <option value="cancelled" {{ $o->status==='cancelled'?'selected':'' }}>❌ Batal</option>
            </select>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" class="empty-orders">📋 Belum ada pesanan.</td></tr>
      @endforelse
    </tbody>
  </table>
  @if($orders->hasPages())
    <div class="pagination-wrap">{{ $orders->links() }}</div>
  @endif
</div>
@endsection
