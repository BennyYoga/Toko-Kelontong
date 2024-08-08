@extends('layouts.app')

@section('title', 'Customer')

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
                    <h2 class="mr-40">Customer</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                Customer
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
                    <h6>Data of Customer</h6>
                    <a href="{{route('barang.create')}}" class="btn btn-primary btn-sm">Add Customer</a>
                </div>


                <div class="content">
                    <div class="table-responsive">
                        <table id="customer" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Telepon</th>
                                    <th>Action</th>
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
        $('#customer').DataTable({
            ajax: '',
            serverSide: true,
            processing: true,
            aaSorting: [
                [0, "asc"]
            ],
            columns: [{
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    width: '5%',
                },
                {
                    data: 'kode',
                    name: 'kode',
                    width: '25%',
                },
                {
                    data: 'nama',
                    name: 'nama',
                    width: '25%',
                },
                {
                    data: 'telp',
                    name: 'telp',
                    width: '25%',

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '20%',
                }
            ]
        });
    });
</script>
@endpush