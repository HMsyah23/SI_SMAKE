@extends('site.layouts.app')

@section('content')
	<section class="page-title bg-1">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
			<div class="col-md-12">
				<div class="block text-center">
				<h1 class="text-capitalize mb-5 text-lg">Kontak</h1>

				<ul class="list-inline breadcumb-nav">
					<li class="list-inline-item"><a href="{{ route('home') }}" class="text-white">Beranda</a></li>
					<li class="list-inline-item"><span class="text-white">/</span></li>
					<li class="list-inline-item"><a href="{{ route('kontak') }}" class="text-white-50">Kontak</a></li>
				</ul>
				</div>
			</div>
			</div>
		</div>
	</section>
	<section class="section contact-info pb-0">
		<div class="container">
			 <div class="row">
				<div class="col-lg-4 col-sm-6 col-md-6">
					<div class="contact-block mb-4 mb-lg-0">
						<i class="icofont-live-support"></i>
						<h5>Hubungi Kami</h5>
						<p class="nomorWebsite"></p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6 col-md-6">
					<div class="contact-block mb-4 mb-lg-0">
						<i class="icofont-support-faq"></i>
						<h5>Email Kami</h5>
						 <p class="emailWebsite"></p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6 col-md-6">
					<div class="contact-block mb-4 mb-lg-0">
						<i class="icofont-location-pin"></i>
						<h5>Lokasi</h5>
						<p class="alamatWebsite"></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="contact-form-wrap section mb-0 pb-0">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div class="section-title text-center">
						<h2 class="text-md">Peta Interaktif</h2>
						<div class="divider mx-auto my-4"></div>
						{{-- <p class="mb-5">Laboriosam exercitationem molestias beatae eos pariatur, similique, excepturi mollitia sit perferendis maiores ratione aliquam?</p> --}}
					</div>
				</div>
			</div>
			{{-- <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<form id="contact-form" class="contact__form " method="post" action="mail.php">
					 <!-- form message -->
						<div class="row">
							<div class="col-12">
								<div class="alert alert-success contact__msg" style="display: none" role="alert">
									Your message was sent successfully.
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<input name="name" id="name" type="text" class="form-control" placeholder="Your Full Name" >
								</div>
							</div>
	
							<div class="col-lg-6">
								<div class="form-group">
									<input name="email" id="email" type="email" class="form-control" placeholder="Your Email Address">
								</div>
							</div>
							 <div class="col-lg-6">
								<div class="form-group">
									<input name="subject" id="subject" type="text" class="form-control" placeholder="Your Query Topic">
								</div>
							</div>
							 <div class="col-lg-6">
								<div class="form-group">
									<input name="phone" id="phone" type="text" class="form-control" placeholder="Your Phone Number">
								</div>
							</div>
						</div>
	
						<div class="form-group-2 mb-4">
							<textarea name="message" id="message" class="form-control" rows="8" placeholder="Your Message"></textarea>
						</div>
	
						<div class="text-center">
							<input class="btn btn-main btn-round-full" name="submit" type="submit" value="Send Messege"></input>
						</div>
					</form>
				</div>
			</div> --}}
		</div>
		<div class="google-map pb-0 mb-0">
			<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1_wHLg6fneGpzdlSGAJkdWMJl4htDWmqA&ehbc=2E312F"
				frameborder="0" style="overflow:hidden;height:480px;width:100%" height="100%" width="100%"></iframe>
		</div>
	</section>
	
	
	
@endsection