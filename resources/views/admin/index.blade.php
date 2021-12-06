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
      </div>
      <div class="row">
        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <p class="mb-4">Jumlah Pengguna</p>
              <p class="fs-30 mb-2" id="userCount"><i class="ti-user"></i> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
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
  <div class="row">
    <div class="col-md-6 grid-margin">
      <div class="card">
        <div class="card-body">
         <div class="d-flex justify-content-between mb-1">
          <p class="card-title"><i class="ti-email"></i> Surat Masuk</p>
          <a href="{{ route('surat.masuk') }}" class="btn btn-sm btn-primary"> <i class="ti-plus"></i> Tambah Data Surat Masuk</a>
         </div>
         <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="suratMasuk" class="display expandable-table" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nomor Surat</th>
                    <th>Asal Surat</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin">
      <div class="card">
        <div class="card-body">
          <p class="card-title"><i class="ti-email"></i> Surat Keluar</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="suratKeluar" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nomor Surat</th>
                      <th>Tujuan Surat</th>
                      <th>Status</th>
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
                  <th class="table-light" scope="col">Nomor Surat</th>
                  <td scope="col"><strong id="no_kel"></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Divisi</th>
                  <td scope="col"><strong id="divis"></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Tujuan Surat</th>
                  <td scope="col"><strong id="tujuan" ></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Perihal</td>
                  <td scope="col"><strong id="peri"></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Status</th>
                  <td scope="col"><strong id="stat"></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">File Surat</td>
                    <td>
                      <a id="file_surat_keluar" href="" target="_blank" class="btn btn-sm btn-primary"><i class="ti-email"></i> Dokumen</a>
                    </td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Lampiran</th>
                  <td scope="col"><strong id="lampir" ></strong></td>
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
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmitKeluar">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Nomor Surat</label>
                <input required type="text" id="nomor_surat_keluar" class="form-control form-control-sm" placeholder="Masukkan Nomor Surat"/>
                <input required type="hidden" id="id_surat_keluar"/>
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

      function distribusiFunction(id){
      Swal.fire({
            icon: 'info',
            title: `Kirim File Surat Masuk ?`,
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Tidak`,
        }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: `${BASE_URL}/api/suratMasuks/${id}/distribusi`,
                method: 'post',
                success: function(result){
                  $("#suratMasuk").DataTable().ajax.reload();
                  Toast.fire(result.status, '', 'success')
                },
                error:    function(result){
                  let errors = result.responseJSON;
                  Toast.fire(errors.status, '', 'info')
                },
              });
            } else if (result.isDenied) {
                Toast.fire('Gagal dikirim ke divisi terkait', '', 'info')
            }
        })
      }

    $(document).ready(function() {
      $.getJSON(`${BASE_URL}/api/suratMasuks`, function (result) {
        $('#suratMasukCount').append(Object.keys(result.data).length);
      });

      $.getJSON(`${BASE_URL}/api/suratKeluars`, function (result) {
        $('#suratKeluarCount').append(Object.keys(result.data).length);
      });

      $.getJSON(`${BASE_URL}/api/users`, function (result) {
        $('#userCount').append(Object.keys(result.data).length);
      });

      $('#suratMasuk').DataTable( {
        "ajax": `${BASE_URL}/api/distribusi/suratMasuks`,
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
              if (row.isValid) {
                if (row.isDisposisi) {
                  return `<div class="badge badge-success">Telah di disposisi</div>`
                } else {
                  return `<div class="badge badge-primary">Telah di validasi</div>`
                }
              } else {
                return `<div class="badge badge-secondary">Belum di validasi</div>`
              }
            }
          },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              if (row.isDisposisi) {
                  button = `<button onClick="distribusiFunction('${data}')"  data-toggle="tooltip" data-placement="top" title="Kirim surat ke divisi" type="button" class="btn btn-primary">
                          <i class="ti-shift-right"></i>
                        </button>`;
                } else {
                  button = ``;
                }
              return `<div class="btn-group" role="group" aria-label="Basic example">
                        <button onClick="modalFunction('${data}')" type="button"  data-toggle="tooltip" data-placement="top" title="Detail surat" class="btn btn-info">
                          <i class="ti-eye"></i>
                        </button>
                        ${button}
                      </div>`
            }
          }
        ],
        "order":[[0,"asc"]]   
      });
    });

    $('#suratKeluar').DataTable( {
        "ajax": `${BASE_URL}/api/needValidation/suratKeluars`,
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
                  return `<div class="badge badge-danger">Belum divalidasi</div>`
                }
              return `<div class="badge badge-success">Telah Divalidasi</div>`
            },
          },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              if (row.nomor_surat == `null`) {
                  button = `<button onClick="validasiFunction('${data}')" type="button" class="btn btn-success">
                          <i class="ti-check"></i>
                        </button>`;
                } else {
                  button = ``;
                }
                return `<div class="btn-group" role="group" aria-label="Basic example">
                        <button onClick="modalKeluarFunction('${data}')" type="button" class="btn btn-info">
                          <i class="ti-eye"></i>
                        </button>
                        ${button}
                      </div>`
            }
          }
        ],
        "order":[[0,"asc"]]   
      });
  
      function modalKeluarFunction(id){
      $.ajax({
        url: `${BASE_URL}/api/suratKeluars/${id}`,
        method: 'get',
        success: function(result){
          $('#modalSuratKeluar').modal('show');
          console.log(result);
          $('#loader').hide();
          $('#divis').text(result.data.divisi.divisi);
          $('#tujuan').text(result.data.tujuan_surat);
          $('#peri').text(result.data.perihal);
          $('#stat').text(``);
          $('#lampir').text(``);
          if (result.data.nomor_surat == `null`) {
            $('#no_kel').append(`<div class="badge badge-outline-danger">Belum Diberikan</div>`);
            $('#stat').append(`<div class="badge badge-danger">Belum Divalidasi</div>`);
          } else {
            $('#no_kel').text(result.data.nomor_surat);
            $('#stat').append(`<div class="badge badge-success">Telah Divalidasi</div>`);
          }
          $('#file_surat_keluar').attr('href',`${BASE_URL}/${result.data.file}`);
          $.each(JSON.parse(result.data.lampiran), function(k, v) {
            $('#lampir').append(`<a href="/lampiran/surat/keluar/${v}" target="_blank" class="btn btn-sm btn-outline-primary ml-1">Lampiran ${k+1}</a>`);
          });
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

    $('#ajaxSubmitKeluar').on('submit', function(e){
      e.preventDefault();
      let data = new FormData();
      data.append('nomor_surat', $('#nomor_surat_keluar').val());
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
        beforeSend: function () {
          $('#loader').show();
          $('.perbarui').prop('disabled', true);
        },
        complete: function() {
          $('#loader').hide();
          $('.perbarui').prop('disabled', false);
        },
        success: function(result){
          $("#suratKeluar").DataTable().ajax.reload();
          console.log(result.status);
          Toast.fire({
            title: result.status,
            icon: 'success',
          })
          $('#closeModalValidasi').trigger('click');  
          $('#nomor_surat_keluar').val("");
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
  </script>
@endpush