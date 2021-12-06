@extends('admin.layouts.app')

@push('css')

  <link rel="stylesheet" href="{{asset('assets/admin/vendors/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">

<style>
  #modalDisposisi  .modal-content .modal-body .row .signature {
    display: -webkit-box;
    display: -ms-flexbox;
    display: block;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    height: 50vh !important;
    width: 100%;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    margin: 0;
    padding: 32px 16px;
    font-family: Helvetica, Sans-Serif;
}
  .signature-pad {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    font-size: 10px;
    width: 100%;
    height: 100%;
    max-width: 700px;
    max-height: 460px;
    border: 1px solid #e8e8e8;
    background-color: #fff;
    /* box-shadow: 0 1px 4px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset; */
    border-radius: 4px;
  }

  .signature-pad::before,
  .signature-pad::after {
    position: absolute;
    z-index: -1;
    content: "";
    width: 40%;
    height: 10px;
    bottom: 10px;
    background: transparent;
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.4);
  }

  .signature-pad::before {
    left: 20px;
    -webkit-transform: skew(-3deg) rotate(-3deg);
            transform: skew(-3deg) rotate(-3deg);
  }

  .signature-pad::after {
    right: 20px;
    -webkit-transform: skew(3deg) rotate(3deg);
            transform: skew(3deg) rotate(3deg);
  }

  .signature-pad--body {
    position: relative;
    -webkit-box-flex: 1;
        -ms-flex: 1;
            flex: 1;
    border: 1px solid #f4f4f4;
  }

  .signature-pad--body
  canvas {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    border-radius: 4px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
  }

  .signature-pad--footer {
    color: #C3C3C3;
    text-align: center;
    font-size: 1.2em;
    margin-top: 8px;
  }

  .signature-pad--actions {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    margin-top: 8px;
  }
</style>
@endpush

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
          <p class="card-title"><i class="ti-email"></i> Disposisi Surat Masuk</p>
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

  <div class="modal fade" id="modalDisposisi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" id="closeModalDisposisi" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Informasi <small class="text-primary"><i class="ti-email"></i> Surat Masuk</small></h4>
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
            @csrf      
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label><strong>Diteruskan Kepada :</strong></label>
                  <select class="form-control" required multiple="multiple" id="selectDisposisi"></select>
                </div>
              </div>
                  <div class="col-12">
                    <label><strong>Dengan Hormat Harap :</strong></label>
                    <div class="form-group">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input name="catatan" value="1" type="checkbox" class="form-check-input">
                          Tanggapan dan Saran
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input name="catatan" value="2" type="checkbox" class="form-check-input">
                          Proses Lebih Lanjut
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input name="catatan" value="3" type="checkbox" class="form-check-input">
                          Koordinasi / Konfirmasi
                        </label>
                      </div>
                      <div class="form-check">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <label class="form-check-label">
                              <input onChange="kriteriaFunction('#catatan','#catatanCek')" id="catatanCek" type="checkbox" class="form-check-input">
                            </label>
                          </div>
                          <input disabled name="catatan" type="text" id="catatan" class="form-control form-control-sm" placeholder="Catatan Tambahan">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Catatan</label>
                    <textarea required class="form-control form-control-sm" id="catatanTambahan" placeholder="Masukkan Catatan" rows="4"></textarea>
                  </div>
                  <div class="col-12 signature">
                    <label class="form-label">Tanda Tangan</label>
                    <div id="signature-pad" class="signature-pad">
                      <div class="signature-pad--body">
                          <canvas></canvas>
                      </div>
                    </div>
                  </div>
            </div>
              <input type="hidden" id="id_surat" value="">
            <div class="row">
            </div>
            <div class="d-flex justify-content-end">
              <button disabled id="loader" class="btn btn-sm btn-primary btn-icon btn-rounded mr-2">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </button>
              <button type="button" class="btn btn-warning clear mr-2">Bersihkan Tanda Tangan</button>
              <button type="submit" class="btn btn-success perbarui"><i class="ti-users"></i> Disposisi Surat</button>
            </div>
          </form>
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
@endsection

