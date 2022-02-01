@extends('site.layouts.app')

@section('content')
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h2 class="text-capitalize text-white">Berita</h2>
                        <h3 class="text-capitalize text-white">{{ $berita->title }}</h3>

                        <ul class="list-inline breadcumb-nav">
                            <li class="list-inline-item"><a href="{{ route('home') }}" class="text-white">Beranda</a>
                            </li>
                            <li class="list-inline-item"><span class="text-white">/</span></li>
                            <li class="list-inline-item"><a href="{{ url('berita/main') }}"
                                    class="text-white-50">Berita</a></li>
                            <li class="list-inline-item"><span class="text-white">/</span></li>
                            <li class="list-inline-item"><a href="{{ url('berita/' . $berita->slug) }}"
                                    class="text-white-50">{{ $berita->title }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section service-2">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12 mb-5">
                                <div class="single-blog-item">
                                    <img src="{{ asset($berita->foto) }}" alt="" class="img-fluid">

                                    <div class="blog-item-content mt-5">
                                        <div class="blog-item-meta mb-3">
                                            <span class="text-color-2 text-capitalize mr-3"><i
                                                    class="icofont-book-mark mr-2"></i>{{ $berita->categories[0]->name }}</span>
                                            <span class="text-black text-capitalize mr-3"><i
                                                    class="icofont-calendar mr-2"></i>{{ \Carbon\Carbon::parse($berita->created_at)->format('d F Y') }}</span>
                                        </div>

                                        <h2 class="mb-4 text-md"><a
                                                href="{{ url('berita/' . $berita->slug) }}">{{ $berita->title }}</a>
                                        </h2>

                                        <div>
                                            {!! $berita->body !!}
                                        </div>

                                        <div class="mt-5 clearfix">
                                            <ul class="float-left list-inline tag-option">
                                                @foreach ($berita->tags as $item)
                                                    <li class="list-inline-item"><a href="#">{{ $item->name }}</a></li>
                                                @endforeach
                                            </ul>

                                            <ul class="float-right list-inline">
                                                <li class="list-inline-item"> Share: </li>
                                                <li class="list-inline-item"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url('berita/'. $berita->slug) }}" target="_blank" target="_blank"><i
                                                            class="icofont-facebook" aria-hidden="true"></i></a></li>
                                                <li class="list-inline-item"><a class="twitter-share-button"
																									href="https://twitter.com/intent/tweet" target="_blank"><i
                                                            class="icofont-twitter" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                            <div class="sidebar-widget search  mb-3 ">
                                <h5>Pencarian</h5>
                                <form action="{{ route('berita.pencarian') }}" method="post" class="search-form">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="Cari " aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                          <button class="btn btn-main-2" type="submit"><i class="icofont-search"></i></button>
                                        </div>
                                      </div>
                                </form>
                            </div>


                            <div class="sidebar-widget latest-post mb-3">
                                <h5>Berita Terbaru</h5>
                                @foreach ($new_beritas as $item)
                                    <div class="py-2">
                                        <span class="text-sm text-muted"><i class="icofont-calendar mr-2"></i>
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                        <h6 class="my-2"><a
                                                href="{{ url('berita/' . $item->slug) }}">{{ $item->title }}</a></h6>
                                    </div>
                                @endforeach
                            </div>

                            <div class="sidebar-widget category mb-3">
                                <h5 class="mb-4">Kategori</h5>
                                <ul class="list-unstyled">
                                    @forelse ($categories as $category)
                                        <li class="align-items-center">
                                            <a href="{{ route('berita.cari',['Kategori',$category->name]) }}">{{$category->name}}</a>
                                            <span>({{$category->beritas->count()}})</span>
                                        </li>
                                    @empty
																		<li class="align-items-center">
																			<a href="#">Belum Ditambahkan</a>
																		</li>
                                    @endforelse
                                </ul>
                            </div>


                            <div class="sidebar-widget tags mb-3">
                                <h5 class="mb-4">Tags</h5>
                                @forelse ($tags as $tag)
                                    <a href="{{ route('berita.cari',['Tag',$tag->name]) }}">{{ $tag->name }}</a>
                                @empty
                                    <a href="#">Belum Ditambahkan</a>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-7  text-center">
                    <a class="btn btn-main-2 btn-round-full" href="{{ url('berita/main') }}"><i
                            class="icofont-thin-double-left"></i>Berita Lainnya</a>
                </div>
            </div>
        </div>
    </section>
@endsection
