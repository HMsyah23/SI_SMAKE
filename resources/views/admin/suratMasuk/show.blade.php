@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Detail Surat  {{$suratMasuk->nomor_surat}}</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <a href="{{route('surat.masuk')}}">Surat Masuk</a> / <i class="ti-email"></i> {{$suratMasuk->nomor_surat}}</h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
           <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
             <a class="btn btn-sm btn-primary" href="{{route('surat.masuk')}}">
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
              <p class="card-title mb-0"><i class="ti-email"></i> Detail Surat</p>
              <div class="table-responsive">
                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th class="pl-0  pb-2 border-bottom"></th>
                      <th class="border-bottom pb-2"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="pl-2">Disposisi</td>
                      <td><p class="mb-0"><span class="font-weight-bold divisi">{{$suratMasuk->divisi->divisi}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Nomor Surat</td>
                      <td><p class="mb-0"><span class="font-weight-bold nomor_surat">{{$suratMasuk->nomor_surat}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Asal Surat</td>
                      <td><p class="mb-0"><span class="font-weight-bold asal_surat">{{$suratMasuk->asal_surat}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Tanggal Surat</td>
                      <td><p class="mb-0"><span class="font-weight-bold tanggal_surat">{{date('d/m/Y', strtotime($suratMasuk->tanggal_surat)) }}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Tanggal Terima</td>
                      <td><p class="mb-0"><span class="font-weight-bold tanggal_terima">{{date('d/m/Y', strtotime($suratMasuk->tanggal_terima)) }}</span></p></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <a href="/{{$suratMasuk->file}}" target="_blank" class="btn btn-primary btn-block fileSurat">
                          <i class="ti-email"></i>                      
                          File Surat
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 grid-margin-md-0">
          <div class="card">
            <div class="card-body">
              <p class="card-title"><i class="ti-layout-media-overlay"></i> Perihal</p>
              <p class="text-bold perihal">{{$suratMasuk->perihal}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <p class="card-title"><i class="ti-pencil"></i> Edit Data</p>
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Nomor Surat</label>
                <input required type="text" id="nomor" class="form-control form-control-sm" placeholder="Masukkan Nomor Surat" value="{{$suratMasuk->nomor_surat}}"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Asal Surat</label>
                <input required type="text" id="asal" class="form-control form-control-sm" placeholder="Masukkan Asal Surat" value="{{$suratMasuk->asal_surat}}"/>
              </div>
              <div class="col-md-12 mb-3">
                  <label>Tanggal Surat</label>
                  <input required type="date" id="tanggal_surat" class="form-control form-control-sm" placeholder="Masukkan Tanggal Surat" value="{{$suratMasuk->tanggal_surat}}">
              </div>
              <div class="col-md-12 mb-3">
                  <label>Tanggal Terima</label>
                  <input required type="date" id="tanggal_terima" class="form-control form-control-sm" placeholder="Masukkan Tanggal Terima" value="{{$suratMasuk->tanggal_terima}}">
              </div>
              <div class="col-md-12 mb-3">
                <label>Divisi</label>
                <select required  id="divisi" class="form-control form-control-sm"></select>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Perihal</label>
                <textarea required class="form-control form-control-sm" id="perihal" placeholder="Masukkan Perihal Surat Masuk" rows="4">{{$suratMasuk->perihal}}</textarea>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label>File Surat*</label>
                  <input type="file" id="file_surat" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input id="uploadFile" type="text" class="form-control form-control-sm file-upload-info" disabled placeholder="Upload File Surat Masuk">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                    </span>
                  </div>
                  <span for="">*File Harus Memiliki Format .pdf</span> <br>
                  <span for="">*Ukuran file maksimal 2048Kb / 2Mb</span>
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
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $('#loader').hide();
      let id = '{{$suratMasuk->id}}';  
      $('#ajaxSubmit').on('submit', function(e){
      e.preventDefault();
        if($('#divisi').val() != null){
          let data = new FormData();
          data.append('divisi', $('#divisi').val());
          data.append('nomor'  , $('#nomor').val());
          data.append('asal' , $('#asal').val());
          data.append('tanggal_surat' , $('#tanggal_surat').val());
          data.append('tanggal_terima' , $('#tanggal_terima').val());
          data.append('perihal' , $('#perihal').val());
          data.append('file', $('#file_surat').prop('files')[0]);
          data.append('_method', 'PUT');
          $.ajax({
            url: `${BASE_URL}/api/suratMasuks/${id}`,
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
              $("#surat").DataTable().ajax.reload();
              Toast.fire({
                title: result.status,
                icon: 'success',
              })
              $('#closeModal').trigger('click');  
              $('#nomor').val(result.data.nomor_surat);
              $('#asal').val(result.data.asal_surat);
              $('#tanggal_surat').val(result.data.tanggal_surat);
              $('#tanggal_terima').val(result.data.tanggal_terima);
              $('#perihal').val(result.data.perihal);
              $('.nomor_surat').text(result.data.nomor_surat);
              $('.asal_surat').text(result.data.asal_surat);
              $('.tanggal_surat').text(result.data.tanggal_surat);
              $('.tanggal_terima').text(result.data.tanggal_terima);
              $('.fileSurat').attr('href',`/${result.data.file}`);
              $('.divisi').text(result.data.divisi.divisi);
              $('.perihal').text(result.data.perihal);
            },
            error: function(result){
              let errors = result.responseJSON;
              let myArray = errors.message;
              Toast.fire({
                title: 'Terjadi Kesalahan',
                text: `${errors.message}`,
                icon: 'error',
              })
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

      selectBox('#divisi','Pilih Divisi','divisis','divisi','{{$suratMasuk->divisi->id}}');
    });
  </script>
@endpush