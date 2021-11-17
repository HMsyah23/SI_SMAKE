@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Selamat Datang, {{ Auth::user()->nama ?? '' }} </h3>
          <h6 class="font-weight-normal mb-0">Sistem Surat Masuk & Surat Keluar<strong class="text-primary"> UPTD Tahura Bukit Soeharto</strong></h6>
        </div>
        {{-- <div class="col-12 col-xl-4">
         <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
             <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
              <a class="dropdown-item" href="#">January - March</a>
              <a class="dropdown-item" href="#">March - June</a>
              <a class="dropdown-item" href="#">June - August</a>
              <a class="dropdown-item" href="#">August - November</a>
            </div>
          </div>
         </div>
        </div> --}}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 grid-margin transparent">
      <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4"> Total Surat Masuk</p>
                <p class="fs-30 mb-2" id="suratMasukCount"><i class="ti-email"></i> </p>
              </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue">
            <div class="card-body">
              <p class="mb-4"> Total Surat Keluar</p>
              <p class="fs-30 mb-2" id="suratKeluarCount"><i class="ti-email"></i> </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <p class="mb-4">Jumlah Pengguna</p>
              <p class="fs-30 mb-2" id="userCount"><i class="ti-user"></i> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
         <div class="d-flex justify-content-between">
          <p class="card-title">Laporan Surat Masuk & Surat Keluar</p>
          <a href="#" class="text-info"> <i class="ti-printer"></i></a>
         </div>
          {{-- <p class="font-weight-500"></p> --}}
          <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
          <canvas id="sales-chart"></canvas>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title"><i class="ti-email"></i> Surat Masuk</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="example" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>Quote#</th>
                      <th>Product</th>
                      <th>Business type</th>
                      <th>Policy holder</th>
                      <th>Premium</th>
                      <th>Status</th>
                      <th>Updated at</th>
                      <th></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title"><i class="ti-email"></i> Surat Keluar</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="example2" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>Quote#</th>
                      <th>Product</th>
                      <th>Business type</th>
                      <th>Policy holder</th>
                      <th>Premium</th>
                      <th>Status</th>
                      <th>Updated at</th>
                      <th></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          </div>
        </div>
    </div>
  </div> --}}
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $.getJSON(`${BASE_URL}/api/suratMasuks`, function (result) {
        $('#suratMasukCount').append(Object.keys(result.data).length);
      });

      $.getJSON(`${BASE_URL}/api/suratKeluars`, function (result) {
        $('#suratKeluarCount').append(Object.keys(result.data).length);
      });

      $.getJSON(`${BASE_URL}/api/users`, function (result) {
        $('#userCount').append(Object.keys(result.data).length);
      });
    });
  </script>
@endpush