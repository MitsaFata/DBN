@extends('index')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        @if (auth()->guard('admin')->check() ||
                                auth()->guard('staff')->check())
                            <h3 class="font-weight-bold">List Tagihan Semua Pelanggan</h3>
                        @elseif(auth()->guard('mitra')->check())
                            <h3 class="font-weight-bold">List Tagihan</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Tabel Pelanggan --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable">
                        <thead style="background-color: #00AFEF">
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th style="display: none;">
                                    <center>ID Bayar</center>
                                </th>
                                @if (auth()->guard('admin')->check())
                                    <th>
                                        <center>ID Mitra</center>
                                    </th>
                                @endif
                                <th>
                                    <center>ID Laypel</center>
                                </th>
                                <th>
                                    <center>Tanggal</center>
                                </th>
                                <th>
                                    <center>Total</center>
                                </th>
                                <th>
                                    <center>Status</center>
                                </th>
                                <th>
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($bayar as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td style="display: none;">
                                        <center>{{ $t->id_bayar }}</center>
                                    </td>
                                    @if (auth()->guard('admin')->check())
                                        <td>
                                            <center>{{ $t->id_mitra }}</center>
                                        </td>
                                    @endif
                                    <td>
                                        <center>{{ $t->id_laypel }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->tanggal_bayar }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->total }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->status == 1)
                                                <a href="/mitra/statuslay/0/{{ $t->id_bayar }}">
                                                    <span class="btn btn-sm btn-success btn-icon-text">Jatuh Tempo</span>
                                                </a>
                                            @elseif ($t->status == 0)
                                                <a href="/mitra/statuslay/1/{{ $t->id_bayar }}"><span
                                                        class="btn btn-sm btn-danger btn-icon-text">{{$daysLate}} Hari</span></a>
                                            @endif
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="/mitra/tagihan/bayar/1/{{ $t->id_bayar }}">
                                                <span class="btn btn-sm btn-primary btn-icon-text">Bayar</span>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><br>
                <div class="d-flex justify-content-center">
                    {{-- {!! $pelanggan->links('pagination::bootstrap-4') !!} --}}
                </div>
            </div>
        </div>
    </div>

    <!--JS Modal-->
    @push('page-script')
        <script>
            @if (auth()->guard('mitra')->check())
                $(document).ready(function() {
                    $('#datatable').DataTable();
                });
            @else
                var groupColumn = 2;
                var table = $('#datatable').DataTable({
                    columnDefs: [{
                        visible: false,
                        targets: groupColumn
                    }],
                    order: [
                        [groupColumn, 'asc']
                    ],
                    displayLength: 25,
                    drawCallback: function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;

                        api.column(groupColumn, {
                                page: 'current'
                            })
                            .data()
                            .each(function(group, i) {
                                if (last !== group) {
                                    $(rows)
                                        .eq(i)
                                        .before(
                                            '<tr class="group"><td colspan="6">' +
                                            group +
                                            '</td></tr>'
                                        );

                                    last = group;
                                }
                            });
                    }
                });

                // Order by the grouping
                $('#datatable tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                        table.order([groupColumn, 'desc']).draw();
                    } else {
                        table.order([groupColumn, 'asc']).draw();
                    }
                });
            @endif
        </script>
    @endpush
@endsection
