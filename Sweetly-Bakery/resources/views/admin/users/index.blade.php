@extends('layouts.app')
@section('title','Users')
@push('styles')
<style>
.users-table{
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 4px 16px rgba(120,53,15,.06);
}
.users-table table{width:100%;border-collapse:collapse;}
.users-table th{
  background:linear-gradient(135deg,rgba(253,242,248,.6),rgba(255,247,237,.6));
  padding:14px 18px;text-align:left;
  font-size:11px;text-transform:uppercase;
  letter-spacing:.06em;color:#78716c;font-weight:700;
}
.users-table td{
  padding:14px 18px;font-size:13px;
  border-bottom:1px solid rgba(231,224,213,.4);
  transition:background .2s ease;
  vertical-align:middle;
}
.users-table tr:last-child td{border-bottom:none;}
.users-table tr:hover td{background:rgba(253,242,248,.3);}

.user-name-cell{
  display:flex;align-items:center;gap:12px;
}
.user-avatar-sm{
  width:36px;height:36px;
  border-radius:50%;
  background:linear-gradient(135deg,rgba(253,242,248,.8),rgba(255,247,237,.6));
  display:flex;align-items:center;justify-content:center;
  font-size:14px;font-weight:700;color:#e11d48;
  border:1px solid rgba(231,224,213,.4);
  flex-shrink:0;
  transition:transform .3s ease;
}
tr:hover .user-avatar-sm{transform:scale(1.1);}
.user-you{
  font-size:11px;color:#a8a29e;
  padding:4px 10px;
  background:rgba(245,239,230,.5);
  border-radius:20px;
  border:1px solid rgba(231,224,213,.4);
}
</style>
@endpush
@section('content')
<h2 class="page-title">👥 Manajemen Users</h2>
<div class="users-table">
  <table>
    <thead><tr><th>Nama</th><th>Email</th><th>HP</th><th>Alamat</th><th>Role</th><th>Bergabung</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($users as $u)
      <tr>
        <td>
          <div class="user-name-cell">
            <div class="user-avatar-sm">{{ strtoupper(substr($u->name,0,1)) }}</div>
            <strong>{{ $u->name }}</strong>
          </div>
        </td>
        <td style="font-size:12px;color:#78716c;">{{ $u->email }}</td>
        <td style="font-size:12px;">{{ $u->phone??'-' }}</td>
        <td style="font-size:12px;max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $u->address??'-' }}</td>
        <td>
          <span class="badge" style="{{ $u->role==='admin'?'background:#fef3c7;color:#92400e;border:1px solid #fde68a':'background:#d1fae5;color:#065f46;border:1px solid #a7f3d0' }}">
            {{ $u->role==='admin'?'🔑 Admin':'👤 Customer' }}
          </span>
        </td>
        <td style="font-size:12px;color:#78716c;">{{ $u->created_at->format('d M Y') }}</td>
        <td>
          @if($u->id !== Auth::id())
            <form method="POST" action="{{ route('admin.users.delete',$u) }}" onsubmit="return confirm('Hapus user ini?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-del">Hapus</button>
            </form>
          @else
            <span class="user-you">— kamu</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
