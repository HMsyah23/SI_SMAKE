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
          <p class="card-title">Daftar Surat Keluar</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="surat" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nomor Surat</th>
                      <th>Tujuan Surat</th>
                      <th>Tanggal Keluar</th>
                      <th>File Surat</th>
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
          <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Tambah Data <small class="text-primary"><i class="ti-email"></i> Surat Masuk</small></h4>
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Nomor Surat</label>
                <input required type="text" id="nomor" class="form-control form-control-sm" placeholder="Masukkan Nomor Surat"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Tujuan Surat</label>
                <input required type="text" id="tujuan" class="form-control form-control-sm" placeholder="Masukkan Asal Surat"/>
              </div>
              <div class="col-md-12 mb-3">
                  <label>Tanggal Keluar</label>
                  <input required type="date" id="tanggal_keluar" class="form-control form-control-sm" placeholder="Masukkan Tanggal Surat">
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Perihal</label>
                <textarea required class="form-control form-control-sm" id="perihal" placeholder="Masukkan Perihal Surat Masuk" rows="4"></textarea>
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
      
      $('#surat').DataTable( {
        "ajax": `${BASE_URL}/api/suratKeluars`,
        "columns" : [
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              return meta.row + 1;
            }
          },
          { "data": "nomor_surat" },
          { "data": "tujuan_surat" },
          { "data": "tanggal_keluar" },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
                return `<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/${row.file}" target="_blank" class="btn btn-info">
                          <i class="ti-email"></i>
                        </a>
                      </div>`
            }
          },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
                return `<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="keluar/${data}/edit" class="btn btn-warning">
                          <i class="ti-pencil"></i>
                        </a>
                        <button onClick="deleteFunction('${data}')" type="button" class="btn btn-danger">
                          <i class="ti-trash"></i>
                        </button>
                      </div>`
            }
          }
        ],
        "order":[[0,"asc"]]   
      });
      
      setInterval( function () {
        $("#surat").DataTable().ajax.reload();
      }, 500000 );

    } );
  
    $('#ajaxSubmit').on('submit', function(e){
      e.preventDefault();
          let data = new FormData();
          data.append('nomor'  , $('#nomor').val());
          data.append('tujuan' , $('#tujuan').val());
          data.append('tanggal_keluar' , $('#tanggal_keluar').val());
          data.append('perihal' , $('#perihal').val());
          data.append('file', $('#file_surat').prop('files')[0]);
          $.ajax({
            url: `${BASE_URL}/api/suratKeluars`,
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
              $('#nomor').val("");
              $('#tujuan').val("");
              $('#tanggal_keluar').val(new Date().toDateInputValue());
              $('#perihal').val("");
              $('#file_surat').val("");
              $('#uploadFile').val("");
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
  </script>
@endpush