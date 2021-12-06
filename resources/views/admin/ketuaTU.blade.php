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
    <div class="col-md-6 grid-margin transparent">
      <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4"> Total Surat Masuk</p>
                <p class="fs-30 mb-2" id="suratMasukCount"><i class="ti-email"></i> </p>
              </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue">
            <div class="card-body">
              <p class="mb-4"> Total Surat Keluar</p>
              <p class="fs-30 mb-2" id="suratKeluarCount"><i class="ti-email"></i> </p>
            </div>
          </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
             <div class="d-flex justify-content-between">
              <p class="card-title">Laporan Surat Masuk & Surat Keluar</p>
              <a href="#" class="text-info"> <i class="ti-printer"></i></a>
             </div>
              {{-- <p class="font-weight-500"></p> --}}
              <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
              <canvas id="sales-chart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin">
      <div class="card">
        <div class="card-body">
         <div class="d-flex justify-content-between">
          <p class="card-title"><i class="ti-email"></i> Surat Masuk dan Keluar</p>
          {{-- <a href="#" class="text-info"> <i class="ti-printer"></i></a> --}}
         </div>
         <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="surat" class="display expandable-table" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nomor Surat</th>
                    <th>Asal Surat</th>
                    <th>Detail</th>
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

  <div class="modal fade" id="modalSurat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Informasi <small class="text-primary"><i class="ti-email"></i> Surat Masuk</small></h4>
            <table class="table table-bordered table-sm mb-3">
              <tbody>
                <tr>
                  <th class="table-light" scope="col">Status</th>
                  <td scope="col" id="status"></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Surat Dari</th>
                  <td scope="col"><strong id="dari"></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Diterima Tanggal</th>
                  <td scope="col"><strong id="terima" ></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Tanggal Surat</td>
                  <td scope="col"><strong id="tanggal"></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">No Agenda</th>
                  <td scope="col"><strong id="no"></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">No Surat<p></p></td>
                  <td scope="col"><strong id="no_surat" ></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Sifat</th>
                  <td scope="col"><strong id="sifats" ></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Tipe</th>
                  <td scope="col" id="tipes">
                  </td>
                </tr>
              <tr>
                <th class="table-light" scope="col">Perihal</th>
                  <td style="word-wrap: break-word;min-width: 10px; max-width: 10px; white-space:normal;" id="perihals" >
                      
                  </td>
              </tr>
              <tr>
                <th class="table-light" scope="col">File Surat</th>
                  <td>
                    <a id="file_surats" href="" target="_blank" class="btn btn-rounded btn-sm btn-primary"><i class="ti-email"></i> Dokumen</a>
                  </td>
              </tr>
              <tr>
                <th class="table-light" scope="col">Divalidasi Pada Tanggal</th>
                <td scope="col" id="tanggal_validasi">
                </td>
              </tr>
              <tr>
                <th class="table-light" scope="col">Didisposisi pada Tanggal</th>
                <td scope="col" id="tanggal_disposisi">
                </td>
              </tr>
              <tr>
                <th class="table-light" scope="col">Telah Dibaca pada Tanggal</th>
                <td scope="col" id="tanggal_dibaca">
                </td>
              </tr>
              <tr>
                <th class="table-light" scope="col">Lembar Disposisi</th>
                <td scope="col" id="lembarDisposisi">
                </td>
              </tr>
              </tbody>
            </table>
            <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
              @csrf
              <input type="hidden" id="id_surat" value="">
              <div class="row">
              </div>
              <div class="d-flex justify-content-end">
                <button disabled id="loader" class="btn btn-sm btn-primary btn-icon btn-rounded mr-2">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </button>
                <button type="submit" class="btn btn-sm btn-success perbarui"><i class="ti-check"></i> Validasi</button>
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
      $.getJSON(`${BASE_URL}/api/needValidation/suratMasuks`, function (result) {
        $('#suratMasukCount').append(Object.keys(result.data).length);
      });

      $.getJSON(`${BASE_URL}/api/suratKeluars`, function (result) {
        $('#suratKeluarCount').append(Object.keys(result.data).length);
      });

      $.getJSON(`${BASE_URL}/api/users`, function (result) {
        $('#userCount').append(Object.keys(result.data).length);
      });

      $('#surat').DataTable( {
        "ajax": `${BASE_URL}/api/needValidation/suratMasuks`,
        "columns" : [
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              return meta.row + 1;
            }
          },
          { "data": "nomor_surat" },
          { "data": "asal_surat" },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
                return `<div class="btn-group" role="group" aria-label="Basic example">
                        <button onClick="modalFunction('${data}')" type="button" class="btn btn-info">
                          <i class="ti-eye"></i>
                        </button>
                      </div>`
            }
          }
        ],
        "order":[[0,"asc"]]   
      });
    });

    $('#ajaxSubmit').on('submit', function(e){
      let id = $('#id_surat').val(); 
      e.preventDefault();
      Swal.fire({
            icon: 'info',
            title: `Apakah surat valid ?`,
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Tidak`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                  url: `${BASE_URL}/api/suratMasuks/${id}/validasi`,
                  method: 'get',
                  beforeSend: function () {
                    $('#loader').show();
                  },
                  complete: function() {
                    $('#loader').hide();
                  },
                  success: function(result){
                    $("#surat").DataTable().ajax.reload();
                    $('#closeModal').trigger('click');  
                    Toast.fire(result.status, '', 'success')
                  },
                  error:    function(result){
                    let errors = result.responseJSON;
                        Toast.fire(errors.status, '', 'info')
                  },
                });
            } else if (result.isDenied) {
                Toast.fire('Gagal divalidasi', '', 'info')
            }
        })
    });

  </script>
@endpush