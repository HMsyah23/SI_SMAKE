@extends('site.layouts.app')

@push('css')
    <style>
        .card {
            transition: 0.3s;
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

        /* Container needed to position the button. Adjust the width as needed */

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

    </style>
@endpush

@section('content')
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize mb-5 text-lg">Video</h1>

                        <ul class="list-inline breadcumb-nav">
                            <li class="list-inline-item"><a href="{{ route('home') }}" class="text-white">Beranda</a>
                            </li>
                            <li class="list-inline-item"><span class="text-white">/</span></li>
                            <li class="list-inline-item"><a href="{{ route('galeri.video') }}"
                                    class="text-white-50">Video</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section service-2">
        <div class="container">

            <div class="row">
                @forelse ($videos as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex align-items-stretch mb-5">
						<a class="video-btn" data-toggle="modal"
						data-src="{{ url($item->files[0]->url) }}" data-target="#myModal">
                        <div class="card galeri-block">
							<div class="card-img-wrap">
								<img class="card-img-top"
                                src="http://img.youtube.com/vi/{{ substr($item->files[0]->url, strpos($item->files[0]->url, 'embed/') + 6) }}/0.jpg" />
							</div>
                            <button type="button" class="btn btn-main-2 btn-round-full video-btn" data-toggle="modal"
                                data-src="{{ url($item->files[0]->url) }}" data-target="#myModal">
                                <i class="icofont-ui-play icofont-3x text-white"></i>
                            </button>
                            <h4 class="text-center pl-0 pt-2 pb-2">{{ $item->nama }}</h4>
                        </div>
					</a>
                    </div>
                @empty
                    <div class="col-12">
                        <h4 class="text-center"> <i class="icofont-video"></i> Tidak Ada Video </h4>
                    </div>
                @endforelse
            </div>
            {{ $videos->links('vendor.pagination.custom') }}
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
