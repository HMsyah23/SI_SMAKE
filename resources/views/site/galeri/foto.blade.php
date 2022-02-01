@extends('site.layouts.app')

@push('css')
    <style>
        .card {
            transition: 0.3s;
        }

        .img-size {
            /* padding: 0;
                        margin: 0; */
            height: 450px;
            width: 700px;
            background-size: cover;
            overflow: hidden;
        }

        .modal-content {
            width: 700px;
            border: none;
        }

        .modal-body {
            padding: 0;
        }

        .text-green {
            color: #62de15;
            transition: 0.1s;
        }

        .carousel-control-prev-icon {
            width: 30px;
            height: 48px;
        }

        .carousel-control-next-icon {
            width: 30px;
            height: 48px;
        }

        @media (max-width: 767px) {

            .img-size {
                height: 450px;
                width: 100%;
                background-size: cover;
                overflow: hidden;
            }

            .modal-content {
                width: 100%;
                border: none;
            }

            .modal-body {
                padding: 0;
            }

            .backtop {
                z-index: 1;
            }
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
                        <h1 class="text-capitalize mb-5 text-lg">Foto</h1>

                        <ul class="list-inline breadcumb-nav">
                            <li class="list-inline-item"><a href="{{ route('home') }}" class="text-white">Beranda</a>
                            </li>
                            <li class="list-inline-item"><span class="text-white">/</span></li>
                            <li class="list-inline-item"><a href="{{ route('galeri.foto') }}"
                                    class="text-white-50">Foto</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section doctors">
        <div class="container">

            <div class="col-12 text-center  mb-5">
                <div class="btn-group btn-group-toggle " data-toggle="buttons">
                    <label class="btn active ">
                        <input type="radio" name="shuffle-filter" value="all" checked="checked" />Semua Foto
                    </label>
                    @foreach ($tags as $item)
                        <label class="btn ">
                            <input type="radio" name="shuffle-filter" value="{{ $item->id }}" />{{ $item->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            @forelse ($fotos as $item)
                <div class="col-lg-3 col-sm-6 col-md-6 mb-4 shuffle-item" data-groups="[
                    @foreach ($item->tags as $tag)
                        &quot;{{ $tag->id }}&quot;@if (!$loop->last),@endif
                    @endforeach ]">
                    <div type="button" class="position-relative card doctor-inner-box"
                        onclick="carouselFunction({{ $item->id }})">
                        <div class="doctor-profile">
                            <div class="doctor-img">
                                <img src="{{ url($item->files[0]->url ?? '') }}" alt="thumbnail-foto"
                                    class="img-fluid w-100">
                            </div>
                        </div>
                        <div class="content card-body ">
                            <h4 class="text-card"><a
                                    onclick="carouselFunction({{ $item->id }})">{{ $item->nama }}</a>
                            </h4>
                            <p>
                                @foreach ($item->tags as $tagging)
                                    {{ $tagging->name }}@if (!$loop->last),@endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <h4 class="text-center"> <i class="icofont-image"></i> Tidak Ada Foto </h4>
                </div>
            @endforelse
        </div>
        </div>
    </section>

    <!-- modal -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- carousel -->
                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                        <ol class='carousel-indicators' id="indicatorCarousel">
                        </ol>
                        <div class='carousel-inner' id="innerCarousel">

                        </div>
                        <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Previous</span>
                        </a>
                        <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Next</span>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
                    $('.text-card').addClass('text-green').css('cursor', 'pointer');
                },
                function() {
                    $(this).removeClass('shadow');
                    $('.text-card').removeClass('text-green').css('cursor', 'pointer');
                }
            );
        });

        function carouselFunction(id) {
            let indicatorCarousel = $("#indicatorCarousel");
            let innerCarousel = $("#innerCarousel");
            indicatorCarousel.empty();
            innerCarousel.empty();
            let i = 0;
            let active = '';
            const url = `${BASE_URL}/api/galeris/${id}`;
            $.getJSON(url, function(result) {
                console.log(result.data);
                // dropdown.append($('<option></option>').attr('value', ` `).text(placeholder));
                $.each(result.data, function(key, entry) {
                    if (i === 0) {
                        active = 'active';
                    } else {
                        active = '';
                    }
                    indicatorCarousel.append(`
                        <li data-target='#carouselExampleIndicators' data-slide-to='${i}' class='${active}'></li>
                    `);
                    if (entry.deskripsi == null) {
                        entry.deskripsi = '';
                    }
                    innerCarousel.append(`
                        <div class='carousel-item ${active} '>
                            <img class='img-size'
                                src='${entry.url}'
                                alt='${i} slide' />
                            <div class="carousel-caption d-md-block">
                                <h3 class="text-white">${entry.galeris.nama}</h3>
                                <p>${entry.deskripsi}</p>
                            </div>
                        </div>
                    `);
                    i++;
                });
            });
            $('#largeModal').modal('show');
        };
    </script>
@endpush
