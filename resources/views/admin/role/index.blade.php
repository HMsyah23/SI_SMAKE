@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold"><i class="ti-key"></i> Halaman Peran</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <i class="ti-key"></i> Peran</h6>
        </div>
        <div class="col-12 col-xl-4">
         <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop" aria-haspopup="true" aria-expanded="true">
             <i class="ti-plus"></i> Tambah Data Peran
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
          <p class="card-title">Daftar Peran</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="surat" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Peran</th>
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
          <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Tambah Data <small class="text-primary"><i class="ti-key"></i> Peran</small></h4>
          <form class="form-sample">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Nama</label>
                <input type="text" id="name" class="form-control form-control-sm" placeholder="Masukkan Nama Peran"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Peran</label>
                <input type="text" id="role" class="form-control form-control-sm" placeholder="Masukkan Peran"/>
              </div>
            </div>
            <div class="d-flex justify-content-end">
              <button type="button" id="ajaxSubmit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" id="closeModalUp" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Ubah Data <small class="text-primary"><i class="ti-key"></i> Peran</small></h4>
          <form class="form-sample">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Nama</label>
                <input type="text" id="nameUp" class="form-control form-control-sm" placeholder="Masukkan Nama Peran"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Peran</label>
                <input type="text" id="roleUp" class="form-control form-control-sm" placeholder="Masukkan Peran"/>
              </div>
              <input type="hidden" id="idDivisi"/>
            </div>
            <div class="d-flex justify-content-end">
              <button type="button" id="ajaxUpdate" class="btn btn-primary"><i class="ti-pencil"></i> Ubah</button>
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
      $('#surat').DataTable( {
        "ajax": `${BASE_URL}/api/roles`,
        "columns" : [
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              return meta.row + 1;
            }
          },
          { "data": "name" },
          { "data": "role" },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              if(row.id == '6539054c-6aa5-48ec-bc3b-a235f135c923' || row.id == 'f7e9d614-e732-4669-9a8f-4c719f29a6af'){
                return ``;
              } else{
                return `<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="role/${data}/edit" onClick="showFunction('${data}')" class="btn btn-outline-warning" data-toggle="modal" data-target="#updateModal" aria-haspopup="true" aria-expanded="true">
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

      $('#ajaxSubmit').click(function(e){
        if(($('#name').val() != "") && ($('#role').val() != "")){
          e.preventDefault();
          $.ajax({
            url: `${BASE_URL}/api/roles`,
            method: 'post',
            data: {
              name: $('#name').val(),
              role: $('#role').val()
            },
            success: function(result){
              $("#surat").DataTable().ajax.reload();
              Toast.fire({
                title: result.status,
                icon: 'success',
              })
              console.log(result);
              $('#closeModal').trigger('click');  
              $('#name').val("");
              $('#role').val("");
            },
            error: function(result){
              let errors = result.responseJSON;
              let myArray = errors.message;
              Toast.fire({
                title: 'Terdapat parameter yang belum diisi',
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

      $('#ajaxUpdate').click(function(e){
        if(($('#nameUp').val() != "") && ($('#roleUp').val() != "")){
          e.preventDefault();
          let id = $('#idDivisi').val();
          $.ajax({
            url: `${BASE_URL}/api/roles/${id}`,
            method: 'put',
            data: {
              name: $('#nameUp').val(),
              role: $('#roleUp').val()
            },
            success: function(result){
              $("#surat").DataTable().ajax.reload();
              Toast.fire({
                title: result.status,
                icon: 'success',
              })
              console.log(result);
              $('#closeModalUp').trigger('click');  
              $('#kode').val("");
              $('#nama').val("");
            },
            error: function(result){
              let errors = result.responseJSON;
              let myArray = errors.message;
              Toast.fire({
                title: 'Terdapat Kesalahan',
                text: `${errors.message}`,
                icon: 'error',
              })
              console.log(result);
            },
          });
        } else {
          Toast.fire({
            title: 'Terdapat parameter yang belum diisi',
            text: `Isi seluruh parameter terlebih dahulu`,
            icon: 'error',
          })
        }
      });
    });

    function deleteFunction(id){
        Swal.fire({
            icon: 'info',
            title: `Apakah Kamu Ingin Menghapus Akun Ini ?`,
            showDenyButton: true,
            confirmButtonText: 'Hapus',
            denyButtonText: `Jangan Hapus`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                  url: `${BASE_URL}/api/roles/${id}`,
                  method: 'delete',
                  success: function(result){
                    $("#surat").DataTable().ajax.reload();
                    Toast.fire(result.data.status, '', 'success')
                    console.log(result.data);  
                  },
                  error:    function(result){
                    let errors = result.responseJSON;
                        Toast.fire(errors.status, '', 'info')
                        console.log(result);
                  },
                });
            } else if (result.isDenied) {
                Toast.fire('Gagal Dihapus', '', 'error')
            }
        })
    }

    function showFunction(id){
      $.ajax({
        url: `${BASE_URL}/api/roles/${id}`,          
        method: 'get',
        success: function(result){
          console.log(result.data);  
          $('#nameUp').val(result.data.name);
          $('#roleUp').val(result.data.role);
          $('#idDivisi').val(result.data.id);
        },
        error:    function(result){
          let errors = result.responseJSON;            
          Swal.fire(errors.status, '', 'info')
          console.log(result);
        },
      });
    }
  </script>
@endpush