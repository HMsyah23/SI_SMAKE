@extends('admin.layouts.app')

@push('css')
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
@endpush

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Halaman Pegawai</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <i class="ti-announcement"></i> Pegawai / <i class="ti-plus"></i> Tambah Data</h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <a class="btn btn-sm btn-primary" href="{{route('pegawai')}}">
                <i class="ti-arrow-left"></i> Kembali
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
          <p class="card-title">Tambah Data Pegawai</p>
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
            @csrf
            <div class="row">
              <div class="col-md-2 mb-3">
                <label class="form-label">Gelar Depan</label>
                <input type="text" id="gelar_depan" class="form-control form-control-sm" placeholder="Masukkan Gelar Depan"/>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Nama Depan*</label>
                <input required type="text" id="nama_depan" class="form-control form-control-sm" placeholder="Masukkan Nama Depan"/>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Nama Belakang</label>
                <input type="text" id="nama_belakang" class="form-control form-control-sm" placeholder="Masukkan Nama Belakang"/>
              </div>
              <div class="col-md-2 mb-3">
                <label class="form-label">Gelar Belakang</label>
                <input type="text" id="gelar_belakang" class="form-control form-control-sm" placeholder="Masukkan Gelar Belakang"/>
              </div>
              <div class="col-md-2 mb-3">
                <label class="form-label">Status*</label>
                <select required id="status" class="form-control form-control-sm" style="width: 100%">
                  <option value="1">Pegawai Tetap</option>
                  <option value="2">Tenaga Kontrak</option>
                </select>
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-label">NIP</label>
                <input type="text" id="nip" class="form-control form-control-sm" placeholder="Masukkan NIP" maxlength="18"/>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                    <label>Pangkat</label>
                  <select required id="pangkat" class="form-control" style="width:100%;"></select>
                  </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Eselon</label>
                <select required id="eselon" class="form-control" style="width:100%;"></select>
                </div>
            </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Jabatan*</label>
                <select required id="jabatan" class="form-control" style="width:100%;"></select>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Sub Bidang*</label>
              <select required id="divisi" class="form-control" style="width:100%;"></select>
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Email</label>
              <input type="email" id="email" class="form-control form-control-sm" placeholder="Masukkan Email"/>
            </div>
        </div>
            
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label>Foto Pegawai</label>
                  <input type="file" id="picture" class="form-control form-control-sm"/>
                  <small for="">*Foto Harus Memiliki Format .jpg/jpeg/png</small> <br>
                  <small for="">*Ukuran foto maksimal 2048Kb / 2Mb</small>
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
  </div>
</div>

    <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center mb-5"> Tambah Data <small class="text-primary"><i class="ti-announcement"></i> Pegawai</small></h4>
          
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#loader').hide();
      selectBox("#pangkat","pangkats",`entry.name`,'Pilih Pangkat');
      selectBox("#eselon","eselons",`entry.name`,'Pilih Eselon');
      selectBox("#jabatan","jabatans",`entry.jabatan`,'Pilih Jabatan');
      selectBox("#divisi","divisis",`entry.divisi`,'Pilih Sub Bagian');
    });

    function selectBox(id,api,column,placeholder){
      let dropdown = $(id);
        // dropdown.empty();

        const url = `${BASE_URL}/api/${api}`;
        $.getJSON(url, function (result) {
            dropdown.append($('<option></option>').attr('value', ` `).text(placeholder));
            $.each(result.data, function (key, entry) {
              dropdown.append($('<option></option>').attr('value', entry.id).text(eval(`${column}`)));
            });
        });
        $(id).select2({
          theme: "bootstrap",
          placeholder: function(){
            $(this).data('placeholder');
        }
        })
    }
  
    $('#ajaxSubmit').on('submit', function(e){
      e.preventDefault();
          let data = new FormData();
          data.append('gelar_depan'  , $('#gelar_depan').val());
          data.append('nama_depan' , $('#nama_depan').val());
          data.append('nama_belakang' , $('#nama_belakang').val());
          data.append('gelar_belakang'  , $('#gelar_belakang').val());
          data.append('status'  , $('#status').val());
          data.append('nip'  , $('#nip').val());
          data.append('pangkat', $('#pangkat').val());
          data.append('eselon', $('#eselon').val());
          data.append('jabatan', $('#jabatan').val());
          data.append('divisi', $('#divisi').val());
          data.append('email', $('#email').val());
          data.append('picture', $('#picture').prop('files')[0]);
          $.ajax({
            url: `${BASE_URL}/api/pegawais`,
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
              console.log(result);
              $("#surat").DataTable().ajax.reload();
              Swal.fire({
                title: result.status,
                icon: 'success',
              })
              setInterval( function () {
                location.reload();
              }, 1000 );
              $('#title').val("");
              $('#category').val("");
              $('#tags').val("");
              $('#editor').val("");
              $('#author').val("");
              $('#foto').val("");
            },
            error: function(result){
              console.log(result);
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