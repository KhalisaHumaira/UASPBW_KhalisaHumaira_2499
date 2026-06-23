@extends('layouts.app')
@section('title','Kelola Produk')
@push('styles')
<style>
.products-header{
  display:flex;justify-content:space-between;
  align-items:center;margin-bottom:24px;
}
.products-header .page-title{margin-bottom:0;}
.btn-add-product{
  padding:10px 22px;
  background:linear-gradient(135deg,#e11d48,#c2185b);
  color:white;border:none;border-radius:12px;
  font-family:'DM Sans',sans-serif;
  font-size:13px;font-weight:600;
  text-decoration:none;
  display:inline-flex;align-items:center;gap:8px;
  transition:all .3s ease;
  box-shadow:0 4px 14px rgba(225,29,72,.25);
  position:relative;overflow:hidden;
}
.btn-add-product::before{
  content:'';position:absolute;top:-50%;left:-50%;
  width:200%;height:200%;
  background:linear-gradient(45deg,transparent 30%,rgba(255,255,255,.15) 50%,transparent 70%);
  transform:translateX(-100%);transition:transform .6s ease;
}
.btn-add-product:hover::before{transform:translateX(100%);}
.btn-add-product:hover{
  transform:translateY(-2px);
  box-shadow:0 8px 24px rgba(225,29,72,.35);
  color:white;
}

.products-table{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 4px 16px rgba(120,53,15,.06);
}
.products-table table{width:100%;border-collapse:collapse;}
.products-table th{
  background:linear-gradient(135deg,rgba(253,242,248,.6),rgba(255,247,237,.6));
  padding:14px 18px;text-align:left;
  font-size:11px;text-transform:uppercase;
  letter-spacing:.06em;color:#78716c;font-weight:700;
}
.products-table td{
  padding:14px 18px;font-size:13px;
  border-bottom:1px solid rgba(231,224,213,.4);
  transition:background .2s ease;
}
.products-table tr:last-child td{border-bottom:none;}
.products-table tr:hover td{background:rgba(253,242,248,.3);}
.products-table .emoji-col{font-size:28px;width:50px;}
.products-table .name-col strong{display:block;margin-bottom:2px;}
.products-table .name-col span{font-size:11px;color:#78716c;}
.products-table .actions{display:flex;gap:8px;padding:14px 18px;}
</style>
@endpush
@section('content')
<div class="products-header">
  <h2 class="page-title">🎂 Kelola Produk</h2>
  <a href="{{ route('admin.products.create') }}" class="btn-add-product">+ Tambah Produk</a>
</div>
<div class="products-table">
  <table>
    <thead><tr><th></th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($products as $p)
      <tr>
        <td class="emoji-col">
          @if($p->image)
            <img src="{{ asset('storage/'.$p->image) }}" style="width:44px;height:44px;object-fit:cover;border-radius:12px;border:1px solid rgba(231,224,213,.4);">
          @else
            {{ $p->emoji }}
          @endif
        </td>
        <td class="name-col"><strong>{{ $p->name }}</strong><span>{{ Str::limit($p->description,40) }}</span></td>
        <td>{{ $p->category->icon }} {{ $p->category->name }}</td>
        <td style="font-weight:600;color:#78350f;">Rp {{ number_format($p->price,0,',','.') }}</td>
        <td>{{ $p->stock }}</td>
        <td><span class="badge" style="{{ $p->is_available?'background:#d1fae5;color:#065f46;border:1px solid #a7f3d0':'background:#fee2e2;color:#991b1b;border:1px solid #fecaca' }}">{{ $p->is_available?'✅ Tersedia':'❌ Habis' }}</span></td>
        <td class="actions">
          <a href="{{ route('admin.products.edit',$p) }}" class="btn btn-sm btn-edit">Edit</a>
          <form method="POST" action="{{ route('admin.products.destroy',$p) }}" onsubmit="return confirm('Hapus?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-del">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
