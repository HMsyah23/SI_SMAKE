@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Selamat Datang, {{ Auth::user()->nama ?? '' }} </h3>
          <h6 class="font-weight-normal mb-0">Sistem Surat Masuk & Surat Keluar<strong class="text-primary"> UPTD Tahura Bukit Soeharto</strong></h6>
        </div>
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
                      <td class="pl-2">Divisi</td>
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
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-1">
            <p class="card-title"><i class="ti-email"></i> Surat Masuk </p>
            <div class="btn-group" role="group" aria-label="Basic example">
              <button class="btn btn-sm btn-secondary" id="refreshSuratMasuk" type="button">
                <div class="rotate">
                    <i class="ti-reload"></i>
                </div>
              </button>
            </div>
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
                      <th>Tanggal Surat</th>
                      <th>Tanggal Terima</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-1">
            <p class="card-title"><i class="ti-email"></i> Surat Keluar</p>
             <div class="btn-group" role="group" aria-label="Basic example">
              <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#staticBackdrop" aria-haspopup="true" aria-expanded="true">
                <i class="ti-upload"></i> Upload Berkas Surat Keluar
               </button>
               <button class="btn btn-sm btn-secondary" id="refreshSuratKeluar" type="button">
                 <div class="rotate">
                    <i class="ti-reload"></i>
                 </div>
               </button>
            </div>
           </div>
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
                  <td scope="col"><strong id="sifat" ></strong></td>
                </tr>
                {{-- <tr>
                  <th class="table-light" scope="col">Tipe</th>
                  <td scope="col" id="tipe">
                  </td>
                </tr> --}}
              <tr>
                <th class="table-light" scope="col">Perihal</th>
                  <td style="word-wrap: break-word;min-width: 10px; max-width: 10px; white-space:normal;" id="perihal" >
                      
                  </td>
              </tr>
              <tr>
                <th class="table-light" scope="col">Lembar Disposisi</th>
                  <td>
                    <a id="lembar_disposisi" href="" target="_blank" class="btn btn-sm btn-primary"><i class="ti-email"></i> Lembar Disposisi</a>
                  </td>
              </tr>
              <tr>
                <th class="table-light" scope="col">File Surat</th>
                  <td>
                    <a id="file_surats" href="" target="_blank" class="btn btn-sm btn-primary"><i class="ti-email"></i> Dokumen</a>
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
                  <td scope="col"><strong id="tujuans" ></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Perihal</td>
                  <td scope="col"><strong id="peri"></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Status</th>
                  <td scope="col"><strong id="tanggalValidasi"></strong></td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">File Surat</td>
                    <td>
                      <a id="file_surat_keluar" href="" target="_blank" class="btn btn-sm btn-primary"><i class="ti-email"></i> Dokumen</a>
                    </td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Lampiran</th>
                  <td scope="col">
                    <strong id="lampir" class="row pr-5"></strong>
                  </td>
                </tr>
                <tr>
                  <th class="table-light" scope="col">Tanggal Dibuat</td>
                    <td scope="col"><strong id="tanggalDibuat"></strong></td>
                </tr>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" id="closeModalSuratKeluar" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Tambah Data <small class="text-primary"><i class="ti-email"></i> Surat Keluar</small></h4>
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Tujuan surat</label>
                <input required type="text" id="tujuan" class="form-control form-control-sm" placeholder="Masukkan Asal Surat"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Perihal</label>
                <textarea required class="form-control form-control-sm" id="perihalss" placeholder="Masukkan Perihal Surat Keluar" rows="4"></textarea>
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
                     </a>
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

  <div class="modal fade" id="staticUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" id="closeModalUpdate" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Perbarui Data <small class="text-primary"><i class="ti-email"></i> Surat Keluar</small></h4>
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxUpdate">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Tujuan surat</label>
                <input required type="text" id="updateTujuan" class="form-control form-control-sm" placeholder="Masukkan Asal Surat"/>
                <input required type="hidden" id="updateId" class="form-control form-control-sm" placeholder="Masukkan Asal Surat"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Perihal</label>
                <textarea required class="form-control form-control-sm" id="updatePerihalss" placeholder="Masukkan Perihal Surat Keluar" rows="4"></textarea>
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

      let divisi = '{{ Auth::user()->divisi->id }}';
      $(document).ready(function() {
      $('#surat').DataTable( {
        "ajax": `${BASE_URL}/api/suratMasuks/${divisi}/divisi`,
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
                        <button onClick="modalFunction('${data}')" type="button" class="btn btn-info">
                          <i class="ti-eye"></i>
                        </button>
                        <a href="/admin/suratMasuks/${row.id}/terbaca" target="_blank" class="btn btn-warning">
                          <i class="ti-email"></i>
                        </a>
                      </div>`
            }
          }
        ],
        "order":[[0,"asc"]]   
      });

      $('#suratKeluar').DataTable( {
        "ajax": `${BASE_URL}/api/suratKeluars/${divisi}/divisi`,
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
              if (row.isValid == 0) {
                return '<div class="badge badge-outline-danger">Belum diberikan</div>';
              }
                return `<div class="badge badge-outline-success">${row.nomor_surat}</div>`;
            },
          },
          { "data": "tujuan_surat" },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              if (row.isValid == 0) {
                return `<div class="badge badge-danger">Belum divalidasi</div>`
              }
                return `<div class="badge badge-success">Telah divalidasi</div>`
            }
          },
          { 
            "data": "id",
            "render": function ( data, type, row, meta ) {
              let button = ``;
              if (row.nomor_surat == `null`) {
                button = `
                <button onClick="editFunction('${data}')" type="button" class="btn btn-warning">
                  <i class="ti-pencil"></i>
                </button>
                <button onClick="deleteFunction('${data}')" type="button" class="btn btn-danger">
                  <i class="ti-trash"></i>
                </button>
                `;
              } else {
                button = `
                <button disabled type="button" class="btn btn-secondary">
                  <i class="ti-pencil"></i>
                </button>
                <button disabled type="button" class="btn btn-secondary">
                  <i class="ti-trash"></i>
                </button>
                `;
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
      
      setInterval( function () {
        $("#surat").DataTable().ajax.reload();
      }, 500000 );

    } );
    });

    function modalFunction(id){
      $.ajax({
        url: `${BASE_URL}/api/suratMasuks/${id}`,
        method: 'get',
        success: function(result){
          $('#modalSurat').modal('show');
          console.log(result);
          $('#loader').hide();
          $('#dari').text(result.data.asal_surat);
          $('#id_surat').val(result.data.id);
          $('#terima').text(result.data.tanggal_terima);
          $('#tanggal').text(result.data.tanggal_surat);
          $('#no').text(result.data.no_agenda);
          $('#no_surat').text(result.data.nomor_surat);
          $('#sifat').text(result.data.sifat);
          // $('#tipe').text(result.data.tipe);
          $('#perihal').text(result.data.perihal);
          $('#file_surats').attr('href',`/admin/suratMasuks/${result.data.id}/terbaca`);
          $('#lembar_disposisi').attr('href',`${BASE_URL}/admin/lembarDisposisi/${result.data.id}`);
        },
        error:    function(result){
          let errors = result.responseJSON;
          Toast.fire(errors.status, '', 'info')
        },
      });
    }

    function modalKeluarFunction(id){
      $.ajax({
        url: `${BASE_URL}/api/suratKeluars/${id}`,
        method: 'get',
        success: function(result){
          $('#modalSuratKeluar').modal('show');
          $('#loader').hide();
          $('#no_kel').text(``);
          $('#divis').text(result.data.divisi.divisi);
          $('#tujuans').text(result.data.tujuan_surat);
          $('#peri').text(result.data.perihal);
          $('#stat').text(``);
          $('#lampir').text(``);
          $('#tanggalDibuat').text(result.data.created_at);
          let validasi = '';
          if (result.data.isValid) {
            validasi = "Telah Divalidasi |";
          }
          $('#tanggalValidasi').text(`${validasi} ${result.data.tanggal_validasi}`);
          if (result.data.nomor_surat == `null`) {
            $('#no_kel').append(`<div class="badge badge-outline-danger">Belum Diberikan</div>`);
            $('#stat').append(`<div class="badge badge-danger">Belum Divalidasi</div>`);
          } else {
            $('#no_kel').text(result.data.nomor_surat);
            $('#stat').append(`<div class="badge badge-success">Telah Divalidasi</div>`);
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

    $('#ajaxSubmit').on('submit', function(e){
      e.preventDefault();
      let data = new FormData();
      let divisi = '{{ Auth::user()->divisi->id }}';
      var lampiran = [];
      data.append('nomor_surat', null);
      data.append('tujuan_surat', $('#tujuan').val());
      data.append('perihal' , $('#perihalss').val());
      data.append('divisi_id' , divisi);
      data.append('isValid' , 0);
      $('form input[name=lampiran]').each(function(){
        data.append('lampiran[]' ,$(this).prop('files')[0]);
      });
      data.append('file', $('#file_surat').prop('files')[0]);
      $.ajax({
        url: `${BASE_URL}/api/suratKeluars`,
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
          $("#suratKeluar").DataTable().ajax.reload();
          Toast.fire({
            title: result.status,
            icon: 'success',
          })
          $('#closeModalSuratKeluar').trigger('click');  
          $('#tujuan').val("");
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

    $('#ajaxUpdate').on('submit', function(e){
      e.preventDefault();
      let data = new FormData();
      let id = $('#updateId').val();
      data.append('tujuan_surat', $('#updateTujuan').val());
      data.append('perihal' , $('#updatePerihalss').val());
      data.append('_method', 'PUT');
      $.ajax({
        url: `${BASE_URL}/api/suratKeluars/${id}`,
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
          $("#suratKeluar").DataTable().ajax.reload();
          Toast.fire({
            title: result.status,
            icon: 'success',
          })
          $('#closeModalUpdate').trigger('click'); 
        },
        error: function(result){
          let errors = result.responseJSON;
          let myArray = errors.message;
          Toast.fire({
            title: 'Terjadi Kesalahan',
            text: `${errors.message}`,
            icon: 'error',
          })
        },
      });
    });

    $( "#staticBackdrop" ).on( "hidden.bs.modal", function() {
      $('#uploadFile').removeClass('is-invalid');
      $('.file_surat').text('');
    });

    function editFunction(id){
      $.ajax({
        url: `${BASE_URL}/api/suratKeluars/${id}`,
        method: 'get',
        success: function(result){
          $('#staticUpdate').modal('show');
          $('#updateId').val(result.data.id);
          $('#updateTujuan').val(result.data.tujuan_surat);
          $('#updatePerihalss').val(result.data.perihal);
        },
        error:    function(result){
          let errors = result.responseJSON;
          Toast.fire(errors.status, '', 'info')
        },
      });
    }

    function deleteFunction(id){
        Swal.fire({
            icon: 'info',
            title: `Apakah Kamu Ingin Menghapus Data Surat Ini ?`,
            showDenyButton: true,
            confirmButtonText: 'Hapus',
            denyButtonText: `Jangan Hapus`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                  url: `${BASE_URL}/api/suratKeluars/${id}`,
                  method: 'delete',
                  success: function(result){
                    $("#suratKeluar").DataTable().ajax.reload();
                    Toast.fire(result.data.status, '', 'success')
                  },
                  error:    function(result){
                    let errors = result.responseJSON;
                        Toast.fire(errors.status, '', 'info')
                  },
                });
            } else if (result.isDenied) {
                Toast.fire('Gagal Dihapus', '', 'error')
            }
        })
    }

    $("#refreshSuratKeluar").click(function(){
      $('#refreshSuratKeluar').find(".rotate").toggleClass("down");
      Toast.fire({
            title: "Data Surat Keluar Disegarkan",
            icon: 'info',
          })
      $("#suratKeluar").DataTable().ajax.reload();
    });

    $("#refreshSuratMasuk").click(function(){
      $('#refreshSuratMasuk').find(".rotate").toggleClass("down");
      Toast.fire({
            title: "Data Surat Masuk Disegarkan",
            icon: 'info',
          })
      $("#surat").DataTable().ajax.reload();
    });
    
  </script>
@endpush