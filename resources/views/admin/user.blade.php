@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Selamat Datang, {{ Auth::user()->nama ?? '' }} </h3>
          <h6 class="font-weight-normal mb-0">Sistem Surat Masuk & Surat Keluar<strong class="text-primary"> UPTD Tahura Bukit Soeharto</strong></h6>
        </div>
        {{-- <div class="col-12 col-xl-4">
         <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
             <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
              <a class="dropdown-item" href="#">January - March</a>
              <a class="dropdown-item" href="#">March - June</a>
              <a class="dropdown-item" href="#">June - August</a>
              <a class="dropdown-item" href="#">August - November</a>
            </div>
          </div>
         </div>
        </div> --}}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 mb-5">
      <div class="row">
        <div class="col-md-12">
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
                      <img style="width:100px; height:100px;" src="{{ (Auth::user()->picture != null) ? '/'.Auth::user()->picture : asset('assets/admin/images/faces/face28.jpg') }}" class="mx-auto d-block rounded img-fluid photo">
                    </tr>
                    <tr>
                      <td class="pl-2">Nama</td>
                      <td><p class="mb-0"><span class="font-weight-bold nama">{{Auth::user()->nama}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Disposisi</td>
                      <td><p class="mb-0"><span class="font-weight-bold divisi">{{Auth::user()->divisi->divisi}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Email</td>
                      <td><p class="mb-0"><span class="font-weight-bold email">{{Auth::user()->email}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Peran</td>
                      <td><p class="mb-0"><span class="font-weight-bold peran">{{Auth::user()->role->role}}</span></p></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-body">
          <p class="card-title"><i class="ti-email"></i> Surat Masuk {{ Auth::user()->divisi->divisi ?? '' }}</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="surat" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nomor Surat</th>
                      <th>Asal Surat</th>
                      <th>Tanggal Surat</th>
                      <th>Tanggal Terima</th>
                      <th>File</th>
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
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      let divisi = '{{ Auth::user()->divisi->id }}';
      $(document).ready(function() {
      $('#surat').DataTable( {
        "ajax": `${BASE_URL}/api/suratMasuks/divisi/${divisi}`,
        "columns" : [
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              return meta.row + 1;
            }
          },
          { "data": "nomor_surat" },
          { "data": "asal_surat" },
          { "data": "tanggal_surat" },
          { "data": "tanggal_terima" },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
                return `<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/${row.file}" target="_blank" class="btn btn-info">
                          <i class="ti-email"></i>
                        </a>
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
    });
  </script>
@endpush