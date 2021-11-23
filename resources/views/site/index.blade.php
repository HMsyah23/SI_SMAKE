@extends('site.layouts.app')

@section('content')
	<section class="banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12 col-xl-7">
					<div class="block">
						<div class="divider mb-3"></div>
						<span class="text-uppercase text-sm letter-spacing ">Unit Pelaksana Teknis Daerah</span>
						<h1 class="mb-3 mt-3">Tahura Bukit Soeharto</h1>
						
						<p class="mb-4 pr-5">Unit Pelayanan Khusus yang bertugas untuk menjaga keamanan Taman Hutan Raya Bukit Soeharto</p>
						{{-- <div class="btn-container ">
							<a href="appoinment.html" target="_blank" class="btn btn-main-2 btn-icon btn-round-full">Make appoinment <i class="icofont-simple-right ml-2  "></i></a>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="features">
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
	</section>
	<section class="section about">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-4 col-sm-6">
					<div class="about-img">
						<img src="{{asset('assets/images/about/img-1.jpg')}}" alt="" class="img-fluid">
						<img src="{{asset('assets/images/about/img-2.jpg')}}" alt="" class="img-fluid mt-4">
					</div>
				</div>
				<div class="col-lg-4 col-sm-6">
					<div class="about-img mt-4 mt-lg-0">
						<img src="{{asset('assets/images/about/img-3.jpg')}}" alt="" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="about-content pl-4 mt-4 mt-lg-0">
						<h2 class="title-color">Tetap Teguh <br>Menjaga Lestari Ibu Pertiwi</h2>
						<a href="service.html" class="btn btn-main-2 btn-round-full btn-icon">Profil<i class="icofont-simple-right ml-3"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="cta-section ">
		<div class="container">
			<div class="cta position-relative">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="counter-stat">
							<i class="icofont-doctor"></i>
							<span class="h3">58</span>
							<p>Happy People</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="counter-stat">
							<i class="icofont-flag"></i>
							<span class="h3">700</span>+
							<p>Hektar Tanah</p>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="counter-stat">
							<i class="icofont-badge"></i>
							<span class="h3">40</span>
							<p>Tenaga Ahli</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="counter-stat">
							<i class="icofont-globe"></i>
							<span class="h3">4</span>
							<p>Divisi</p>
						</div>
					</div>
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
						<div class="divider mx-auto my-4"></div>
						<p>Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="service-item mb-4">
						<img src="{{asset('assets/images/about/img-2.jpg')}}" alt="" class="img-fluid">
							<h4 class="mt-3 mb-3">Pembersihan Tambang Ilegal</h4>
						<div class="content">
							<p class="mb-4">Saepe nulla praesentium eaque omnis perferendis a doloremque.</p>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="service-item mb-4">
						<img src="{{asset('assets/images/about/img-2.jpg')}}" alt="" class="img-fluid">
						<h4 class="mt-3 mb-3">Pembersihan Tambang Ilegal</h4>
						<div class="content">
							<p class="mb-4">Saepe nulla praesentium eaque omnis perferendis a doloremque.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="service-item mb-4">
						<img src="{{asset('assets/images/about/img-2.jpg')}}" alt="" class="img-fluid">
						<h4 class="mt-3 mb-3">Pembersihan Tambang Ilegal</h4>
						<div class="content">
							<p class="mb-4">Saepe nulla praesentium eaque omnis perferendis a doloremque.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section clients">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7">
					<div class="section-title text-center">
						<h2>Partners Kami</h2>
						<div class="divider mx-auto my-4"></div>
						<p>Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.</p>
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
						<img src="{{asset('assets/images/about/1.png')}}" alt="" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection