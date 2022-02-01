@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Halaman Surat Keluar</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <i class="ti-email"></i> Surat Keluar</h6>
        </div>
        <div class="col-12 col-xl-4">
         <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop" aria-haspopup="true" aria-expanded="true">
             <i class="ti-plus"></i> Tambah Data Surat Keluar
            </button>
          </div>
         </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-1">
            <p class="card-title">Daftar Surat Keluar</p>
          <button class="btn btn-sm btn-secondary" id="refreshSurat" type="button">
            <div class="rotate">
               <i class="ti-reload"></i>
            </div>
          </button>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="surat" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nomor Surat</th>
                      <th>Tujuan Surat</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" id="closeModalSuratKeluar" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title text-center mb-5"> Tambah Data <small class="text-primary"><i class="ti-email"></i> Surat Keluar</small></h4>
            <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmitKeluar">
              @csrf
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label class="form-label">Nomor Surat</label>
                  <input required type="text" id="nomor_surat_keluar" class="form-control form-control-sm" placeholder="Masukkan Nomor Surat"/>
                  <input required type="hidden" id="id_surat_keluar"/>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label class="form-label">Sub Bagian</label>
                  <select name="divisi" id="divisi_id" class="form-control form-control-sm">
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label class="form-label">Tujuan surat</label>
                  <input required type="text" id="tujuan" class="form-control form-control-sm" placeholder="Masukkan Asal Surat"/>
                </div>
                <div class="col-md-12 mb-3">
                  <label class="form-label">Perihal</label>
                  <textarea required class="form-control form-control-sm" id="perihalss" placeholder="Masukkan Perihal Surat Masuk" rows="4"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <label>File Surat</label>
                    <input type="file" id="file_surat" class="file-upload-default">
                    <div class="input-group col-xs-12">
                      <input id="uploadFile" type="text" class="form-control form-control-sm file-upload-info" disabled placeholder="Upload File Surat Keluar">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                      </span>
                    </div>
                    <div class="text-danger"><small class="file_surat"></small></div>
                  </div>
                </div>
                <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <div class="d-flex justify-content-between mb-1">
                      <label>Lampiran (Optional)</label>
                      <button type="button" class="btn btn-outline-primary btn-rounded btn-icon add_button">
                        <i class="ti-plus"></i>
                      </button>
                     </div>
                    <div class="field_wrapper">
                      <input  name="lampiran" type="file" class="form-control form-control-sm file-upload-info files" placeholder="Upload Lampiran">
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary perbarui"><i class="ti-save"></i> Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  <div class="modal fade" id="modalSuratKeluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Informasi <small class="text-primary"><i class="ti-email"></i> Surat Keluar</small></h4>
          <table class="table table-bordered table-sm mb-3">
            <tbody>
              <tr>
                <th class="table-light">Nomor Surat</th>
                <td><strong id="no_kel"></strong></td>
              </tr>
              <tr>
                <th class="table-light">Divisi</th>
                <td><small class="text-bold" id="divis"></small></td>
              </tr>
              <tr>
                <th class="table-light">Tujuan Surat</th>
                <td><strong id="tujuanSurat" ></strong></td>
              </tr>
              <tr>
                <th class="table-light">Perihal</td>
                <td><strong id="peri"></strong></td>
              </tr>
              <tr>
                <th class="table-light">Status</th>
                <td><strong id="stat"></strong></td>
              </tr>
              <tr>
                <th class="table-light">File Surat</td>
                  <td>
                    <a id="file_surat_keluar" href="" target="_blank" class="btn btn-sm btn-primary"><i class="ti-email"></i> Dokumen</a>
                  </td>
              </tr>
              <tr>
                <th class="table-light">Lampiran</th>
                <td>
                  <strong id="lampir" class="row pr-5"></strong>
                </td>
              </tr>
              <tr>
                <th class="table-light">Tanggal Dibuat</td>
                  <td><strong id="tanggalDibuat"></strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modalValidasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" id="closeModalValidasi" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Validasi <small class="text-primary"><i class="ti-email"></i> Surat Keluar</small></h4>
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxValidasi">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Nomor Surat</label>
                <input required type="text" id="nomor_surat_keluar_validasi" class="form-control form-control-sm" placeholder="Masukkan Nomor Surat"/>
                <input required type="hidden" id="id_surat_keluar"/>
              </div>
            </div>
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary perbarui"><i class="ti-save"></i> Simpan</button>
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
      $('#tanggal_keluar').val(new Date().toDateInputValue());

      $.getJSON(`${BASE_URL}/api/divisis`, function (result) {
        result.data.forEach(function(v,k) {
          $('#divisi_id').append(`
            <option value="${v.id}">${v.divisi}</option>
          `);
        })
      });


      let maxField = 10; //Input fields increment limitation
      let addButton = $('.add_button'); //Add button selector
      let wrapper = $('.field_wrapper'); //Input field wrapper
      let fieldHTML = '<div class="d-flex justify-content-between mt-1 mb-1"><input name="lampiran" type="file" class="form-control form-control-sm file-upload-info files" placeholder="Upload Lampiran"><button type="button" class="btn btn-outline-danger btn-rounded btn-icon remove_button"><i class="ti-minus"></i></button></div>'; //New input field html 
      let x = 1; //Initial field counter is 1
      
      //Once add button is clicked
      $(addButton).click(function(){
          //Check maximum number of input fields
          if(x < maxField){ 
              x++; //Increment field counter
              $(wrapper).append(fieldHTML); //Add field html
          }
      });
      
      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e){
          e.preventDefault();
          $(this).parent('div').remove(); //Remove field html
          x--; //Decrement field counter
      });
      
      $('#surat').DataTable( {
        "ajax": `${BASE_URL}/api/suratKeluars`,
        "columns" : [
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              return meta.row + 1;
            }
          },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              if (row.nomor_surat == `null`) {
                return '<div class="badge badge-outline-danger">Belum diberikan</div>';
              }
                return `<div class="badge badge-outline-success">${row.nomor_surat}</div>`;
            },
          },
          { "data": "tujuan_surat" },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
                if (row.nomor_surat == `null`) {
                  return `<div class="badge badge-danger">Belum divalidasi</div>
                          <button onClick="validasiFunction('${data}')" type="button" class="btn btn-success">
                            <i class="ti-check"></i>
                          </button>
                  `
                }
              return `<div class="badge badge-success">Telah Divalidasi</div>`
            },
          },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              @if (Auth::user()->id === "0797f5f9-7312-4d6d-ac1a-803af987af32")
                return `<div class="btn-group" role="group" aria-label="Basic example">
                  <button onClick="modalKeluarFunction('${data}')" type="button" class="btn btn-info">
                          <i class="ti-eye"></i>
                        </button>
                        <a href="keluar/${data}/edit" class="btn btn-warning">
                          <i class="ti-pencil"></i>
                        </a>
                        <button onClick="deleteFunction('${data}')" type="button" class="btn btn-danger">
                          <i class="ti-trash"></i>
                        </button>
                      </div>`
              @else
              return `<div class="btn-group" role="group" aria-label="Basic example">
                  <button onClick="modalKeluarFunction('${data}')" type="button" class="btn btn-info">
                          <i class="ti-eye"></i>
                        </button>
                      </div>`
              @endif
            }
          }
        ],
        "order":[[0,"asc"]]   
      });
      
      setInterval( function () {
        $("#surat").DataTable().ajax.reload();
      }, 500000 );

    } );
  
    $('#ajaxSubmitKeluar').on('submit', function(e){
      e.preventDefault();
      let data = new FormData();
      let divisi = '{{ Auth::user()->divisi->id }}';
      data.append('nomor_surat', $('#nomor_surat_keluar').val());
      data.append('tujuan_surat', $('#tujuan').val());
      data.append('perihal', $('#perihalss').val());
      data.append('isValid', 1);
      data.append('divisi_id' , $('#divisi_id').val());
      data.append('tanggal_validasi', new Date().toDateInputValue());
      data.append('file', $('#file_surat').prop('files')[0]);
      $('form input[name=lampiran]').each(function(){
        data.append('lampiran[]' ,$(this).prop('files')[0]);
      });
      $.ajax({
        url: `${BASE_URL}/api/suratKeluars/`,
        method: 'post',
        data: data,
        processData: false,
        contentType: false,
        beforeSend: function() {
          $('.perbarui').html('<div class="spinner-border spinner-border-sm"></div> Simpan')
            .prop('disabled', true);
        },
        complete: function() {
          $('.perbarui').html('<i class="ti-save"></i></div> Simpan').prop('disabled', false);
        },
        success: function(result){
          $("#surat").DataTable().ajax.reload();
          Toast.fire({
            title: result.status,
            icon: 'success',
          })
          $('#closeModalSuratKeluar').trigger('click');  
          $('#uploadFile').removeClass('is-invalid');
          $('#nomor_surat_keluar').val("");
          $('#tujuan').val("");
          $('.file_surat').text(``);
          $('#perihalss').val("");
          $('#file_surat').val("");
          $('#uploadFile').val("");
          $('#lampiran').val("");
          $('.field_wrapper').text("");
          $('.field_wrapper').append(`
            <input  name="lampiran" type="file" class="form-control form-control-sm file-upload-info files" placeholder="Upload Lampiran">
          `);
        },
        error: function(result){
          let errors = result.responseJSON;
          let myArray = errors.message;
          $('#uploadFile').addClass('is-invalid');
          $('.file_surat').text(errors.errors.file);
          $('.field_wrapper').text("");
          $('#file_surat').val("");
          $('#uploadFile').val("");
          $('.field_wrapper').append(`
            <input  name="lampiran" type="file" class="form-control form-control-sm file-upload-info files" placeholder="Upload Lampiran">
          `);
          Toast.fire({
            title: 'Terjadi Kesalahan',
            text: `${errors.message}`,
            icon: 'error',
          })
        },
      });
    });

    function deleteFunction(id){
        Swal.fire({
            icon: 'info',
            title: `Apakah kamu ingin menghapus data surat keluar ini ?`,
            showDenyButton: true,
            confirmButtonText: 'Hapus',
            denyButtonText: `Jangan Hapus`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                  url: `${BASE_URL}/api/suratKeluars/${id}`,
                  method: 'delete',
                  success: function(result){
                    $("#surat").DataTable().ajax.reload();
                    Toast.fire(result.data.status, '', 'success')
                  },
                  error:    function(result){
                    let errors = result.responseJSON;
                        Toast.fire(errors.status, '', 'info')
                  },
                });
            } else if (result.isDenied) {
                Toast.fire('Gagal Dihapus', '', 'info')
            }
        })
    }

    function modalKeluarFunction(id){
      $.ajax({
        url: `${BASE_URL}/api/suratKeluars/${id}`,
        method: 'get',
        success: function(result){
          $('#modalSuratKeluar').modal('show');
          $('#loader').hide();
          $('#divis').text(result.data.divisi.divisi);
          $('#tujuanSurat').text(result.data.tujuan_surat);
          $('#peri').text(result.data.perihal);
          $('#lampir').text(``);
          $('#no_kel').text(``);
          $('#tanggalDibuat').text(result.data.created_at);
          let validasi = '';
          if (result.data.isValid) {
            validasi = "Telah Divalidasi |";
          }
          $('#stat').text(`${validasi} ${result.data.tanggal_validasi}`);
          if (result.data.nomor_surat == `null`) {
            $('#no_kel').append(`<div class="badge badge-outline-danger">Belum Diberikan</div>`);
          } else {
            $('#no_kel').text(result.data.nomor_surat);
          }
          $('#file_surat_keluar').attr('href',`${BASE_URL}/${result.data.file}`);
          const arr = result.data.lampirans;
          if (arr.length > 0) {
              arr.forEach(function(v,k) {
              $('#lampir').append(`
                <div class="col-sm-4 col-6 mb-1">
                  <a href="/${v.lampiran}" target="_blank" class="btn btn-sm btn-outline-primary ml-1">Lampiran ${k+1}</a>
                </div>
              `);
            });
          } else {
            $('#lampir').append(`<div class="col pl-3"> Tidak ada Lampiran </div>`);
          }
        },
        error:    function(result){
          let errors = result.responseJSON;
          Toast.fire(errors.status, '', 'info')
        },
      });
    }

    function validasiFunction(id){
      $('#loader').hide();
      $('#modalValidasi').modal('show');
      $('#id_surat_keluar').val(id);
    }

    $('#ajaxValidasi').on('submit', function(e){
      e.preventDefault();
      let data = new FormData();
      data.append('nomor_surat', $('#nomor_surat_keluar_validasi').val());
      data.append('id', $('#id_surat_keluar').val());
      data.append('isValid', 1);
      data.append('tanggal_validasi', new Date().toDateInputValue());
      let id = $('#id_surat_keluar').val(); 
      $.ajax({
        url: `${BASE_URL}/api/suratKeluars/${id}/validasi`,
        method: 'post',
        data: data,
        processData: false,
        contentType: false,
        beforeSend: function() {
          $('.perbarui').html('<div class="spinner-border spinner-border-sm"></div> Simpan')
            .prop('disabled', true);
        },
        complete: function() {
          $('.perbarui').html('<i class="ti-save"></i></div> Simpan').prop('disabled', false);
        },
        success: function(result){
          $("#surat").DataTable().ajax.reload();
          Toast.fire({
            title: result.status,
            icon: 'success',
          })
          $('#closeModalValidasi').trigger('click');  
          $('#nomor_surat_keluar_validasi').val("");
        },
        error: function(result){
          let errors = result.responseJSON;
          let myArray = errors.message;
          Toast.fire({
            title: 'Terdapat parameter yang belum diisi',
            text: `${errors.message}`,
            icon: 'error',
          })
        },
      });
    });

    $("#refreshSurat").click(function(){
      $(".rotate").toggleClass("down");
      Toast.fire({
            title: "Data Surat Keluar Disegarkan",
            icon: 'info',
          })
      $("#surat").DataTable().ajax.reload();
    });
  </script>
@endpush