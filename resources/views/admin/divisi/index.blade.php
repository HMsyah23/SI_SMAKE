@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold"><i class="ti-briefcase"></i> Halaman Divisi</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <i class="ti-briefcase"></i> Divisi</h6>
        </div>
        <div class="col-12 col-xl-4">
         <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop" aria-haspopup="true" aria-expanded="true">
             <i class="ti-plus"></i> Tambah Data Divisi
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
          <p class="card-title">Daftar Divisi</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="surat" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Kode</th>
                      <th>Divisi</th>
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
          <h4 class="modal-title text-center mb-5"> Tambah Data <small class="text-primary"><i class="ti-briefcase"></i> Divisi</small></h4>
          <form class="form-sample">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Kode Divisi</label>
                <input type="text" id="kode" class="form-control form-control-sm" placeholder="Masukkan Kode Divisi"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Nama Divisi</label>
                <input type="text" id="nama" class="form-control form-control-sm" placeholder="Masukkan Nama Divisi"/>
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
          <h4 class="modal-title text-center mb-5"> Ubah Data <small class="text-primary"><i class="ti-briefcase"></i> Divisi</small></h4>
          <form class="form-sample">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Kode Divisi</label>
                <input type="text" id="kodeUp" class="form-control form-control-sm" placeholder="Masukkan Kode Divisi"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Nama Divisi</label>
                <input type="text" id="namaUp" class="form-control form-control-sm" placeholder="Masukkan Nama Divisi"/>
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
        "ajax": `${BASE_URL}/api/divisis`,
        "columns" : [
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              return meta.row + 1;
            }
          },
          { "data": "kode" },
          { "data": "divisi" },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              return `<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="divisi/${data}/edit" onClick="showFunction('${data}')" class="btn btn-outline-warning" data-toggle="modal" data-target="#updateModal" aria-haspopup="true" aria-expanded="true">
                          <i class="ti-pencil"></i>
                        </a>
                        <button onClick="deleteFunction('${data}')" type="button" class="btn btn-outline-danger">
                          <i class="ti-trash"></i>
                        </button>
                      </div>`;
            }
          }
        ],
        "order":[[0,"asc"]]   
      });

      
      setInterval( function () {
        $("#surat").DataTable().ajax.reload();
      }, 500000 );

      $('#ajaxSubmit').click(function(e){
        if(($('#kode').val() != "") && ($('#nama').val() != "")){
          e.preventDefault();
          $.ajax({
            url: `${BASE_URL}/api/divisis`,
            method: 'post',
            data: {
              kode: $('#kode').val(),
              nama: $('#nama').val()
            },
            success: function(result){
              $("#surat").DataTable().ajax.reload();
              Toast.fire({
                title: result.status,
                icon: 'success',
              })
              console.log(result);
              $('#closeModal').trigger('click');  
              $('#kode').val("");
              $('#nama').val("");
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
            text: `Isi seluruh parameter terlebih dahulu`,
            icon: 'error',
          })
        }
      });

      $('#ajaxUpdate').click(function(e){
        if(($('#kodeUp').val() != "") && ($('#namaUp').val() != "")){
          e.preventDefault();
          let id = $('#idDivisi').val();
          $.ajax({
            url: `${BASE_URL}/api/divisis/${id}`,
            method: 'put',
            data: {
              kode: $('#kodeUp').val(),
              nama: $('#namaUp').val()
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
                  url: `${BASE_URL}/api/divisis/${id}`,
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
        url: `${BASE_URL}/api/divisis/${id}`,          
        method: 'get',
        success: function(result){
          console.log(result.data);  
          $('#kodeUp').val(result.data.kode);
          $('#namaUp').val(result.data.divisi);
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