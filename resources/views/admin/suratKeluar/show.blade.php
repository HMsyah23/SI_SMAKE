@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Detail Surat {{ $suratKeluar->nomor_surat }}</h3>
                    <h6 class="font-weight-normal mb-0"><a href="{{ route('dashboard') }}">Dashboard</a> / <a
                            href="{{ route('surat.keluar') }}">Surat Keluar</a> / <i class="ti-email"></i>
                        {{ $suratKeluar->nomor_surat }}</h6>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <a class="btn btn-sm btn-primary" href="{{ route('surat.keluar') }}">
                                <i class="ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 grid-margin">
            <div class="row">
                <div class="col-md-12 mb-4">
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
                                            <td>
                                                <p class="mb-0"><span
                                                        class="font-weight-bold nomor_surat">{{ $suratKeluar->nomor_surat }}</span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                          <td class="pl-2">Sub Bagian</td>
                                          <td>
                                              <p class="mb-0"><span
                                                      class="font-weight-bold sub_bagian">{{ $suratKeluar->divisi->divisi }}</span>
                                              </p>
                                          </td>
                                      </tr>
                                        <tr>
                                            <td class="pl-2">Tujuan Surat</td>
                                            <td>
                                                <p class="mb-0"><span
                                                        class="font-weight-bold tujuan_surat">{{ $suratKeluar->tujuan_surat }}</span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-2">Tanggal Validasi</td>
                                            <td>
                                                <p class="mb-0"><span
                                                        class="font-weight-bold tanggal_validasi"></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                          <td class="pl-2">Tanggal Dibuat</td>
                                          <td>
                                              <p class="mb-0"><span
                                                      class="font-weight-bold tanggal_dibuat"></span>
                                              </p>
                                          </td>
                                      </tr>
                                      <tr>
                                        <td class="pl-2">Terakhir Diperbarui</td>
                                        <td>
                                            <p class="mb-0"><span
                                                    class="font-weight-bold tanggal_diperbarui"></span>
                                            </p>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a id="linkSurat" href="/{{ $suratKeluar->file }}" target="_blank"
                                                    class="btn btn-primary btn-block fileSurat">
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
                <div class="col-md-12 mb-4 grid-margin-md-0">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title"><i class="ti-layout-media-overlay"></i> Perihal</p>
                            <p class="text-bold perihal">{{ $suratKeluar->perihal }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 grid-margin-md-0">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title"><i class="ti-layout-media-overlay"></i> Lampiran</p>
                            <div id="lampir" class="row text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 stretch-card grid-margin">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <p class="card-title"><i class="ti-pencil"></i> Edit Data</p>
                            <button disabled id="loader" class="btn btn-primary btn-icon btn-rounded mr-2">
                              <div class="spinner-border" role="status">
                                  <span class="sr-only">Loading...</span>
                              </div>
                            </button>
                          </div>
                            <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxUpdate">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nomor Surat</label>
                                        <input required type="text" id="nomor" class="form-control form-control-sm"
                                            placeholder="Masukkan Nomor Surat" value="{{ $suratKeluar->nomor_surat }}" />
                                    </div>
                                      <div class="col-md-12 mb-3">
                                        <label class="form-label">Sub Bagian</label>
                                        <select name="divisi" id="divisi_id" class="form-control form-control-sm">
                                        </select>
                                      </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Tujuan Surat</label>
                                        <input required type="text" id="tujuan" class="form-control form-control-sm"
                                            placeholder="Masukkan Tujuan Surat"
                                            value="{{ $suratKeluar->tujuan_surat }}" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Perihal</label>
                                        <textarea required class="form-control form-control-sm" id="perihal"
                                            placeholder="Masukkan Perihal Surat Keluar"
                                            rows="4">{{ $suratKeluar->perihal }}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary perbarui"><i class="ti-save"></i>
                                        Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title"><i class="ti-pencil"></i> Ubah File Surat Masuk</p>
                            <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxUpdateFile">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>File Surat*</label>
                                            <input type="file" id="file_surat" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                              <input id="uploadFile" type="text" class="form-control form-control-sm file-upload-info" disabled placeholder="Upload File Surat Keluar">
                                              <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                                              </span>
                                            </div>
                                            <div class="text-danger"><small class="file_surat"></small></div>
                                            <span for="">*Ukuran file maksimal 2048Kb / 2Mb</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary perbarui"><i class="ti-save"></i>
                                        Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between mb-2">
                            <p class="card-title"><i class="ti-pencil"></i> Tambahkan Lampiran (Optional)</p>
                            <button type="button" class="btn btn-outline-primary btn-rounded btn-icon add_button">
                              <i class="ti-plus"></i>
                            </button>
                           </div>
                            <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxUpdateLampiran">
                                @csrf
                                <div class="field_wrapper">
                                  <input  name="lampiran" type="file" class="form-control form-control-sm file-upload-info files" placeholder="Upload Lampiran">
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="submit" class="btn btn-primary perbarui"><i class="ti-save"></i>
                                        Simpan</button>
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
        let id = '{{ $suratKeluar->id }}';
        let divisi = '{{ $suratKeluar->divisi->id }}';
        $(document).ready(function() {

          $.getJSON(`${BASE_URL}/api/divisis`, function (result) {
            let selected = ''
            result.data.forEach(function(v,k) {
              if (divisi === v.id) {
                selected = 'selected'
              }
              $('#divisi_id').append(`
                <option ${selected} value="${v.id}">${v.divisi}</option>
              `);
            })
          });

          let maxField = 10; 
          let addButton = $('.add_button'); 
          let wrapper = $('.field_wrapper'); 
          let fieldHTML = '<div class="d-flex justify-content-between mt-1 mb-1"><input name="lampiran" type="file" class="form-control form-control-sm file-upload-info files" placeholder="Upload Lampiran"><button type="button" class="btn btn-outline-danger btn-rounded btn-icon remove_button"><i class="ti-minus"></i></button></div>'; //New input field html 
          let x = 1; 
      
          $(addButton).click(function(){
              //Check maximum number of input fields
              if(x < maxField){ 
                  x++; //Increment field counter
                  $(wrapper).append(fieldHTML); //Add field html
              }
          });
      
          $(wrapper).on('click', '.remove_button', function(e){
              e.preventDefault();
              $(this).parent('div').remove(); //Remove field html
              x--; //Decrement field counter
          });
          $('#loader').hide();
            
          $.getJSON(`${BASE_URL}/api/suratKeluars/${id}`, function (result) {
            $('.tanggal_validasi').text(result.data.tanggal_validasi);
            $('.tanggal_dibuat').text(result.data.created_at);
            $('.tanggal_diperbarui').text(result.data.updated_at);
          });
        });

        function loadLampiran(){
          $.ajax({
            url: `${BASE_URL}/api/suratKeluars/${id}`,
            method: 'get',
            success: function(result) {
                const arr = result.data.lampirans;
                $('#lampir').text(``);
                if (arr.length > 0) {
                    arr.forEach(function(v, k) {
                        $('#lampir').append(`
                        <div class="col-6 col-sm-6 mb-1">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="/${v.lampiran}" target="_blank" class="btn btn-sm btn-light btn-outline-primary">Lampiran ${k+1}</a>
                            <button onClick="deleteFunction('${v.id}')" type="button" class="btn btn-sm btn-danger">
                              <i class="ti-trash"></i>
                            </button>
                          </div>
                        </div>
                      `);
                    });
                } else {
                    $('#lampir').append(`<div class="col pl-3"> Tidak ada Lampiran </div>`);
                }
            },
            error: function(result) {
                let errors = result.responseJSON;
                Toast.fire(errors.status, '', 'info')
            },
          });
        }

        loadLampiran();

        function deleteFunction(id){
          Swal.fire({
              icon: 'info',
              title: `Apakah Kamu Ingin Menghapus File Lampiran Ini ?`,
              showDenyButton: true,
              confirmButtonText: 'Hapus',
              denyButtonText: `Jangan Hapus`,
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                    url: `${BASE_URL}/api/lampiranSuratKeluars/${id}`,
                    method: 'delete',
                    success: function(result){
                      $('.tanggal_diperbarui').text(result.data.updated_at);
                      Toast.fire(result.status, '', 'success')
                      loadLampiran()
                    },
                    error:    function(result){
                      let errors = result.responseJSON;
                          Toast.fire(errors.status, '', 'info')
                    },
                  });
              } else if (result.isDenied) {
                  Toast.fire('Gagal Dihapus', '', 'error')
              }
          })
        }

        $('#ajaxUpdateFile').on('submit', function(e){
          e.preventDefault();
          let data = new FormData();
          data.append('file', $('#file_surat').prop('files')[0]);
          data.append('_method', 'PUT');
          $.ajax({
            url: `${BASE_URL}/api/suratKeluars/${id}/fileSuratKeluar`,
            method: 'post',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function() {
              $('#ajaxUpdateFile').find('.perbarui').html('<div class="spinner-border spinner-border-sm"></div> Simpan')
                .prop('disabled', true);
            },
            complete: function() {
              $('#ajaxUpdateFile').find('.perbarui').html('<i class="ti-save"></i></div> Simpan').prop('disabled', false);
            },
            success: function(result){
              Toast.fire({
                title: result.status,
                icon: 'success',
              })
              $('#file_surat').val("");
              $('#uploadFile').val("").removeClass('is-invalid');
              $('.file_surat').text(``);
              $('#linkSurat').attr('href',`${BASE_URL}/${result.data.file}`);
              $('.tanggal_diperbarui').text(result.data.updated_at);
            },
            error: function(result){
              let errors = result.responseJSON;
              let myArray = errors.message;
              $('#uploadFile').addClass('is-invalid');
              $('.file_surat').val("").text(errors.errors.file);
              $('#file_surat').val("");
              Toast.fire({
                title: 'Terjadi Kesalahan',
                text: `${errors.message}`,
                icon: 'error',
              })
            },
          });
        });

        $('#ajaxUpdate').on('submit', function(e){
          e.preventDefault();
          let data = new FormData();
          data.append('nomor_surat', $('#nomor').val());
          data.append('divisi_id', $('#divisi_id').val());
          data.append('tujuan_surat', $('#tujuan').val());
          data.append('perihal', $('#perihal').val());
          data.append('_method', 'PUT');
          $.ajax({
            url: `${BASE_URL}/api/suratKeluars/${id}/update`,
            method: 'post',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function() {
              $('#ajaxUpdate').find('.perbarui').html('<div class="spinner-border spinner-border-sm"></div> Simpan')
                .prop('disabled', true);
            },
            complete: function() {
              $('#ajaxUpdate').find('.perbarui').html('<i class="ti-save"></i></div> Simpan').prop('disabled', false);
            },
            success: function(result){
              Toast.fire({
                title: result.status,
                icon: 'success',
              })
              $('.nomor_surat').text(result.data.nomor_surat);
              $('.tujuan_surat').text(result.data.tujuan_surat);
              $('.perihal').text(result.data.perihal);
              $('.sub_bagian').text(result.data.divisi.divisi);
              $('.tanggal_diperbarui').text(result.data.updated_at);
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
        });

        $('#ajaxUpdateLampiran').on('submit', function(e){
          e.preventDefault();
          let data = new FormData();
          data.append('surat_keluar_id', id);
          $('form input[name=lampiran]').each(function(){
            data.append('lampiran[]' ,$(this).prop('files')[0]);
          });
          $.ajax({
            url: `${BASE_URL}/api/lampiranSuratKeluars`,
            method: 'post',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function() {
              $('#ajaxUpdateLampiran').find('.perbarui').html('<div class="spinner-border spinner-border-sm"></div> Simpan')
                .prop('disabled', true);
            },
            complete: function() {
              $('#ajaxUpdateLampiran').find('.perbarui').html('<i class="ti-save"></i></div> Simpan').prop('disabled', false);
            },
            success: function(result){
              Toast.fire({
                title: result.status,
                icon: 'success',
              })
              $('.field_wrapper').text("").append(`
                <input  name="lampiran" type="file" class="form-control form-control-sm file-upload-info files" placeholder="Upload Lampiran">
              `);
              loadLampiran();
              $('.tanggal_diperbarui').text(result.data.updated_at);
            },
            error: function(result){
              let errors = result.responseJSON;
              let myArray = errors.message;
              $('.field_wrapper').text("").append(`
                <input  name="lampiran" type="file" class="form-control form-control-sm file-upload-info files" placeholder="Upload Lampiran">
              `);
              loadLampiran();
              Toast.fire({
                title: 'Terjadi Kesalahan',
                text: `${errors.message}`,
                icon: 'error',
              })
            },
          });
        });
    </script>
@endpush
