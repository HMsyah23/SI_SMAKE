@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Detail Surat  {{$suratKeluar->nomor_surat}}</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <a href="{{route('surat.keluar')}}">Surat Keluar</a> / <i class="ti-email"></i> {{$suratKeluar->nomor_surat}}</h6>
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
                      <td class="pl-2">Nomor Surat</td>
                      <td><p class="mb-0"><span class="font-weight-bold nomor_surat">{{$suratKeluar->nomor_surat}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Tujuan Surat</td>
                      <td><p class="mb-0"><span class="font-weight-bold tujuan_surat">{{$suratKeluar->tujuan_surat}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Tanggal Keluar</td>
                      <td><p class="mb-0"><span class="font-weight-bold tanggal_keluar">{{date('d/m/Y', strtotime($suratKeluar->tanggal_keluar)) }}</span></p></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <a href="/{{$suratKeluar->file}}" target="_blank" class="btn btn-primary btn-block fileSurat">
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
              <p class="text-bold perihal">{{$suratKeluar->perihal}}</p>
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
                <input type="text" id="nomor" class="form-control form-control-sm" placeholder="Masukkan Nomor Surat" value="{{$suratKeluar->nomor_surat}}"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Tujuan Surat</label>
                <input type="text" id="tujuan" class="form-control form-control-sm" placeholder="Masukkan Tujuan Surat" value="{{$suratKeluar->tujuan_surat}}"/>
              </div>
              <div class="col-md-12 mb-3">
                  <label>Tanggal Keluar</label>
                  <input type="date" id="tanggal_keluar" class="form-control form-control-sm" placeholder="Masukkan Tanggal Keluar" value="{{$suratKeluar->tanggal_keluar}}">
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Perihal</label>
                <textarea class="form-control form-control-sm" id="perihal" placeholder="Masukkan Perihal Surat Masuk" rows="4">{{$suratKeluar->perihal}}</textarea>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label>File Surat</label>
                  <input type="file" id="file_surat" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input id="uploadFile" type="text" class="form-control form-control-sm file-upload-info" disabled placeholder="Upload File Surat Masuk">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Perbarui</button>
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
      let id = '{{$suratKeluar->id}}';  
      $('#ajaxSubmit').on('submit', function(e){
        e.preventDefault();
        let data = new FormData();
        data.append('nomor'  , $('#nomor').val());
        data.append('tujuan' , $('#tujuan').val());
        data.append('tanggal_keluar' , $('#tanggal_keluar').val());
        data.append('perihal' , $('#perihal').val());
        data.append('file', $('#file_surat').prop('files')[0]);
        data.append('_method', 'PUT');
        $.ajax({
          url: `${BASE_URL}/api/suratKeluars/${id}`,
          method: 'post',
          data: data,
          processData: false,
          contentType: false,
          success: function(result){
            $("#surat").DataTable().ajax.reload();
            Toast.fire({
              title: result.status,
              icon: 'success',
            })
            console.log(result);
            $('#closeModal').trigger('click');  
            $('#nomor').val(result.data.nomor_surat);
            $('#tujuan').val(result.data.tujuan_surat);
            $('#tanggal_keluar').val(result.data.tanggal_keluar);
            $('#perihal').val(result.data.perihal);
            $('.nomor_surat').text(result.data.nomor_surat);
            $('.tujuan_surat').text(result.data.tujuan_surat);
            $('.tanggal_keluar').text(result.data.tanggal_keluar);
            $('.fileSurat').attr('href',`/${result.data.file}`);
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
            console.log(result);
          },
        });
      });
    });
  </script>
@endpush