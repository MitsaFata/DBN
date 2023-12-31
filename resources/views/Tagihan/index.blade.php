@extends('index')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <h3 class="font-weight-bold">Cetak Tagihan</h3>
                        </center>
                    </div>
                </div><br>
                <center><label for="tgl_awal">Tanggal Awal</label></center>
                <div class="form-group">
                    <input type="date" class="form-control" id="tgl_awal" placeholder="Pilih Tanggal Awal">
                </div>
                <div class="form-group">
                    <a href="" onclick="generatePrintURL();" target="_blank"
                        class="btn btn-primary btn-lg btn-block">Cetak
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generatePrintURL() {
            var tglAwal = document.getElementById('tgl_awal').value;

            // Parsing input tanggal menjadi objek Date
            var startDate = new Date(tglAwal);

            // Format tanggal untuk URL (YYYY-MM-DD)
            var formattedStartDate = formatDate(startDate);

            @if (auth()->guard('admin')->check())
                // Membuat URL untuk mencetak
                var printURL = '/admin/tagihan/cetakbulan/' + formattedStartDate;
            @elseif (auth()->guard('mitra')->check()) 
                var printURL = '/mitra/tagihan/cetakbulan/' + formattedStartDate;
            @endif

            // Redirect ke URL cetak
            window.location.href = printURL;
        }

        function formatDate(date) {
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
            return year + '-' + month + '-' + day;
        }
    </script>
@endsection
