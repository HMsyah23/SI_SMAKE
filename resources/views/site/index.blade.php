@extends('site.layouts.app')

@push('css')
    <style>
        .department-block {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 5px;
        }

        .department-block:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .department-block img {
            border-radius: 5px 5px 0 0;
        }

        .title-color {
            transition: 0.3s;
        }

        .title-color:hover {
            color: #62de15;
        }

        a span,
        a p {
            transition: 0.3s;
        }

        a:hover span {
            color: #62de15;
        }

        a:hover p {
            color: #62de15;
            transition: font-size 0.3s;
            font-size: 18px;
        }

        .modal-dialog {
            max-width: 800px;
            margin: 30px auto;
        }



        .modal-body {
            position: relative;
            padding: 0px;
        }

        .close {
            position: absolute;
            right: -30px;
            top: 0;
            z-index: 999;
            font-size: 2rem;
            font-weight: normal;
            color: #fff;
            opacity: 1;
        }

        .galeri-block {
            min-height: 100%;
            display: flex;
            align-items: stretch;
        }


        /* Make the image responsive */
        .galeri-block img {
            width: 100%;
            height: auto;
        }

        /* Style the button and place it in the middle of the container/image */
        .galeri-block .btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .custom-shape-divider-top-1640360267 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.custom-shape-divider-top-1640360267 svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 79px;
}

.custom-shape-divider-top-1640360267 .shape-fill {
    fill: #FFFFFF;
}

.custom-shape-divider-bottom-1640360330 {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.custom-shape-divider-bottom-1640360330 svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 79px;
}

.custom-shape-divider-bottom-1640360330 .shape-fill {
    fill: #FFFFFF;
}

    </style>
@endpush

