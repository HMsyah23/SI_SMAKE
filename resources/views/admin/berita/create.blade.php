@extends('admin.layouts.app')

@push('css')
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Halaman Berita</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <i class="ti-announcement"></i> Berita / <i class="ti-plus"></i> Tambah Data</h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <a class="btn btn-sm btn-primary" href="{{route('berita')}}">
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
          <p class="card-title">Tambah Data Berita</p>
          <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label">Judul*</label>
                <input required type="text" id="title" class="form-control form-control-sm" placeholder="Masukkan Judul Berita"/>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Penulis*</label>
                <input required type="text" id="author" class="form-control form-control-sm" placeholder="Masukkan Nama Penulis"/>
              </div>
              <div class="col-md-12 mb-5">
                <label class="form-label">Berita*</label>
      					<div id="editor" style="min-height: 160px;"></div>
              </div>
              <div class="col-md-12 mt-5">
                  <div class="form-group">
                    <label>Kategori*</label>
                  <select required id="category" class="form-control form-control-lg" style="width: 100%"></select>
                  </div>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label>Tags*</label>
                <select required id="tags" class="form-control form-control-lg" style="width: 100%" multiple="multiple"></select>
                <small for="">*Gunakan " , " untuk memisahkan tags</small>
                </div>
            </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label>Foto Thumbnail Berita</label>
                  <input type="file" id="img" name="img" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input id="uploadimage" type="text" class="form-control form-control-sm file-upload-info" disabled placeholder="Upload Foto Berita">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                    </span>
                  </div>
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
          <h4 class="modal-title text-center mb-5"> Tambah Data <small class="text-primary"><i class="ti-announcement"></i> Berita</small></h4>
          
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $("#tags").select2({
      tags: true,
      placeholder: "Pilih Tags",
      theme: "classic",
      tokenSeparators: [',']
    })

    $("#category").select2({
      tags: true,
      placeholder: "Pilih Kategori",
      theme: "classic"
    })
    let quill = new Quill('#editor', {
			theme: 'snow',
      placeholder: 'Masukkan Keterangan Berita...',
			modules: {
				toolbar: [
					[{ header: [1, 2, 3, 4, 5, 6, false] }],
					[{ font: [] }],
					["bold", "italic"],
					["link", "blockquote", "code-block", "image"],
					[{ list: "ordered" }, { list: "bullet" }],
					[{ script: "sub" }, { script: "super" }],
					[{ color: [] }, { background: [] }],
				]
			},
		});
		quill.on('text-change', function(delta, oldDelta, source) {
			document.querySelector("input[name='content']").value = quill.root.innerHTML;
		});

    $(document).ready(function() {
      $('#loader').hide();
      let dropdown = $("#category");
        dropdown.empty();

        const url = `${BASE_URL}/api/categories`;
        $.getJSON(url, function (result) {
            $.each(result.data, function (key, entry) {
              dropdown.append($('<option></option>').attr('value', entry.id).text(eval(`entry.name`)));
            });
        });

        let dropTag = $("#tags");
        dropTag.empty();

        let urlTag = `${BASE_URL}/api/tags`;
        $.getJSON(urlTag, function (result) {
            $.each(result.data, function (key, entry) {
              dropTag.append($('<option></option>').attr('value', entry.id).text(eval(`entry.name`)));
            });
        });
    });
  
    $('#ajaxSubmit').on('submit', function(e){
      e.preventDefault();
        if(($('#category').val() != null) && ($('#tags').val() != null)){
          let data = new FormData();
          data.append('title'  , $('#title').val());
          data.append('body' , quill.editor.scroll.domNode.innerHTML);
          data.append('author' , $('#author').val());
          data.append('category', $('#category').val());
          data.append('tags', $('#tags').val());
          data.append('foto', $('#img').prop('files')[0]);
          $.ajax({
            url: `${BASE_URL}/api/beritas`,
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
        } else {
          Toast.fire({
            title: 'Terdapat parameter yang belum diisi',
            text: `Silahkan isi seluruh parameter terlebih dahulu`,
            icon: 'error',
          })
        }
      });
  </script>
@endpush