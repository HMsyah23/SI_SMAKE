@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Detail Pengguna  {{$user->nama}}</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <a href="/admin/user"> Pengguna</a> / <i class="ti-user"></i> {{$user->nama}}</h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
           <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
             <a class="btn btn-sm btn-primary" href="/admin/user">
              <i class="ti-arrow-left"></i> Kembali
             </a>
           </div>
          </div>
         </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 grid-margin">
      <div class="row">
        <div class="col-md-12 mb-5">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th class="pl-0  pb-2 border-bottom"></th>
                      <th class="border-bottom pb-2"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr colspan="2">
                      <img style="width:100px; height:100px;" src="{{ ($user->picture != null) ? '/'.$user->picture : asset('assets/admin/images/faces/face28.jpg') }}" class="mx-auto d-block rounded img-fluid photo">
                    </tr>
                    <tr>
                      <td class="pl-2">Nama</td>
                      <td><p class="mb-0"><span class="font-weight-bold nama">{{$user->nama}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Disposisi</td>
                      <td><p class="mb-0"><span class="font-weight-bold divisi">{{$user->divisi->divisi}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Email</td>
                      <td><p class="mb-0"><span class="font-weight-bold email">{{$user->email}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Peran</td>
                      <td><p class="mb-0"><span class="font-weight-bold peran">{{$user->role->role}}</span></p></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 stretch-card grid-margin">
      <div class="row">
        @if (Auth::user()->role->name == "Admin")
        <div class="col-12 mb-5">
          <div class="card">
            <div class="card-body">
              <p class="card-title"><i class="ti-pencil"></i> Edit Data</p>
              <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
                @csrf
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Nama</label>
                    <input required type="text" id="nama" class="form-control form-control-sm" placeholder="Masukkan Nama" value="{{$user->nama}}"/>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Email</label>
                    <input required type="email" id="email" class="form-control form-control-sm" placeholder="Masukkan Email" value="{{$user->email}}"/>
                  </div>
                  <div class="col-md-12 mb-3">
                      <label>Peran</label>
                      <select required  id="peran" class="form-control form-control-sm"></select>
                  </div>
                  <div class="col-md-12 mb-3">
                      <label>Disposisi</label>
                      <select required  id="divisi" class="form-control form-control-sm"></select>
                  </div>
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label>Foto</label>
                      <input type="file" id="foto" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input id="uploadFile" type="text" class="form-control form-control-sm file-upload-info" disabled placeholder="Upload Foto">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                        </span>
                      </div>
                      <span for="">*Foto Harus Memiliki Format .jpg/jpeg/png</span> <br>
                      <span for="">*Ukuran foto maksimal 2048Kb / 2Mb</span>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                  <button disabled id="loader" class="btn btn-primary mr-2">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </button>
                  <button type="submit" class="btn btn-primary perbarui"><i class="ti-save"></i> Perbarui</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endif
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <p class="card-title"><i class="ti-key"></i> Ubah Kata Sandi</p>
              <form class="form-sample" method="" enctype="multipart/form-data" id="passwordSubmit">
                @csrf
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Kata Sandi Lama</label>
                    <input required type="password" id="oldPassword" class="form-control form-control-sm" placeholder="Masukkan Kata Sandi Lama"/>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Ulangi Kata Sandi Lama</label>
                    <input required type="password" id="repeatPassword" class="form-control form-control-sm" placeholder="Ulangi Kata Sandi Lama"/>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Kata Sandi Baru</label>
                    <input required type="password" id="newPassword" class="form-control form-control-sm" placeholder="Masukkan Kata Sandi Baru"/>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                  <button disabled id="loaderPassword" class="btn btn-primary mr-2">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </button>
                  <button type="submit" class="btn btn-primary perbaruiPassword"><i class="ti-save"></i> Perbarui</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $('#loader').hide();
      $('#loaderPassword').hide();
      let id = '{{$user->id}}';  
      $('#ajaxSubmit').on('submit', function(e){
        e.preventDefault();
        if($('#divisi').val() != null){
          let data = new FormData();
          data.append('nama', $('#nama').val());
          data.append('email'  , $('#email').val());
          data.append('peran' , $('#peran').val());
          data.append('divisi' , $('#divisi').val());
          data.append('picture', $('#foto').prop('files')[0]);
          data.append('_method', 'PUT');
          $.ajax({
            url: `${BASE_URL}/api/users/${id}`,
            method: 'post',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
              $('#loader').show();
              $('.perbarui').prop('disabled', true);
            },
            complete: function() {
              $('#loader').hide();
              $('.perbarui').prop('disabled', false);
            },
            success: function(result){
              Toast.fire({
                title: result.status,
                icon: 'success',
              })
              console.log(result);
              $('#closeModal').trigger('click');  
              $('#nama').val(result.data.nama);
              $('#email').val(result.data.email);
              $('.nama').text(result.data.nama);
              $('.divisi').text(result.data.divisi.divisi);
              $('.email').text(result.data.email);
              $('.peran').text(result.data.role.role);
              $('.photo').attr('src',`/${result.data.picture}`);
            },
            error: function(result){
              let errors = result.responseJSON;
              let myArray = errors.message;
              Toast.fire({
                title: 'Terjadi Kesalahan',
                text: `${errors.message}`,
                icon: 'error',
              })
              console.log(result);
            },
          });
        } else {
          Toast.fire({
            title: 'Terdapat parameter yang belum diisi',
            text: `Silahkan isi seluruh parameter terlebih dahulu`,
            icon: 'error',
          })
        }
      });

      $('#passwordSubmit').on('submit', function(e){
        e.preventDefault();
        if($('#oldPassword').val() == $('#repeatPassword').val()){
          let data = new FormData();
          data.append('old', $('#oldPassword').val());
          data.append('repeat'  , $('#repeatPassword').val());
          data.append('new' , $('#newPassword').val());
          data.append('_method', 'PUT');
          $.ajax({
            url: `${BASE_URL}/api/users/${id}/changePassword`,
            method: 'post',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
              $('#loaderPassword').show();
              $('.perbaruiPassword').prop('disabled', true);
            },
            complete: function() {
              $('#loaderPassword').hide();
              $('.perbaruiPassword').prop('disabled', false);
            },
            success: function(result){
              Toast.fire({
                title: result.data.status,
                icon: 'success',
              })
              console.log(result);
              $('#oldPassword').val("");
              $('#repeatPassword').val("");
              $('#newPassword').val("");
            },
            error: function(result){
              let errors = result.responseJSON;
              let myArray = errors.message;
              Toast.fire({
                title: 'Terjadi Kesalahan',
                text: `${errors.message}`,
                icon: 'error',
              })
              console.log(result);
            },
          });
        } else {
          Toast.fire({
            title: 'Tejadi Kesalahan',
            text: `Kata Sandi Tidak Cocok`,
            icon: 'error',
          })
        }
      });

      selectBox('#divisi','Pilih Divisi','divisis','divisi','{{$user->divisi->id}}');
      selectBox('#peran' ,'Pilih Peran','roles','role','{{$user->role->id}}');
    });
  </script>
@endpush