@section('content')
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-xl-7">
                    <div class="block">
                        <div class="divider mb-3"></div>
                        <span class="text-uppercase text-sm letter-spacing ">Unit Pelaksana Teknis Daerah</span>
                        <h1 class="mb-3 mt-3">Tahura Bukit Soeharto</h1>

                        <p class="mb-4 pr-5">Unit Pelayanan Khusus yang bertugas untuk menjaga keamanan Taman Hutan Raya
                            Bukit Soeharto</p>
                        {{-- <div class="btn-container ">
							<a href="appoinment.html" target="_blank" class="btn btn-main-2 btn-icon btn-round-full">Make appoinment <i class="icofont-simple-right ml-2  "></i></a>
						</div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-shape-divider-bottom-1640360330">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>
    {{-- <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-block d-lg-flex">
                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-attachment"></i>
                            </div>
                            <span>Form Laporan</span>
                            <h4 class="mb-3">Laporan Online</h4>
                            <p class="mb-4">Laporkan jika anda menemukan tindak kejahatan ataupun kejanggalan</p>
                            <a href="appoinment.html" class="btn btn-main btn-round-full">Lapor</a>
                        </div>

                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-ui-clock"></i>
                            </div>
                            <span>Jam Kerja</span>
                            <h4 class="mb-3">Working Hours</h4>
                            <ul class="w-hours list-unstyled">
                                <li class="d-flex justify-content-between">Sun - Wed : <span>8:00 - 17:00</span></li>
                                <li class="d-flex justify-content-between">Thu - Fri : <span>9:00 - 17:00</span></li>
                                <li class="d-flex justify-content-between">Sat - sun : <span>10:00 - 17:00</span></li>
                            </ul>
                        </div>

                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-support"></i>
                            </div>
                            <span>Delik Aduan</span>
                            <h4 class="mb-3">1-800-700-6200</h4>
                            <p>Laporkan jika anda menemukan tindak kejahatan ataupun kejanggalan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    
    <section class="section about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="about-img">
                        <img src="{{ asset('assets/images/about/img-1.jpg') }}" alt="" class="img-fluid">
                        <img src="{{ asset('assets/images/about/img-2.jpg') }}" alt="" class="img-fluid mt-4">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="about-img mt-4 mt-lg-0">
                        <img src="{{ asset('assets/images/about/img-3.jpg') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-content pl-4 mt-4 mt-lg-0">
                        <h2 class="title-color">Tetap Teguh <br>Menjaga Lestari Ibu Pertiwi</h2>
                        <a href="{{ route('profil.slug', 'tentang') }}"
                            class="btn btn-main-2 btn-round-full btn-icon">Profil<i
                                class="icofont-simple-right ml-3"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-section ">
        <div class="container">
            <div class="cta position-relative">
                <div class="row">
                    {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-doctor"></i>
                            <span class="h3">58</span>
                            <p>Happy People</p>
                        </div>
                    </div> --}}
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-tree"></i>
                            <span class="h3">{{ $tanah }}</span>+
                            <p>Hektar Tanah</p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <a href="{{ route('daftar.pegawai') }}">
                                <i class="icofont-user"></i>
                                <span class="h3">{{ $pegawai }}</span>
                                <p>Pegawai</p>
                            </a>
                        </div>
                    </div>

                    {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-globe"></i>
                            <span class="h3">4</span>
                            <p>Divisi</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <section class="section service gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <h2>Berita Terbaru</h2>
                        <div class="divider mx-auto"></div>
                        {{-- <p>Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.</p> --}}
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($new_beritas as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex align-items-stretch ">
                        <div class="department-block bg-white mb-5">
                            <div class="card-img-wrap">
                                <img src="{{ asset($item->foto) }}" alt="" class="img-fluid w-100">
                            </div>
                            <div class="blog-item-meta pl-4 mb-2 mt-2">
                                <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i>
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</span>
                            </div>
                            <div class="content pt-2 pl-4 pb-3 pr-4">
                                <a href="/berita/{{ $item->slug }}">
                                    <h4 class="mt-1 mb-1 title-color">{{ $item->title }}</h4>
                                </a>
                                <p class="mb-4">{!! \Illuminate\Support\Str::words($item->body, 10) !!}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <h2>Tidak Ada Berita</h2>
                    </div>
                @endforelse
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <a class="btn btn-main-2 btn-round-full" href="{{ url('berita/main') }}">
                        Tampilkan Semua
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section service">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <h2>Video</h2>
                        <div class="divider mx-auto"></div>
                        {{-- <p>Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.</p> --}}
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($new_videos as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex align-items-stretch mb-5">
                        <a class="video-btn" data-toggle="modal" data-src="{{ url($item->files[0]->url) }}"
                            data-target="#myModal">
                            <div class="card galeri-block">
                                <div class="card-img-wrap">
                                    <img class="card-img-top"
                                        src="http://img.youtube.com/vi/{{ substr($item->files[0]->url, strpos($item->files[0]->url, 'embed/') + 6) }}/0.jpg" />
                                </div>
                                <button type="button" class="btn btn-main-2 btn-round-full video-btn" data-toggle="modal"
                                    data-src="{{ url($item->files[0]->url) }}" data-target="#myModal">
                                    <i class="icofont-ui-play icofont-3x text-white"></i>
                                </button>
                                <div class="card-body">
                                    <h4 class="text-center pl-0">{{ $item->nama }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <h2>Tidak Ada Video</h2>
                    </div>
                @endforelse
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <a class="btn btn-main-2 btn-round-full" href="{{ route('galeri.video') }}">
                        Tampilkan Semua
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="padding-bottom: 0px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Peta Wilayah <br> Kawasan Tahura Bukit Soeharto</h2>
                        <div class="divider mx-auto my-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="google-map ">
            {{-- <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1_wHLg6fneGpzdlSGAJkdWMJl4htDWmqA&ehbc=2E312F"
                frameborder="0" style="overflow:hidden;height:480px;width:100%" height="100%" width="100%"></iframe> --}}
            <img src="https://www.forclime.org/images/peta-bukit-soeharto.jpg" alt="" class="img-fluid">
        </div>
    </section>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <section class="section clients">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <h2>Partners Kami</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p>Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt
                            molestias nostrum laudantium. Maiores porro cumque quaerat.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row clients-logo">
                <div class="col-lg-2"></div>
                <div class="col-lg-3"></div>
                <div class="col-lg-2">
                    <div class="client-thumb">
                        <img src="{{ asset('assets/images/about/1.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(".card").hover(
                function() {
                    $(this).addClass('shadow').css('cursor', 'pointer');
                },
                function() {
                    $(this).removeClass('shadow');
                }
            );
            let $videoSrc;
            $('.video-btn').click(function() {
                $videoSrc = $(this).data("src");
            });
            console.log($videoSrc);
            $('#myModal').on('shown.bs.modal', function(e) {
                $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
            })
            $('#myModal').on('hide.bs.modal', function(e) {
                // a poor man's stop video
                $("#video").attr('src', $videoSrc);
            })
        });
    </script>
@endpush
