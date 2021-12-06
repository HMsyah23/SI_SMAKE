<title>Lembar Disposisi {{$suratMasuk->nomor_surat}}</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<style>
.times {
    font-family: "Times New Roman", Times, serif;
    color: black;
    font-weight: bold;
    text-align: center;
    font-size: 12pt;
    line-height: 0pt;
}
.arial {
    color: black;    
    line-height: 0pt;
    text-align: center;
    font-size: 8pt;
}
hr {
  background-color:white;
  margin:0 0 0px 0;
  max-width:600px;
  border-width:0;
  margin-top:-10px;
}

hr.s1 {
  height:1px;
  border-top:2px solid black;
  border-bottom:1px solid black;
}

table.table-bordered{
    border:1px solid black;
    margin-top:20px;
    font-size:12px
  }
table.table-bordered > thead > tr > th{
    border:1px solid black;
}
table.table-bordered > tbody > tr > td{
    border:1px solid black;
}
</style>
<div class="row mt-0 pt-0 pb-0 mb-0">
    <div class="col" >
        <img style="position: absolute; top: -15px; left: 10px;" src="{{$logo}}" alt="" width="65" height="80">
    </div>
    <div class="col">
        <p class="times">PEMERINTAH PROVINSI KALIMANTAN TIMUR</p>
        <p class="times">DINAS KEHUTANAN</p>
        <p class="times">UPTD TAHURA BUKIT SOEHARTO</p>
        <p class="arial">Jln. Biola No.2 Samarinda 75123 Telp. (0541) 738843 Fax. 731952</p>
        <p class="arial">email :  tahura.bukit.soeharto@gmail.com / tahura.bukit.soeharto2015@gmail.com</p>
    </div>
</div>
<hr class="s1">
<center>
<strong style="black">LEMBAR DISPOSISI</strong>
</center>
<table class="table table-sm table-bordered" style="border: 1px solid black; margin-top:5px; table-layout:fixed;">
    <tbody>
        @if ($suratMasuk->isValid)
        <tr>
            <td scope="col" colspan="2"><small>Telah divalidasi oleh Ketua TU pada Tanggal <strong>{{\Carbon\Carbon::parse($suratMasuk->tanggal_validasi)->isoFormat('D MMMM Y')}}</strong></small></td>
        </tr>
        @else
        <tr>
            <td scope="col" colspan="2"><small>Belum divalidasi oleh Ketua TU</small></td>
        </tr>
        @endif
      <tr>
        <td scope="col">Surat Dari       : <strong>{{$suratMasuk->asal_surat}}</strong></td>
        <td scope="col">Diterima Tanggal : <strong>{{\Carbon\Carbon::parse($suratMasuk->tanggal_terima)->isoFormat('D MMMM Y')}}</strong></td>
      </tr>
      <tr>
        <td scope="col">Tanggal Surat    : <strong>{{\Carbon\Carbon::parse($suratMasuk->tanggal_surat)->isoFormat('D MMMM Y')}}</strong></td>
        <td scope="col">No Agenda        : <strong>{{$suratMasuk->no_agenda}}</strong></td>
      </tr>
      <tr>
        <td rowspan="2"  scope="col">No Surat      : <p><strong>{{$suratMasuk->nomor_surat}}</strong></p></td>
        <td scope="col">Sifat            : <strong>{{$suratMasuk->sifat}}</strong></td>
      </tr>
      <tr>
        <td scope="col">
            <label class ="checkbox-inline">
                <input type = "checkbox" @if (in_array(1, $suratMasuk->tipe)) checked @endif >Segera
            </label>
            <label class ="checkbox-inline">
                <input type="checkbox" @if (in_array(2, $suratMasuk->tipe)) checked @endif >Sangat Segera
            </label>
            <label class ="checkbox-inline">
                <input type = "checkbox" @if (in_array(3, $suratMasuk->tipe)) checked @endif>Rahasia
            </label>
        </td>
    </tr>
    <tr>
        <td colspan="2">Perihal : 
            <p style="text-indent:40px"><small>{{$suratMasuk->perihal}}</small></p>
        </td>
    </tr>
    <tr>
        <td>
            Diteruskan Kepada :
            <ul>
                @if ($suratMasuk->divisi != NULL)
                @foreach ($suratMasuk->divisi as $item)
                    <li><small>{{$item}}</small></li>
                @endforeach
                @else
                    <li>Belum Diinput Oleh Ketua UPTD</li>
                @endif
            </ul>
        </td>
        <td>
            Dengan Hormat :
            <ul>
                @if (in_array(1, $suratMasuk->catatan)) <li><small>Tanggapan dan Saran</small></li> @endif
                @if (in_array(2, $suratMasuk->catatan)) <li><small>Proses Lebih Lanjut</small></li> @endif
                @if (in_array(3, $suratMasuk->catatan)) <li><small>Koordinasi / Konfirmasi</small></li> @endif
                @if (count($suratMasuk->catatan) > 3)
                <li><small><u>{{$suratMasuk->catatan[3]}}</u></small></li>
                @endif
            </ul>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Catatan :</strong>
            <p style="text-indent:30px"><small>{!! nl2br(e($suratMasuk->noted))!!}</small></p>
        </td>
        <td class="text-center">
            <strong>Kepala UPTD,</strong> <br>
            @if ($ttd == NULL)
                <small>Belum Didisposisi Oleh Ketua UPTD</small>
            @else
            <img class="img-fluid" src="{{$ttd}}">
            @endif
            <p>
                @if ($suratMasuk->tanggal_disposisi != NULL)
                Samarinda, {{\Carbon\Carbon::parse($suratMasuk->tanggal_disposisi)->isoFormat('D MMMM Y')}}
                @endif
            </p>
        </td>
    </tr>
    </tbody>
  </table>