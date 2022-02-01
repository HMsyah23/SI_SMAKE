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

        img {
            border-radius: 5px 5px 0 0;
        }

        .title-color {
            transition: 0.3s;
        }

        .title-color:hover {
            color: #62de15;
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
                        <h1 class="text-capitalize mb-5 text-lg">Berita</h1>

                        <ul class="list-inline breadcumb-nav">
                            <li class="list-inline-item"><a href="{{ route('home') }}" class="text-white">Beranda</a>
                            </li>
                            <li class="list-inline-item"><span class="text-white">/</span></li>
                            <li class="list-inline-item"><a href="{{ url('berita/main') }}"
                                    class="text-white-50">Berita</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section service-2">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-6">
                   <div class="section-title">
                       <h3>{{$tipe}} : <i>{{$parameter}}</i></h3>
                       <div class="divider my-4"></div>
                   </div>
               </div>
           </div>
            <div class="row">
                @forelse ($beritas as $berita)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="department-block mb-5">
                            <img src="{{ asset($berita->foto) }}" alt="" class="img-fluid w-100">
                            <div class="blog-item-meta pl-4 mb-2 mt-2">
                                <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i>
                                    {{ \Carbon\Carbon::parse($berita->created_at)->format('d F Y') }}</span>
                            </div>
                            <div class="content pt-2 pl-4 pb-3 pr-4">
                                <a href="/berita/{{ $berita->slug }}">
                                    <h4 class="mt-1 mb-1 title-color">{{ $berita->title }}</h4>
                                </a>
                                <p class="mb-4">{!! \Illuminate\Support\Str::words($berita->body, 10) !!}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 text-center">
                        <h2>Tidak Ada Berita</h2>
                        <div class="divider mx-auto my-4"></div>
                    </div>
                @endforelse
            </div>
            {{ $beritas->links('vendor.pagination.custom') }}
        </div>
    </section>
@endsection