@push('js')
  <script src="{{asset('assets/watermark/js/signature_pad.js')}}"></script>
  <script src="{{asset('assets/admin/vendors/select2/select2.min.js')}}"></script>

  <script>
      let signaturePad;

      function kriteriaFunction(el,cek){
        if ($(cek).is(':checked')) {
            $(el).prop('disabled',false);
        } else {
            $(el).prop('disabled',true);
            if (!$(el).is('select')){
                $(el).val(null);
            } else {
                $(el).prop('selectedIndex',0);
            } 
        }
      }

    $(document).ready(function() {
      let dropdown = $("#selectDisposisi");
      dropdown.empty();
      $.getJSON(`${BASE_URL}/api/divisis`, function (result) {
        $.each(result.data, function (key, entry) {
          dropdown.append($('<option></option>').attr('value', entry.id).text(eval(`entry.divisi`)));
        });
      });

      $('body').on('shown.bs.modal', '.modal', function() {
        $(this).find('select').each(function() {
          var dropdownParent = $(document.body);
          if ($(this).parents('.modal.in:first').length !== 0)
            dropdownParent = $(this).parents('.modal.in:first');
          $(this).select2({
            dropdownParent: dropdownParent,
            // placeholder: "Pilih Divisi",
            theme: "classic",
          });
        });
      });

      $('#modalDisposisi').on('shown.bs.modal',function(e){
          let canvas = $("#signature-pad canvas");
          let parentWidth = $(canvas).parent().outerWidth();
          let parentHeight = $(canvas).parent().outerHeight();
          canvas.attr("width", parentWidth+'px')
                .attr("height", parentHeight+'px');
          signaturePad = new SignaturePad(canvas[0], {
              backgroundColor: 'rgb(255, 255, 255)'
          });
      })
      $('#modalDisposisi').on('hidden.bs.modal', function (e) {
          signaturePad.clear();
      });
      $(document).on('click','#modalDisposisi .clear',function(){
          signaturePad.clear();
      });

      $(document).on('click','#modalDisposisi .save',function(){
          if (signaturePad.isEmpty()) {
              alert("Please provide a signature first.");
          } else {
              let dataURL = signaturePad.toDataURL();
              $('.signature').attr('src',dataURL);
              $('textarea[name="signature"]').val(dataURL);
              $('#modalSurat').modal('hide');
          }
      });

      $.getJSON(`${BASE_URL}/api/valid/suratMasuks`, function (result) {
        $('#suratMasukCount').append(Object.keys(result.data).length);
      });

      $.getJSON(`${BASE_URL}/api/suratKeluars`, function (result) {
        $('#suratKeluarCount').append(Object.keys(result.data).length);
      });

      $.getJSON(`${BASE_URL}/api/users`, function (result) {
        $('#userCount').append(Object.keys(result.data).length);
      });

      $('#surat').DataTable( {
        "ajax": `${BASE_URL}/api/disposisi/suratMasuks`,
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
                        <button onClick="disposisiFunction('${data}')" type="button" class="btn btn-primary">
                          <i class="ti-user"></i> Disposisi
                        </button>
                      </div>`
            }
          }
        ],
        "order":[[0,"asc"]]   
      });
    });

    function disposisiFunction(id){
      $.ajax({
        url: `${BASE_URL}/api/suratMasuks/${id}`,
        method: 'get',
        success: function(result){
          $('#modalDisposisi').modal('show');
          $('#loader').hide();
          $('#id_surat').val(result.data.id);
        },
        error:    function(result){
          let errors = result.responseJSON;
          Toast.fire(errors.status, '', 'info')
        },
      });
    }

    $('#ajaxSubmit').on('submit', function(e){
      let id = $('#id_surat').val(); 
      e.preventDefault();
      Swal.fire({
            icon: 'info',
            title: `Apakah anda yakin dengan data yang anda masukkan ?`,
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Tidak`,
        }).then((result) => {
            if (result.isConfirmed) {
              var catatan = [];
              var checkboxes = document.querySelectorAll('input[name=catatan]:checked');
              var catatanTambahan = document.getElementById('catatanCek');
              
              for (var i = 0; i < checkboxes.length; i++) {
                catatan.push(checkboxes[i].value)
              }

              if (catatanTambahan.checked == true) {
                catatan.push($('#catatan').val())
              }

              let data = new FormData();
              let dataURL = signaturePad.toDataURL();
              data.append('divisi', $('#selectDisposisi').val());
              data.append('catatan'  , catatan);
              data.append('noted' , $('#catatanTambahan').val());
              data.append('id' , $('#id_surat').val());
              data.append('tanda_tangan' , `${dataURL}`);
              if (dataURL == "data:image/png;base64,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") {
                Toast.fire('Tanda Tangan Tidak Boleh Kosong', '', 'info')
              } else {
                $.ajax({
                  url: `${BASE_URL}/api/suratMasuks/${id}/disposisi`,
                  method: 'post',
                  data:data,
                  processData: false,
                  contentType: false,
                  beforeSend: function () {
                    $('#loader').show();
                  },
                  complete: function() {
                    $('#loader').hide();
                  },
                  success: function(result){
                    console.log(result);
                    $("#surat").DataTable().ajax.reload();
                    $('#closeModalDisposisi').trigger('click');  
                    Toast.fire(result.status, '', 'success')
                  },
                  error:    function(result){
                    let errors = result.responseJSON;
                        Toast.fire(errors.status, '', 'info')
                  },
                });
              }
            } else if (result.isDenied) {
                Toast.fire('Surat gagal didisposisikan', '', 'info')
            }
        })
    });

  </script>
@endpush