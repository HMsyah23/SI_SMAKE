@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Detail Galeri  {{$galeri->nama}}</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <a href="/admin/galeri"> Galeri</a> / <i class="ti-gallery"></i> {{$galeri->nama}}</h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
           <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
             <a class="btn btn-sm btn-primary" href="/admin/galeri">
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
                      <img style="width:100px; height:100px;" src="{{ ($galeri->foto != null) ? '/'.$galeri->foto : asset('assets/admin/images/faces/face28.jpg') }}" class="mx-auto d-block rounded img-fluid photo">
                    </tr>
                    <tr>
                      <td class="pl-2">Nama</td>
                      <td><p class="mb-0"><span class="font-weight-bold nama">{{$galeri->nama}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Deskripsi</td>
                      <td><p class="mb-0"><span class="font-weight-bold divisi">{{$galeri->deskripsi}}</span></p></td>
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
        <div class="col-12 mb-5">
          <div class="card">
            <div class="card-body">
              <p class="card-title"><i class="ti-pencil"></i> Edit Data</p>
              <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
                @csrf
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Nama</label>
                    <input required type="text" id="nama" class="form-control form-control-sm" placeholder="Masukkan Nama" value="{{$galeri->nama}}"/>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input required type="text" id="deskripsi" class="form-control form-control-sm" placeholder="Masukkan Deskripsi" value="{{$galeri->deskripsi}}"/>
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
                      <small for="">*Foto Harus Memiliki Format .jpg/jpeg/png</small> <br>
                      <small for="">*Ukuran foto maksimal 2048Kb / 2Mb</small>
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
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $('#loader').hide();
      $('#loaderPassword').hide();
      let id = '{{$galeri->id}}';  
      $('#ajaxSubmit').on('submit', function(e){
        e.preventDefault();
          let data = new FormData();
          data.append('nama', $('#nama').val());
          data.append('deskripsi'  , $('#deskripsi').val());
          data.append('foto', $('#foto').prop('files')[0]);
          data.append('_method', 'PUT');
          $.ajax({
            url: `${BASE_URL}/api/galeris/${id}`,
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
              $('#deskripsi').val(result.data.deskripsi);
              $('.nama').text(result.data.nama);
              $('.deskripsi').text(result.data.deskripsi);
              $('.photo').attr('src',`/${result.data.foto}`);
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
        
      });
    });
  </script>
@endpush