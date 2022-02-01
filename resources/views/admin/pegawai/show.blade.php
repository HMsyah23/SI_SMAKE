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
          <h3 class="font-weight-bold">Detail Berita  {{$berita->title}}</h3>
          <h6 class="font-weight-normal mb-0"><a href="{{route('dashboard')}}">Dashboard</a> / <a href="/admin/berita"> Berita</a> / <i class="ti-announcement"></i> {{$berita->title}}</h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
           <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
             <a class="btn btn-sm btn-primary" href="/admin/berita">
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
                    <tr colspan="2">
                      <img style="width:100px; height:100px;" src="{{ ($berita->foto != null) ? '/'.$berita->foto : asset('assets/admin/images/faces/face28.jpg') }}" class="mx-auto d-block rounded img-fluid photo">
                    </tr>
                    <tr>
                      <td class="pl-2">Judul</td>
                      <td><p class="mb-0"><span class="font-weight-bold title">{{$berita->title}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Link</td>
                      <td><p class="mb-0"><a href="{{ url('berita/' . $berita->slug) }}" target="_blank" class="font-weight-bold slug">{{ url('berita/' . $berita->slug) }}</a></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Penulis</td>
                      <td><p class="mb-0"><span class="font-weight-bold author">{{$berita->author}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Kategori</td>
                      <td><p class="mb-0"><span class="font-weight-bold categories">{{$berita->categories[0]->name}}</span></p></td>
                    </tr>
                    <tr>
                      <td class="pl-2">Tag</td>
                      <td><p class="mb-0">
                        <span class="font-weight-bold Tag">
                        @foreach ($berita->tags as $item)
                          <label for="" class="badge badge-primary">{{$item->name}}</label>
                        @endforeach
                        </span></p></td>
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
              <p class="card-title"><i class="ti-pencil"></i> Edit Data</p>
              <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
                @csrf
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Judul*</label>
                    <input required type="text" id="title" class="form-control form-control-sm" placeholder="Masukkan Judul Berita" value="{{$berita->title}}"/>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Penulis*</label>
                    <input required type="text" id="author" class="form-control form-control-sm" placeholder="Masukkan Nama Penulis"  value="{{$berita->author}}"/>
                  </div>
                  <div class="col-md-12 mb-5">
                    <label class="form-label">Berita*</label>
                    <div id="editor" style="min-height: 160px;">
                    {!! $berita->body !!}
                    </div>
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
                      <small for="">*Gunakan " , " untuk memisahkan kategori</small>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  
  <script>
    $(document).ready(function() {
      let category = @json($berita->categories);
      category = category[0]['id'];
      let dropdown = $("#category");
        dropdown.empty();

        const url = `${BASE_URL}/api/categories`;
        $.getJSON(url, function (result) {
            $.each(result.data, function (key, entry) {
                if (category == entry.id) {
                  dropdown.append($('<option></option>').attr('selected','selected').attr('value', entry.id).text(eval(`entry.name`)));
                } else {
                  dropdown.append($('<option></option>').attr('value', entry.id).text(eval(`entry.name`)));
                }
            });
        });

        let dropTag = $("#tags");
        dropTag.empty();
        let tags = @json($berita->tags);
        let tag = [];
        Object.keys(tags).forEach(function(key) {
          tag.push(tags[key]['id']);
        });

        let urlTag = `${BASE_URL}/api/tags`;
        $.getJSON(urlTag, function (result) {
            $.each(result.data, function (key, entry) {
              if (tag.includes(entry.id)) {
                  dropTag.append($('<option></option>').attr('selected','selected').attr('value', entry.id).text(eval(`entry.name`)));
                } else {
                  dropTag.append($('<option></option>').attr('value', entry.id).text(eval(`entry.name`)));
                }
            });
        });
      
        $("#tags").select2({
      tags: true,
      placeholder: "Pilih Tags",
      theme: "classic",
      tokenSeparators: [',']
    })

      $("#category").select2({
      tags: true,
      theme: "classic",
      tokenSeparators: [',']
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

      $('#loader').hide();
      let id = '{{$berita->id}}';  
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
          data.append('_method', 'PUT');
          $.ajax({
            url: `${BASE_URL}/api/beritas/${id}`,
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
                title: result.status,
                icon: 'success',
              })
              console.log(result); 
              $('.title').text(result.data.title);
              $('.slug').text(result.data.slug);
              $('.author').text(result.data.author);
              $('.categories').text(result.data.categories[0].name);
              $('.Tag').text("");
              result.data.tags.forEach(myFunction);
              function myFunction(item) {
                $('.Tag').append(`<label for="" class="badge badge-primary">${item.name}</label> `);
              }
              $('.photo').attr('src',`/${result.data.foto}`);
            },
            error: function(result){
              let errors = result.responseJSON;
              let myArray = errors.message;
              Toast.fire({
                title: 'Terjadi Kesalahan',
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
  </script>
@endpush