@extends('admin.layouts.app')

@push('css')
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Detail Profil  {{$profil->nama}}</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <a href="/admin/profil"> Profil</a> / <i class="ti-announcement"></i> {{$profil->nama}}</h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
           <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
             <a class="btn btn-sm btn-primary" href="/admin/profil">
              <i class="ti-arrow-left"></i> Kembali
             </a>
           </div>
          </div>
         </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 grid-margin">
      <div class="row">
        <div class="col-md-12 mb-5">
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
                    <tr>
                      <td class="pl-2">Judul</td>
                      <td><p class="mb-0"><span class="font-weight-bold nama">{{$profil->nama}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Slug</td>
                      <td><p class="mb-0"><span class="font-weight-bold slug">{{$profil->slug}}</span></p></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 stretch-card grid-margin">
      <div class="row">
        <div class="col-12 mb-5">
          <div class="card">
            <div class="card-body">
              <p class="card-nama"><i class="ti-pencil"></i> Edit Data</p>
              <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
                @csrf
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Nama Halaman</label>
                    <input required disabled type="text" id="nama" class="form-control form-control-sm" placeholder="Masukkan Judul Profil" value="{{$profil->nama}}"/>
                  </div>
                  <div class="col-md-12 mb-5">
                    <label class="form-label">Isi Halaman*</label>
                    <div id="editor" style="min-height: 160px;">
                    {!! $profil->body !!}
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end mt-5 pt-2">
                  <button disabled id="loader" class="btn btn-primary mr-2">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </button>
                  <button type="submit" class="btn btn-primary perbarui"><i class="ti-save"></i> Perbarui</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> 
  <script>
    $(document).ready(function() {
    let quill = new Quill('#editor', {
			theme: 'snow',
      placeholder: 'Masukkan Keterangan Halaman...',
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

      $('#loader').hide();
      let id = '{{$profil->id}}';  
      $('#ajaxSubmit').on('submit', function(e){
        e.preventDefault();
        if($('#editor').val() != null){
          let data = new FormData();
          data.append('nama'  , $('#nama').val());
          data.append('body' , quill.editor.scroll.domNode.innerHTML);
          data.append('_method', 'PUT');
          $.ajax({
            url: `${BASE_URL}/api/profils/${id}`,
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
              Toast.fire({
                nama: result.status,
                icon: 'success',
              })
              console.log(result); 
              $('.nama').text(result.data.nama);
              $('.slug').text(result.data.slug);
            },
            error: function(result){
              let errors = result.responseJSON;
              let myArray = errors.message;
              Toast.fire({
                nama: 'Terjadi Kesalahan',
                text: `${errors.message}`,
                icon: 'error',
              })
              console.log(result);
            },
          });
        } else {
          Toast.fire({
            nama: 'Terdapat parameter yang belum diisi',
            text: `Silahkan isi seluruh parameter terlebih dahulu`,
            icon: 'error',
          })
        }
      });

    });
  </script>
@endpush