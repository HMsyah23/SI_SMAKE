@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Halaman Pengguna</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <i class="ti-user"></i> Pengguna</h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop" aria-haspopup="true" aria-expanded="true">
                <i class="ti-plus"></i> Tambah Data Pengguna
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
          <p class="card-title">Daftar Pengguna</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="surat" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Disposisi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="tbody">
                    
                  </tbody>
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
          <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Tambah Data <small class="text-primary"><i class="ti-user"></i> Pengguna</small></h4>
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Nama*</label>
                <input required type="text" id="nama" class="form-control form-control-sm" placeholder="Masukkan Nama Pengguna"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Email*</label>
                <input required id="email" type="text" class="form-control form-control-sm" placeholder="Masukkan Email Pengguuna"/>
              </div>
              <div class="col-md-12 mb-3">
                  <label>Peran*</label>
                  <select required id="peran" class="form-control form-control-sm"></select>
              </div>
              <div class="col-md-12 mb-3">
                <label>Divisi*</label>
                <select required  id="divisi" class="form-control form-control-sm"></select>
            </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label>Foto Profil</label>
                  <input type="file" id="img" name="img" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input id="uploadimage" type="text" class="form-control form-control-sm file-upload-info" disabled placeholder="Upload Foto Pengguna">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                    </span>
                  </div>
                  <span for="">*Foto Harus Memiliki Format .jpg/jpeg/png</span> <br>
                  <span for="">*Ukuran foto maksimal 2048Kb / 2Mb</span>
                </div>
                <label for="">*Wajib Diisi</label>
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
      $('#surat').DataTable( {
        "ajax": `${BASE_URL}/api/users`,
        "columns" : [
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              return meta.row + 1;
            }
          },
          { "data": "nama" },
          { "data": "email" },
          { "data": "role.name" },
          { "data": "divisi.kode" },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              if(row.id == '0797f5f9-7312-4d6d-ac1a-803af987af32'){
                return `<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="users/${data}/edit" class="btn btn-outline-warning">
                          <i class="ti-pencil"></i>
                        </a>
                      </div>`;
              } else{
                return `<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="users/${data}/edit" class="btn btn-outline-warning">
                          <i class="ti-pencil"></i>
                        </a>
                        <button onClick="deleteFunction('${data}')" type="button" class="btn btn-outline-danger">
                          <i class="ti-trash"></i>
                        </button>
                      </div>`;
            }
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
        if(($('#peran').val() != null) && ($('#divisi').val() != null)){
          let data = new FormData();
          data.append('nama'  , $('#nama').val());
          data.append('email' , $('#email').val());
          data.append('peran' , $('#peran').val());
          data.append('divisi', $('#divisi').val());
          data.append('picture', $('#img').prop('files')[0]);
          $.ajax({
            url: `${BASE_URL}/api/users`,
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
              $('#nama').val("");
              $('#email').val("");
              $('#img').val("");
              $('#uploadimage').val("");
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
        } else {
          Toast.fire({
            title: 'Terdapat parameter yang belum diisi',
            text: `Silahkan isi seluruh parameter terlebih dahulu`,
            icon: 'error',
          })
        }
      });

    selectBox('#peran','Pilih Peran','roles','name');
    selectBox('#divisi','Pilih Divisi','divisis','divisi');

    function deleteFunction(id){
        Swal.fire({
            icon: 'info',
            title: `Apakah Kamu Ingin Menghapus Pengguna Ini ?`,
            showDenyButton: true,
            confirmButtonText: 'Hapus',
            denyButtonText: `Jangan Hapus`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                  url: `${BASE_URL}/api/users/${id}`,
                  method: 'delete',
                  success: function(result){
                    $("#surat").DataTable().ajax.reload();
                    Toast.fire(result.data.status, '', 'success')
                  },
                  error:    function(result){
                    let errors = result.responseJSON;
                        Toast.fire(errors.status, '', 'info')
                        console.log(result);
                  },
                });
            } else if (result.isDenied) {
                Toast.fire('Gagal Dihapus', '', 'info')
            }
        })
    }
  </script>
@endpush