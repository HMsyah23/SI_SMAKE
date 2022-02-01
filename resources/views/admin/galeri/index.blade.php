@extends('admin.layouts.app')
@push('css')
    <style>
        img {
            width: 300px;
            height: 200px;
            object-fit: cover;
        }

        .img-container {
            position: relative;
            text-align: center;
            color: white;
        }

        .bottom-left {
            position: absolute;
            bottom: 8px;
            left: 16px;
        }

        .top-left {
            position: absolute;
            top: 8px;
            left: 16px;
        }

        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
        }

        .top-right i {
            font-size: 15px;
        }

        .bottom-right {
            position: absolute;
            bottom: 8px;
            right: 16px;
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Halaman Galeri</h3>
                    <h6 class="font-weight-normal mb-0"><a href="{{ route('dashboard') }}">Dashboard</a> / <i
                            class="ti-gallery"></i> Galeri</h6>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                data-target="#staticBackdrop" aria-haspopup="true" aria-expanded="true">
                                <i class="ti-plus"></i> Tambah Galeri
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Daftar Galeri</p>
                    <div id="daftarGaleri" class="list-group">
                        @forelse ($data['galeri'] as $gale)
                            <a href="{{ route('show.galeri', $gale->id) }}"
                                class="list-group-item list-group-item-action @if ($data['id']->id == $gale->id) active @endif">
                                <p class="mb-0">
                                    @if ($gale->tipe == 1)
                                        <i class="ti-image"></i>
                                    @else
                                        <i class="ti-video-clapper"></i>
                                    @endif
                                    <span id="galeri{{ $gale->id }}">{{ $gale->nama }}</span>
                                </p>
                            </a>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body" id="galeriFiles">
                    @if ($data['id']->tipe == 1)
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Foto <small
                                    class="text-muted" id="deskrip">{{ $data['id']->deskripsi }}</span>
                            </p>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button onClick="modalKeluarFunction('{{ $data['id']->id }}')" type="button"
                                    class="btn btn-warning btn-sm">
                                    <i class="ti-pencil"></i>
                                </button>
                                <button onClick="deleteGaleri('{{ $data['id']->id }}')" type="button"
                                    class="btn btn-danger btn-sm">
                                    <i class="ti-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxUpdateImage">
                                    @csrf
                                    <div class="d-flex justify-content-between mb-1">
                                        <button type="submit" class="btn btn-primary perbaruiFoto"><i
                                                class="ti-upload"></i> Unggah</button>
                                        <button type="button"
                                            class="btn btn-outline-primary btn-rounded btn-icon add_button">
                                            <i class="ti-plus"></i>
                                            </a>
                                    </div>
                                    <input hidden type="text" id="id_foto" value="{{ $data['id']->id ?? '' }}" />
                                    <div class="field_wrapper py-2 px-2 border rounded">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <input name="deskripsiFoto" type="text" class="form-control form-control-sm"
                                                    placeholder="Deskripsi Foto (Optional)">
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <input name="urlFoto" type="file"
                                                    class="form-control form-control-sm file-upload-info files"
                                                    placeholder="Upload Lampiran">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <p class="card-title">List Foto</p>
                        <div id="listFoto" class="row">
                            @forelse ($galeri as $foto)
                                <div class="col-lg-4 col-6 mb-5">
                                    <div class="card shadow">
                                        <div class="img-container">
                                            <img src="{{ asset($foto->url) }}" class="card-img-top rounded" alt="...">
                                            <div class="bottom-left">{{ $foto->deskripsi }}</div>
                                            <div class="top-right">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button onClick="fotoGaleriFunction('{{ $foto->id }}')"
                                                        type="button" class="btn btn-info btn-sm">
                                                        <i class="ti-eye"></i>
                                                    </button>
                                                    <button onClick="deleteFunction('{{ $foto->id }}')" type="button"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="card bg-light text-center">
                                        <div class="card-body">
                                            <p class="card-text"><i class="ti-image large"></i> Belum ada Foto yang
                                                diunggah</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    @else
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Video <small
                                    class="text-muted">{{ $data['id']->deskripsi }}</span></p>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button onClick="modalKeluarFunction('{{ $data['id']->id }}')" type="button"
                                    class="btn btn-warning btn-sm">
                                    <i class="ti-pencil"></i>
                                </button>
                                <button onClick="deleteGaleri('{{ $data['id']->id }}')" type="button"
                                    class="btn btn-danger btn-sm">
                                    <i class="ti-trash"></i>
                                </button>
                            </div>
                        </div>
                        <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxUpdateVideo">
                            @csrf
                            <div class="row">
                                <div class="col-lg-10 mb-2">
                                    <input required type="text" id="url_video" class="form-control form-control-sm"
                                        placeholder="Masukkan Url Video" value="{{ $galeri[0]->url ?? '' }}" />
                                    <input hidden type="text" id="id_video" value="{{ $data['id']->id ?? '' }}" />
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-block btn-primary btn-sm perbaruiVideo">
                                        <i class="ti-save"></i>
                                        Simpan
                                    </button>
                                </div>
                        </form>
                        <div id="videoThumbnail" class="col mt-2">
                            @if ($galeri->isEmpty())
                                <div class="card bg-light text-center">
                                    <div class="card-body">
                                        <p class="card-text"><i class="ti-youtube large"></i> Belum ada link yang
                                            diunggah</p>
                                    </div>
                                </div>
                            @else
                                <div class="embed-responsive embed-responsive-16by9 rounded">
                                    <iframe class="embed-responsive-item" src="{{ $galeri[0]->url }}"
                                        allowfullscreen></iframe>
                                </div>
                            @endif
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center mb-5"> Tambah Data <small class="text-primary"><i
                                class="ti-gallery"></i> Galeri</small></h4>
                    <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxSubmit">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama*</label>
                                <input required type="text" id="nama" class="form-control form-control-sm"
                                    placeholder="Masukkan Nama Galeri" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Tipe Galeri</label>
                                <select name="tipe" id="tipe" class="form-control form-control-sm">
                                    <option value="1">Foto</option>
                                    <option value="2">Video</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Deskripsi (Optional)</label>
                                <input id="deskripsi" type="text" class="form-control form-control-sm"
                                    placeholder="Masukkan Deskripsi Galeri" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary perbarui"><i class="ti-save"></i>
                                Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editGaleri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button id="closeModalEdit" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center mb-5"> Edit Data <small class="text-primary"><i
                                class="ti-gallery"></i> Galeri</small></h4>
                    <form class="form-sample" method="" enctype="multipart/form-data" id="ajaxUpdate">
                        @csrf
                        <div class="row">
                            <input type="hidden" id="idEdit">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama*</label>
                                <input required type="text" id="namaEdit" class="form-control form-control-sm"
                                    placeholder="Masukkan Nama Galeri" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Deskripsi (Optional)</label>
                                <input id="deskripsiEdit" type="text" class="form-control form-control-sm"
                                    placeholder="Masukkan Deskripsi Galeri" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary perbaruiEdit"><i class="ti-save"></i>
                                Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fotoGaleriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button id="closeModalEdit" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center mb-5 " id="titleGaleri"></h4>
                    <div class="row text-center">
                        <div class="col-12">
                            <img class="img-fluid" id="fotoGaleri" src="" alt="">
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
            let maxField = 10; //Input fields increment limitation
            let addButton = $('.add_button'); //Add button selector
            let wrapper = $('.field_wrapper'); //Input field wrapper
            let fieldHTML =
                `<div class="row mt-1 mb-1">
                    <div class="col-lg-6 col-12">
                        <input name="deskripsiFoto" type="text" class="form-control form-control-sm"
                            placeholder="Deskripsi Foto (Optional)">
                    </div>
                    <div class="col-lg-5 col-10">
                        <input name="urlFoto" type="file"
                        class="form-control form-control-sm file-upload-info files"
                            placeholder="Upload Lampiran">
                    </div>
                        <button type="button" class="btn btn-outline-danger btn-rounded btn-icon remove_button">
                            <i class="ti-minus"></i>
                        </button>
                </div>`; //New input field html 
            let x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

        $('#ajaxSubmit').on('submit', function(e) {
            e.preventDefault();
            let data = new FormData();
            data.append('nama', $('#nama').val());
            data.append('tipe', $('#tipe').val());
            data.append('deskripsi', $('#deskripsi').val());
            $.ajax({
                url: `${BASE_URL}/api/galeris`,
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
                success: function(result) {
                    Toast.fire({
                        title: result.status,
                        icon: 'success',
                    })
                    $('#closeModal').trigger('click');
                    $('#nama').val("");
                    $('#deskripsi').val("");
                    let url = '{{ route('show.galeri', ':id') }}';
                    url = url.replace(':id', result.data.id);
                    let iconData = '';
                    if (parseInt(result.data.tipe) == 1) {
                        iconData = '<i class="ti-image"></i>';
                    } else {
                        iconData = '<i class="ti-video-clapper"></i>';
                    }
                    $('#daftarGaleri').append(`
                        <a href="${url}"
                            class="list-group-item list-group-item-action">
                            <p class="mb-0"> ${iconData} ${result.data.nama}</p>
                        </a>
                    `);
                },
                error: function(result) {
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

        $('#ajaxUpdate').on('submit', function(e) {
            e.preventDefault();
            let data = new FormData();
            let id = $('#idEdit').val();
            data.append('nama', $('#namaEdit').val());
            data.append('deskripsi', $('#deskripsiEdit').val());
            data.append('_method', 'PUT');
            $.ajax({
                url: `${BASE_URL}/api/galeris/${id}`,
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.perbaruiEdit').html('<div class="spinner-border spinner-border-sm"></div> Perbarui')
                        .prop('disabled', true);
                },
                complete: function() {
                    $('.perbaruiEdit').html('<i class="ti-save"></i></div> Perbarui').prop('disabled', false);
                },
                success: function(result) {
                    Toast.fire({
                        title: result.status,
                        icon: 'success',
                    })
                    $('#closeModalEdit').trigger('click');
                    let nameGaleri = `#galeri${result.data.id}`
                    $(nameGaleri).text(result.data.nama);
                    $('#deskrip').text(result.data.deskripsi)
                },
                error: function(result) {
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
        $('#ajaxUpdateVideo').on('submit', function(e) {
            let id = "{{ $data['id']->id }}";
            e.preventDefault();
            let data = new FormData();
            data.append('galeri_id', $('#id_video').val());
            data.append('url', $('#url_video').val());
            data.append('_method', 'PUT');
            $.ajax({
                url: `${BASE_URL}/api/fileGaleris/${id}`,
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.perbaruiVideo').html(
                        '<div class="spinner-border spinner-border-sm"></div> Simpan').prop(
                        'disabled', true);
                },
                complete: function() {
                    $('.perbaruiVideo').html('<i class="ti-save"></i></div> Simpan').prop('disabled',
                        false);
                },
                success: function(result) {
                    $('#videoThumbnail').html(`
                    <div class="embed-responsive embed-responsive-16by9 rounded">
                        <iframe class="embed-responsive-item" src="${result.data.video.url}" allowfullscreen></iframe>
                    </div>
                `);
                    Toast.fire({
                        title: result.status,
                        icon: 'success',
                    })
                },
                error: function(result) {
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

        $('#ajaxUpdateImage').on('submit', function(e) {
            let id = "{{ $data['id']->id }}";
            e.preventDefault();
            let data = new FormData();
            data.append('galeri_id', $('#id_foto').val());
            $('form input[name=urlFoto]').each(function() {
                data.append('url[]', $(this).prop('files')[0]);
            });
            $('form input[name=deskripsiFoto]').each(function() {
                data.append('deskripsi[]', $(this).val());
            });
            data.append('_method', 'PUT');
            $.ajax({
                url: `${BASE_URL}/api/fileGaleris/${id}`,
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.perbaruiFoto').html(
                        '<div class="spinner-border spinner-border-sm"></div> Unggah').prop(
                        'disabled', true);
                },
                complete: function() {
                    $('.perbaruiFoto').html('<i class="ti-upload"></i></div> Unggah').prop('disabled',
                        false);
                },
                success: function(result) {
                    Toast.fire({
                        title: result.status,
                        icon: 'success',
                    })
                    $('.field_wrapper').html(`
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <input name="deskripsiFoto" type="text" class="form-control form-control-sm"
                                placeholder="Deskripsi Foto (Optional)">
                        </div>
                        <div class="col-lg-6 col-12">
                            <input name="urlFoto" type="file" class="form-control form-control-sm file-upload-info files"
                                placeholder="Upload Lampiran">
                        </div>
                    </div>`);
                    $('#listFoto').html('');
                    $.each(result.data, function(key, entry) {
                        let url = '{{ asset(':id') }}';
                        url = url.replace(':id', entry.url);
                        $('#listFoto').append(`
                            <div class="col-lg-4 col-6 mb-5">
                                <div class="card shadow">
                                    <div class="img-container">
                                        <img src="${url}" class="card-img-top rounded" alt="...">
                                        <div class="bottom-left">${entry.deskripsi}</div>
                                        <div class="top-right">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button onClick="fotoGaleriFunction('${entry.id}')" type="button"
                                                    class="btn btn-info btn-sm">
                                                    <i class="ti-eye"></i>
                                                </button>
                                                <button onClick="deleteFunction('${entry.id}')" type="button"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                },
                error: function(result) {
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


        function deleteFunction(id) {
            Swal.fire({
                icon: 'info',
                title: `Apakah Kamu Ingin Menghapus Foto Galeri Ini ?`,
                showDenyButton: true,
                confirmButtonText: 'Hapus',
                denyButtonText: `Jangan Hapus`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${BASE_URL}/api/fileGaleris/${id}`,
                        method: 'delete',
                        success: function(result) {
                            Toast.fire(result.data.status, '', 'success')
                            $('#listFoto').html('');
                            $.each(result.data.data, function(key, entry) {
                                let url = '{{ asset(':id') }}';
                                url = url.replace(':id', entry.url);
                                $('#listFoto').append(`
                                    <div class="col-lg-4 col-6 mb-5">
                                        <div class="card shadow">
                                            <div class="img-container">
                                                <img src="${url}" class="card-img-top rounded" alt="...">
                                                <div class="bottom-left">${entry.deskripsi}</div>
                                                <div class="top-right">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button onClick="fotoGaleriFunction('${entry.id}')" type="button"
                                                            class="btn btn-info btn-sm">
                                                            <i class="ti-eye"></i>
                                                        </button>
                                                        <button onClick="deleteFunction('${entry.id}')" type="button"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="ti-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            });
                            if (Object.keys(result.data.data).length === 0) {
                                $('#listFoto').append(`
                                    <div class="col-12">
                                        <div class="card bg-light text-center">
                                            <div class="card-body">
                                                <p class="card-text"><i class="ti-image large"></i> Belum ada Foto yang
                                                    diunggah</p>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            }
                        },
                        error: function(result) {
                            let errors = result.responseJSON;
                            Toast.fire(errors.status, '', 'info')
                        },
                    });
                } else if (result.isDenied) {
                    Toast.fire('Gagal Dihapus', '', 'info')
                }
            })
        }

        function deleteGaleri(id) {
            Swal.fire({
                icon: 'info',
                title: `Apakah Kamu Ingin Menghapus Galeri Ini ?`,
                showDenyButton: true,
                confirmButtonText: 'Hapus',
                denyButtonText: `Jangan Hapus`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${BASE_URL}/api/galeris/${id}`,
                        method: 'delete',
                        success: function(result) {
                            let url = '{{ route('show.galeri', ':id') }}';
                            url = url.replace(':id', result.data.id.id);
                            Toast.fire(result.data.status, '', 'success');
                            window.location.href = url;
                        },
                        error: function(result) {
                            let errors = result.responseJSON;
                            Toast.fire(errors.status, '', 'info')
                        },
                    });
                } else if (result.isDenied) {
                    Toast.fire('Gagal Dihapus', '', 'info')
                }
            })
        }

        function modalKeluarFunction(id) {
            $.ajax({
                url: `${BASE_URL}/api/galeris/${id}`,
                method: 'get',
                success: function(result) {
                    $('#editGaleri').modal('show');
                    $('#idEdit').val(result.data.id);
                    $('#namaEdit').val(result.data.nama);
                    $('#deskripsiEdit').val(result.data.deskripsi);
                },
                error: function(result) {
                    let errors = result.responseJSON;
                    Toast.fire(errors.status, '', 'info')
                },
            });
        }

        function fotoGaleriFunction(id) {
            $.ajax({
                url: `${BASE_URL}/api/fileGaleris/${id}`,
                method: 'get',
                success: function(result) {
                    $('#fotoGaleriModal').modal('show');
                    $('#fotoGaleri').attr('src',`${BASE_URL}/${result.data.url}`);
                    $('#titleGaleri').text(result.data.deskripsi);
                },
                error: function(result) {
                    let errors = result.responseJSON;
                    Toast.fire(errors.status, '', 'info')
                },
            });
        }
    </script>
@endpush
