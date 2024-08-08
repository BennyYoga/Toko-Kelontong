@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap">
                    <h2 class="mr-40">Barang</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                Barang
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
                    <h6>Data of Barang</h6>
                    <a href="#0" class="main-btn primary-btn btn-hover btn-sm">New Item</a>
                </div>


                <div class="content">
                    <div class="table-responsive">
                        <table id="barang" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
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

<script src="{{ asset('template') }}/vendor/datatables/buttons.server-side.js"></script>

<script>
    $(document).ready(function() {
        $('#tematik').DataTable({
            ajax: '',
            serverSide: true,
            processing: true,
            aaSorting: [
                [0, "desc"]
            ],
            columns: [{
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'Kode',
                    name: 'Kode',
                },
                {
                    data: 'Nama',
                    name: 'Nama',
                },
                {
                    data: 'Hargas',
                    name: 'Hargas',

                },
                {
                    data: 'hasil',
                    name: 'hasil',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                }
            ]
        });
    });
</script>
@endpush