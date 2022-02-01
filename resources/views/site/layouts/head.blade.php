<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="author" content="themefisher.com">

    <title>Unit Pelaksana Teknis Daerah Tahura Tahura Bukit Soeharto</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.png') }}" />

    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icofont/icofont.min.css') }}">
    <!-- Slick Slider  CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick-carousel/slick/slick-theme.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        #loading {
  position: fixed;
  display: block;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  text-align: center;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
}

#loading-image {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 10000;
  width: 120px;
  height: 120px;
}

        .card-img-wrap {
            overflow: hidden;
            position: relative;
        }

        .card-img-wrap:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.3);
            opacity: 0;
            transition: opacity .25s;
        }

        .card-img-wrap img {
            transition: transform .25s;
            width: 100%;
        }

        .card-img-wrap:hover img {
            transform: scale(1.2);
        }

        .card-img-wrap:hover:after {
            opacity: 1;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #124d35;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #2a8a63;
        }

        .logo-navbar {
            width: 350px;
        }

        @media (max-width: 767px) {

            .text-xs-center {
                text-align: center;
            }

            .gmap_canvas {
                padding-left: 55px;
            }
        }

    </style>
    @stack('css')
</head>

<body id="top" onload="loadLoadler()">
    <div id="loading">
        <img id="loading-image" src="{{asset('loader.gif')}}" alt="Loading..." />
      </div>

    <header>
        <div class="header-top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <ul class="top-bar-info list-inline-item pl-0 mb-0">
                            <li class="list-inline-item"><a href="mailto:support@gmail.com"><i
                                        class="icofont-support-faq mr-2"></i><strong
                                        class="emailWebsite">Email</strong></a></li>
                            <li class="list-inline-item"><i class="icofont-location-pin mr-2 "></i><strong
                                    class="alamatWebsite"></strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navigation" id="navbar">
            <div class="container">
                <a class="navbar-brand mt-0 pt-0" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo-navbar">
                </a>

                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain"
                    aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icofont-navigation-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarmain">

                    @if ($public_menu)
                        <ul class="navbar-nav ml-auto">
                            @foreach ($public_menu as $menu)
                                <li class="nav-item @if (!empty($menu['child'])) {{ $menu['class'] }} @endif">
                                    <a class="nav-link @if (!empty($menu['child'])) dropdown-toggle @endif" @if (!empty($menu['link'])) href="{{ url('/' . $menu['link']) }}" @else href="{{ url('/') }}" @endif title="">{{ $menu['label'] }}  @if (!empty($menu['child'])) <i class="icofont-thin-down"></i>  @endif</a>
					@if ($menu['child'])
					<ul class="
                                        dropdown-menu" aria-labelledby="dropdown02">
                                        @foreach ($menu['child'] as $child)
                                <li><a class="dropdown-item" href="{{ url('/' . $child['link']) }}"
                                        title="">{{ $child['label'] }}</a></li>
                            @endforeach
                        </ul><!-- /.sub-menu -->
                    @endif
                    </li>
                    @endforeach
                    @endif
                </div>
            </div>
        </nav>
    </header>
