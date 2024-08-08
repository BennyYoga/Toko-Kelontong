@extends('layouts.app')

@section('title', 'Edit Customer')

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
                            <li class="breadcrumb-item">
                                <a href="{{route('customer.index')}}">Customer</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit
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
                    <h6>Edit Data Customer</h6>
                </div>

                <form action="{{route('customer.update', $customer->id)}}" method="post">
                    @csrf
                    @method('patch')

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-style-1">
                                <label>Nama Customer</label>
                                <input type="text" placeholder="Nama Customer" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{$customer->nama}}">
                                @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-style-1">
                                <label>Kode Customer</label>
                                <input type="text" placeholder="Kode Customer" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{$customer->kode}}">
                                @error('kode') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-style-1">
                                <label>No Telepon</label>
                                <input type="number" placeholder="No Telepon" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{$customer->telp}}">
                                @error('telp') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('customer.index') }}" class="btn btn-sm light-btn-outline btn-hover mr-5">Kembali</a>
                                <button class="btn btn-sm btn-primary btn-hover ml-5" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
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

@endpush