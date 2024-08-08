@extends('layouts.app')

@section('title', 'Transaction')

@push('styles')

<link rel="stylesheet" href="{{ asset('template') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{ asset('template') }}/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" type="text/css" href="{{ asset('template') }}/js/select.dataTables.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap">
                    <h2 class="mr-40">Transaction</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                Transaction
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-style settings-card-1">
                <div class="title mb-30 d-flex justify-content-between align-items-center">
                    <h6>Data of Transaction</h6>
                    <a href="{{route('transaction.create')}}" class="btn btn-primary btn-sm">New Transaction</a>
                </div>


                <div class="content">
                    <div class="table-responsive">
                        <table id="transaction" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Customer</th>
                                    <th>Jumlah Barang</th>
                                    <th>Sub Total</th>
                                    <th>Diskon</th>
                                    <th>Ongkir</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('template') }}/vendors/chart.js/Chart.min.js"></script>
<script src="{{ asset('template') }}/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ asset('template') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="{{ asset('template') }}/js/dataTables.select.min.js"></script>


<script src="{{ asset('template') }}/js/dashboard.js"></script>
<script src="{{ asset('template') }}/js/Chart.roundedBarCharts.js"></script>

<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#transaction').DataTable({
                ajax: '',
                serverSide: true,
                processing: true,
                aaSorting: [
                    [0, "desc"]
                ],
                columns: [{
                        data: 'no',
                        name: 'no',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'no_transaksi',
                        name: 'no_transaksi',
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',

                    },
                    {
                        data: 'nama_customer',
                        name: 'nama_customer',

                    },
                    {
                        data: 'jumlah_barang',
                        name: 'jumlah_barang',

                    },
                    {
                        data: 'sub_total',
                        name: 'sub_total',

                    }, 
                    {
                        data: 'diskon',
                        name: 'diskon',

                    }, 
                    {
                        data: 'ongkir',
                        name: 'ongkir',

                    }, 
                    {
                        data: 'total',
                        name: 'total',

                    }, 
                ]
            });
        });
    });
</script>
@endpush