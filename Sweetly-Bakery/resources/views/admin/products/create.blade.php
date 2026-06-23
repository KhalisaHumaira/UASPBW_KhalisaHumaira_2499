@extends('layouts.app')
@section('title','Tambah Produk')
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

.form-card{
  max-width:680px;
  background:rgba(255,255,255,.8);
  backdrop-filter:blur(12px);
  border:1px solid rgba(231,224,213,.5);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 8px 28px rgba(120,53,15,.08);
  animation:fadeInUp .5s ease both;
}
@keyframes fadeInUp{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}
.form-card-body{padding:28px;}

.checkbox-group{
  display:flex;gap:24px;margin-bottom:20px;
}
.checkbox-label{
  display:flex;align-items:center;gap:10px;
  cursor:pointer;font-size:13px;font-weight:500;
  padding:10px 16px;
  border:1.5px solid #e7e0d5;
  border-radius:12px;
  transition:all .25s ease;
  background:rgba(255,255,255,.5);
}
.checkbox-label:hover{
  border-color:#fb7185;
  background:rgba(255,240,243,.4);
}
.checkbox-label input[type="checkbox"]{accent-color:#e11d48;width:16px;height:16px;}

.action-row{
  display:flex;gap:12px;
  padding-top:8px;
}
.btn-save{
  flex:1;padding:14px;
  background:linear-gradient(135deg,#e11d48,#c2185b);
  color:white;border:none;border-radius:14px;
  font-family:'DM Sans',sans-serif;font-size:14px;font-weight:700;
  cursor:pointer;transition:all .3s ease;
  box-shadow:0 6px 20px rgba(225,29,72,.3);
  position:relative;overflow:hidden;
}
.btn-save::before{
  content:'';position:absolute;top:-50%;left:-50%;
  width:200%;height:200%;
  background:linear-gradient(45deg,transparent 30%,rgba(255,255,255,.15) 50%,transparent 70%);
  transform:translateX(-100%);transition:transform .6s ease;
}
.btn-save:hover::before{transform:translateX(100%);}
.btn-save:hover{transform:translateY(-2px);box-shadow:0 10px 30px rgba(225,29,72,.4);}
.btn-cancel{
  padding:14px 24px;
  background:transparent;border:1.5px solid #e7e0d5;
  border-radius:14px;
  font-family:'DM Sans',sans-serif;font-size:14px;font-weight:600;
  color:#78716c;text-decoration:none;
  display:flex;align-items:center;justify-content:center;
  transition:all .25s ease;
}
.btn-cancel:hover{border-color:#e11d48;color:#e11d48;background:rgba(255,240,243,.4);}

.color-picker{
  width:56px;height:42px;
  border:2px solid #e7e0d5;border-radius:10px;
  cursor:pointer;
  transition:border-color .25s ease;
}
.color-picker:hover{border-color:#e11d48;}

.btn-add-category{
  padding:12px 16px;
  background:linear-gradient(135deg,#fb7185 0%,#f472b6 100%);
  border:none;
  border-radius:10px;
  color:white;
  font-size:13px;font-weight:600;
  cursor:pointer;
  transition:all .25s ease;
  white-space:nowrap;
}
.btn-add-category:hover{
  transform:translateY(-2px);
  box-shadow:0 6px 20px rgba(225,29,72,.35);
}

.modal{
  display:none;
  position:fixed;top:0;left:0;right:0;bottom:0;
  background:rgba(0,0,0,.5);
  z-index:1000;
  align-items:center;justify-content:center;
  animation:fadeIn .25s ease;
}
.modal.show{display:flex;}
@keyframes fadeIn{from{opacity:0;}to{opacity:1;}}
@keyframes slideDown{from{opacity:0;transform:translateY(-20px);}to{opacity:1;transform:translateY(0);}}
.modal-content{
  background:white;
  border-radius:20px;
  padding:28px;
  max-width:400px;
  width:90%;
  box-shadow:0 20px 60px rgba(0,0,0,.3);
  animation:slideDown .25s ease;
}
.modal-header{
  display:flex;justify-content:space-between;align-items:center;
  margin-bottom:20px;
}
.modal-title{
  font-size:18px;font-weight:700;
  color:#292524;
}
.modal-close{
  background:none;border:none;
  font-size:24px;cursor:pointer;
  color:#a8a29e;
  transition:color .25s ease;
}
.modal-close:hover{color:#e11d48;}

.modal-form-group{
  margin-bottom:16px;
}
.modal-form-group label{
  display:block;
  font-size:13px;font-weight:600;
  color:#57534e;
  margin-bottom:8px;
}
.modal-form-group input{
  width:100%;
  padding:12px;
  border:2px solid #e7e0d5;
  border-radius:10px;
  font-size:14px;
  transition:border-color .25s ease;
  font-family:'DM Sans',sans-serif;
}
.modal-form-group input:focus{
  outline:none;
  border-color:#e11d48;
  box-shadow:0 0 0 3px rgba(225,29,72,.1);
}
.modal-actions{
  display:flex;gap:12px;
  margin-top:20px;
}
.modal-btn{
  flex:1;
  padding:12px;
  border:none;
  border-radius:10px;
  font-size:14px;font-weight:600;
  cursor:pointer;
  transition:all .25s ease;
  font-family:'DM Sans',sans-serif;
}
.modal-btn-save{
  background:linear-gradient(135deg,#fb7185 0%,#f472b6 100%);
  color:white;
}
.modal-btn-save:hover{
  transform:translateY(-2px);
  box-shadow:0 6px 20px rgba(225,29,72,.35);
}
.modal-btn-cancel{
  background:#e7e0d5;
  color:#57534e;
}
.modal-btn-cancel:hover{
  background:#d6ccc1;
}
.modal-message{
  padding:12px;
  border-radius:10px;
  margin-bottom:16px;
  font-size:13px;
  display:none;
}
.modal-message.error{
  background:#fed7d7;
  color:#c53030;
  display:block;
}
.modal-message.success{
  background:#c6f6d5;
  color:#22543d;
  display:block;
}
</style>
@endpush
@section('content')
<a href="{{ route('admin.products.index') }}" class="back-link">← Kembali</a>
<h2 class="page-title">✨ Tambah Produk</h2>
<div class="form-card"><div class="form-card-body">
  <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
      <div class="form-group"><label>Nama Produk</label>
        <input type="text" name="name" class="form-control {{ $errors->has('name')?'is-invalid':'' }}" value="{{ old('name') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="form-group"><label>Kategori</label>
        <div style="display:flex;gap:8px;align-items:flex-end;">
          <select name="category_id" id="categorySelect" class="form-control" required>
            <option value="">— Pilih —</option>
            @foreach($categories as $c)
              <option value="{{ $c->id }}" {{ old('category_id')==$c->id?'selected':'' }}>{{ $c->icon }} {{ $c->name }}</option>
            @endforeach
          </select>
          <button type="button" class="btn-add-category" onclick="openCategoryModal()">+ Kategori</button>
        </div>
      </div>
    </div>
    <div class="form-group"><label>Deskripsi</label>
      <textarea name="description" class="form-control" rows="3" style="resize:vertical;">{{ old('description') }}</textarea>
    </div>
    <div class="form-row">
      <div class="form-group"><label>Harga (Rp)</label>
        <input type="number" name="price" class="form-control {{ $errors->has('price')?'is-invalid':'' }}" value="{{ old('price') }}" required>
        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="form-group"><label>Stok</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock',10) }}" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group"><label>Gambar Produk</label>
        <input type="file" name="image" class="form-control {{ $errors->has('image')?'is-invalid':'' }}" accept="image/*">
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="form-group"><label>Warna BG</label>
        <input type="color" name="bg_color" value="{{ old('bg_color','#fdf2f8') }}" class="color-picker">
      </div>
    </div>
    <div class="checkbox-group">
      <label class="checkbox-label">
        <input type="checkbox" name="is_available" value="1" checked> ✅ Tersedia
      </label>
      <label class="checkbox-label">
        <input type="checkbox" name="is_custom_order" value="1"> ✨ Custom Order
      </label>
    </div>
    <div class="action-row">
      <button type="submit" class="btn-save">💾 Simpan Produk</button>
      <a href="{{ route('admin.products.index') }}" class="btn-cancel">Batal</a>
    </div>
  </form>
  
  <div id="categoryModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">➕ Kategori Baru</h3>
        <button type="button" class="modal-close" onclick="closeCategoryModal()">×</button>
      </div>
      <div id="categoryMessage" class="modal-message"></div>
      <form id="categoryForm" onsubmit="saveCategoryForm(event)">
        <div class="modal-form-group">
          <label for="categoryIcon">Ikon</label>
          <input type="text" id="categoryIcon" placeholder="Misal: 🎂 atau 💍" maxlength="2" required>
        </div>
        <div class="modal-form-group">
          <label for="categoryName">Nama Kategori</label>
          <input type="text" id="categoryName" placeholder="Misal: Kue Ulang Tahun" required>
        </div>
        <div class="modal-actions">
          <button type="submit" class="modal-btn modal-btn-save">💾 Simpan</button>
          <button type="button" class="modal-btn modal-btn-cancel" onclick="closeCategoryModal()">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div></div>

<script>
function openCategoryModal(){
  document.getElementById('categoryModal').classList.add('show');
  document.getElementById('categoryForm').reset();
  clearCategoryMessage();
}
function closeCategoryModal(){
  document.getElementById('categoryModal').classList.remove('show');
}
function clearCategoryMessage(){
  const msg=document.getElementById('categoryMessage');
  msg.textContent='';
  msg.className='modal-message';
}
function showCategoryMessage(text,type){
  const msg=document.getElementById('categoryMessage');
  msg.textContent=text;
  msg.className='modal-message '+type;
}
function saveCategoryForm(e){
  e.preventDefault();
  const icon=document.getElementById('categoryIcon').value.trim();
  const name=document.getElementById('categoryName').value.trim();
  if(!icon||!name){
    showCategoryMessage('Ikon dan nama harus diisi!','error');
    return;
  }
  const formData=new FormData();
  formData.append('icon',icon);
  formData.append('name',name);
  formData.append('_token','{{ csrf_token() }}');
  fetch('{{ route("admin.categories.store") }}',{
    method:'POST',
    body:formData,
    headers:{'X-Requested-With':'XMLHttpRequest'}
  })
  .then(r=>r.json())
  .then(d=>{
    if(d.success){
      showCategoryMessage('✅ Kategori berhasil ditambah!','success');
      setTimeout(()=>{
        const sel=document.getElementById('categorySelect');
        const opt=document.createElement('option');
        opt.value=d.id;
        opt.textContent=icon+' '+name;
        opt.selected=true;
        sel.appendChild(opt);
        closeCategoryModal();
      },500);
    }else{
      showCategoryMessage('❌ '+(d.message||'Gagal menyimpan kategori'),'error');
    }
  })
  .catch(err=>{
    showCategoryMessage('❌ Terjadi kesalahan','error');
    console.error(err);
  });
}
document.getElementById('categoryModal').addEventListener('click',e=>{
  if(e.target.id==='categoryModal')closeCategoryModal();
});
</script>
@endsection
