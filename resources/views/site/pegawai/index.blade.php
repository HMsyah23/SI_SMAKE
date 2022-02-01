@extends('site.layouts.app')

@section('content')
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize mb-5 text-lg">Daftar Pegawai</h1>

                        <ul class="list-inline breadcumb-nav">
                            <li class="list-inline-item"><a href="{{ route('home') }}" class="text-white">Beranda</a>
                            </li>
                            <li class="list-inline-item"><span class="text-white">/</span></li>
                            <li class="list-inline-item">
                                <a href="{{ route('daftar.pegawai') }}" class="text-white">Daftar Pegawai</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section doctor-single gray-bg pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="doctor-details mt-4 mt-lg-0 ">
                        <h2 class="text-md">Daftar Pegawai</h2>
                        <div class="divider my-4"></div>
                        <div class="container mb-5">
                            <div class="cta position-relative">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="counter-stat">
                                            <i class="icofont-user"></i>
                                            <span class="h3">{{ $data['pegawai'] }}</span>
                                            <p>Total Pegawai</p>
                                        </div>
                                    </div>



                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="counter-stat">
                                            <i class="icofont-user"></i>
                                            <span class="h3">{{ $data['pegawai_tetap'] }}</span>
                                            <p>Pegawai Tetap</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="counter-stat">
                                            <i class="icofont-user"></i>
                                            <span class="h3">{{ $data['tenaga_kontrak'] }}</span>
                                            <p>Tenaga Kontrak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section doctor-qualification ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($pegawais as $divisi => $pegawai)
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="table-success">
                                    <th colspan="5" scope="col">{{ $divisi }}</th>
                                </tr>
                                <tr>
                                    <th rowspan="2" style="vertical-align : middle;text-align:center;">No</th>
                                    <th rowspan="2" style="vertical-align : middle;text-align:center;">Jabatan</th>
                                    <th colspan="2" style="vertical-align : middle;text-align:center;">Golongan</th>
                                </tr>
                                <tr>
                                    @foreach ($data['pangkat'] as $pangkat)
                                        <th>{{ $pangkat->golongan ?? '' }}.{{ $pangkat->ruang ?? '' }}</th>
                                    @endforeach
                                </tr>
                                @foreach ($pegawai as $jabatan => $pegawa)
                                    <tr>
                                        <th scope="row" style="vertical-align : middle;text-align:center;">{{ $loop->iteration }}</th>
                                        <td>{{ $jabatan }}</td>
                                        @foreach ($data['pangkat'] as $golongan)
                                            @php $sum = 0 @endphp
                                            @foreach ($pegawa as $pangkat => $pegaw)
                                                @if ($golongan->id == $pangkat)
                                                    @php $sum++ @endphp
                                                @endif
                                            @endforeach
                                            <td>{{ $sum }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="2">Jumlah</th>
                                    @foreach ($data['pangkat'] as $golongan)
                                        @php $total = 0 @endphp
                                        @php $sum = 0 @endphp
                                        @foreach ($pegawai as $jabatan => $pegawa)
                                            @foreach ($pegawa as $pangkat => $pegaw)
                                                @if ($golongan->id == $pangkat)
                                                    @php $sum++ @endphp
                                                @endif
                                            @endforeach
                                        @endforeach
                                        @php $total = $total + $sum @endphp
                                        <th>{{ $total }}</th>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
