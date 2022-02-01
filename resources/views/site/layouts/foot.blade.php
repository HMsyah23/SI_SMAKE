<!-- footer Start -->
<footer class="footer gray-bg pt-2">
    <div class="container text-xs-center">
        <div class="row align-items-lg-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="logo">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo-navbar">
                </div>
            </div>
            <div class="col-lg-6 pt-3">
                <ul class="list-inline footer-socials text-lg-right">
                    <li class="list-inline-item"><a id="facebookWebsite" href="#"><i
                                class="icofont-facebook"></i></a></li>
                    <li class="list-inline-item"><a id="twitterWebsite" href="#"><i
                                class="icofont-twitter"></i></a></li>
                    <li class="list-inline-item"><a id="instagramWebsite" href="#"><i
                                class="icofont-instagram"></i></a></li>
                    <li class="list-inline-item"><a id="youtubeWebsite" href="#"><i
                                class="icofont-youtube"></i></a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-2 col-md-12 mr-auto col-sm-12">
                <div class="widget mb-5 mb-lg-0">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas"
                                src="https://maps.google.com/maps?q=UPTD%20Tahura%20Bukit%20Soeharto&t=k&z=15&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                href="https://www.online-timer.net"></a><br>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: center;
                                    height: 300px;
                                    width: 400px;
                                }

                            </style><a href="https://www.embedgooglemap.net"></a>
                            <style>
                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 300px;
                                    width: 400px;
                                }

                            </style>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="widget mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Berita Terkini</h4>
                    <div class="divider mb-4"></div>

                    <ul class="list-unstyled footer-menu lh-35">
                        @forelse ($new_beritas as $item)
                            <li><a href="{{ url('berita/' . $item->slug) }}"><strong>{{ $item->title }}</strong></a></li>
                        @empty
                            <li><a href="#"><strong>Tidak Ada </strong></a></li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="widget widget-contact mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Kontak</h4>
                    <div class="divider mb-4"></div>

                    <div class="footer-contact-block mb-1">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-email mr-3"></i>
                            <span class="h6 mb-0 emailWebsite"></span>
                        </div>
                    </div>

                    <div class="footer-contact-block mb-1">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-support mr-3"></i>
                            <span class="h6 mb-0 nomorWebsite">Nomor</span>
                        </div>
                    </div>
                    <div class="footer-contact-block">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-location-pin mr-2 "></i><span
                                    class="alamatWebsite"></span></li>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-btm py-4 mt-5">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6">
                    <div class="copyright">
                        &copy; Copyright Reserved to <span class="text-color"><a href="https://hmsyah23.github.io/"
                                target="_blank">HMsyah23</a></span> Theme by <a href="https://themefisher.com/"
                            target="_blank">Novena</a>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
					<div class="subscribe-form text-lg-right mt-5 mt-lg-0">
						<form action="#" class="subscribe">
							<input type="text" class="form-control" placeholder="Your Email address">
							<a href="#" class="btn btn-main-2 btn-round-full">Subscribe</a>
						</form>
					</div>
				</div> --}}
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <a class="backtop js-scroll-trigger" href="#top">
                        <i class="icofont-long-arrow-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- 
    Essential Scripts
    =====================================-->

<!-- Main jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<!-- Bootstrap 4.3.2 -->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counterup/jquery.easing.js') }}"></script>
<!-- Slick Slider -->
<script src="{{ asset('assets/plugins/slick-carousel/slick/slick.min.js') }}"></script>
<!-- Counterup -->
<script src="{{ asset('assets/plugins/counterup/jquery.waypoints.min.js') }}"></script>

<script src="{{ asset('assets/plugins/shuffle/shuffle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>
<!-- Google Map -->
<script src="{{ asset('assets/plugins/google-map/map.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap">
</script>

<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/contact.js') }}"></script>
<script>
    let BASE_URL = '{!! url('/') !!}';
    let YEAR = 2021;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    function getInformasi() {
        const url = `${BASE_URL}/api/informasis`;
        $.getJSON(url, function(result) {
            console.log(result.data);
            $('.emailWebsite').text(result.data[6].deskripsi);
            $('.alamatWebsite').text(result.data[8].deskripsi);
            $('.nomorWebsite').text(result.data[4].deskripsi);
            $('#googleWebsite').text(result.data[11].deskripsi);
            $('#whatsappWebsite').text(result.data[9].deskripsi);
            $('#mapsWebsite').text(result.data[13].deskripsi);
            $('#tanahWebsite').text(result.data[7].deskripsi);
            if (result.data[10].deskripsi != 0) {
                $('#facebookWebsite').attr('href',`${result.data[10].deskripsi}`);
            }
            if (result.data[3].deskripsi != 0) {
                $('#twitterWebsite').attr('href',`${result.data[3].deskripsi}`);
            }
            if (result.data[0].deskripsi != 0) {
                $('#instagramWebsite').attr('href',`${result.data[0].deskripsi}`);
            }
            if (result.data[5].deskripsi != 0) {
                $('#youtubeWebsite').attr('href',`${result.data[5].deskripsi}`);
            }
        });
    }
    $(document).ready(function() {
        getInformasi();
    });

    $(window).on('load', function () {
    $('#loading').hide();
  }) 
</script>
@stack('js')

</body>

</html>
