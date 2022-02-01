@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Halaman Pegawai</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <i class="ti-announcement"></i> Pegawai</h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <a class="btn btn-sm btn-primary" href="{{route('pegawais.create')}}">
                <i class="ti-plus"></i> Tambah Data Pegawai
              </a>
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
          <p class="card-title">Daftar Pegawai</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="surat" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>Status</th>
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

@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $('#loader').hide();
      $('#surat').DataTable( {
        "ajax": `${BASE_URL}/api/pegawais`,
        "columns" : [
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              return meta.row + 1;
            }
          },
          { "data": "nip" },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
                if (row.gelar_depan == null) { row.gelar_depan = '';}
                if (row.nama_depan == null) { row.nama_depan = '';}
                if (row.nama_belakang == null) { row.nama_belakang = '';} else {row.nama_belakang = ` ${row.nama_belakang}`;}
                if (row.gelar_belakang == null) { row.gelar_belakang = '';}
                return `${row.gelar_depan} ${row.nama_depan}${row.nama_belakang}, ${row.gelar_belakang}`;
            }
          },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              if (row.jabatan != null) {
                return `${row.jabatan.jabatan}`;
              } else {
                return `Tidak Ada`;
              }
            }
          },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              if (row.status == 1) {
                return `Pegawai Tetap`;
              } else {
                return `Tenaga Kontrak`;
              }
            }
          },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
                return `<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="berita/${data}/edit" class="btn btn-outline-warning">
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

    } );
  
    function deleteFunction(id){
        Swal.fire({
            icon: 'info',
            title: `Apakah Kamu Ingin Menghapus Pegawai Ini ?`,
            showDenyButton: true,
            confirmButtonText: 'Hapus',
            denyButtonText: `Jangan Hapus`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                  url: `${BASE_URL}/api/pegawais/${id}`,
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