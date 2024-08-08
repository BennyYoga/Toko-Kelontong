@extends('layouts.app')

@section('title', 'Create Barang')

@push('styles')

<link rel="stylesheet" href="{{ asset('template') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{ asset('template') }}/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="{{ asset('template') }}/vendors/select2/select2.min.css">
<link rel="stylesheet" href="{{ asset('template') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('template') }}/js/select.dataTables.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    .table input {
        width: 100%;
        box-sizing: border-box;
        padding: 4px;
    }
</style>
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
                            <li class="breadcrumb-item">
                                <a href="{{route('transaction.index')}}">Transaction</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Create
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
        <div class="col-md-12">
            <div class="card-style settings-card-1">
                <div class="title mb-30 d-flex justify-content-between align-items-center">
                    <h6>Create Transaksi Baru</h6>
                </div>

                <form action="{{route('transaction.store')}}" method="post" id="transaction-form">
                    @csrf
                    <div class="row">
                        <!-- Detail customer -->
                        <div class="col-md-6">
                            <div class="row">
                                <h6 class="mb-3">Detail Costumer</h6>
                                <div class="col-md-12">
                                    <div class="select-style-1">
                                        <label>Kode Customer</label>
                                        <div class="select-position">
                                            <select id="customer-select" name="kode">
                                                <option value="" disabled selected>Pilih Customer</option>
                                                @foreach($customer as $customer)
                                                <option value="{{ $customer->id }}" @if(old('kode')==$customer->id)
                                                    selected
                                                    @endif>
                                                    {{ $customer->kode }} - {{ $customer->nama }}
                                                </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label>Nama Customer</label>
                                        <input type="text" id="nama_customer" placeholder="Nama Customer" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" readonly>
                                        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label>No Telepon</label>
                                        <input type="text" id="telp_customer" placeholder="No Telepon" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" readonly>
                                        @error('telp') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end detail customer -->

                        <!-- Detail transaksi -->
                        <div class="col-md-6">
                            <h6 class="mb-3">Detail Transaksi</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-style-1">
                                        <label>Nomor Transaction</label>
                                        <input type="text" class="form-control @error('no_transaction') is-invalid @enderror" name="no_transaction" value="{{$transaction}}" readonly>
                                        @error('no_transaction') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Transaksi</label>
                                        <input type="date" placeholder="Nama Barang" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}">
                                        @error('tanggal') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end detail transaksi -->
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card-style settings-card-1">
                <div class="title mb-30 d-flex justify-content-between">
                    <h6>Detail Pembelian</h6>
                    <button class="btn btn-primary" onclick="notificationAddTransaction(event, this)">Tambah Transaksi</button>
                </div>

                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead class="text-center">
                            <tr>
                                <th width="5%" rowspan="2">
                                    <h6>No</h6>
                                </th>
                                <th width="10%" rowspan="2">
                                    <h6>Kode Barang</h6>
                                </th>
                                <th width="15%" rowspan="2">
                                    <h6>Nama Barang</h6>
                                </th>
                                <th width="5%" rowspan="2">
                                    <h6>Qty</h6>
                                </th>
                                <th width="10%" rowspan="2">
                                    <h6>Harga Bandrol</h6>
                                </th>
                                <th width="20%" colspan="2">
                                    <h6>Diskon</h6>
                                </th>
                                <th width="10%" rowspan="2">
                                    <h6>Harga Diskon</h6>
                                </th>
                                <th width="10%" rowspan="2">
                                    <h6>Total</h6>
                                </th>
                                <th width="25%" rowspan="2">
                                    <h6>Action</h6>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <h6>%</h6>
                                </th>
                                <th>
                                    <h6>Rp</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="content-table text-center mb-5">
                        </tbody>
                        <tbody class="text-center">
                            <tr>
                                <td colspan="8" class="text-end">Sub Total</td>
                                <td><input type="number" class="form-control-plaintext" name="sub_total" readonly form="transaction-form"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-end">Diskon</td>
                                <td><input type="number" class="form-control" name="diskon_total" form="transaction-form"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-end">Ongkir</td>
                                <td><input type="number" class="form-control" name="ongkir_total" form="transaction-form"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-end">Total Bayar</td>
                                <td><input type="number" class="form-control-plaintext" name="bayar_total" readonly form="transaction-form"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <a href="{{route('transaction.index')}}" class="btn btn-sm light-btn-outline btn-hover mr-5">Batal</a>
                    <button type="submit" form="transaction-form" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="select-style-1">
                            <label>Masukkan Barang</label>
                            <div class="select-position">
                                <select id="barang-select">
                                    <option value="default" readonly selected>Pilih Barang</option>
                                    @foreach($barang as $barang)
                                    <option value="{{$barang->id}}">{{$barang->kode}} - {{$barang->nama}} - {{$barang->harga}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-style-1">
                            <label>Jumlah Barang</label>
                            <input type="number" name="jumlah_barang" min="0" required>
                            @error('jumlah_barang') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-style-1">
                            <label>Diskon Barang <i>(dalam persen)</i></label>
                            <input type="number" name="diskon_barang" min="0" required>
                            @error('diskon_barang') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" id="tambah-barang" class="btn btn-primary" data-dismiss="modal">Tambah</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('template') }}/vendors/chart.js/Chart.min.js"></script>
<script src="{{ asset('template') }}/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ asset('template') }}/vendors/select2/select2.min.js"></script>
<script src="{{ asset('template') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="{{ asset('template') }}/js/dataTables.select.min.js"></script>


<script src="{{ asset('template') }}/js/dashboard.js"></script>
<script src="{{ asset('template') }}/js/Chart.roundedBarCharts.js"></script>

<script>
    $(document).ready(function() {

        $('#customer-select').on('change', function() {
            var idCustomer = $(this).val();
            $.ajax({
                url: "{{route('transaction.customer.show', ':id')}}".replace(':id', idCustomer),
                type: 'GET',
                success: function(data) {
                    $('#nama_customer').val(data.nama);
                    $('#telp_customer').val(data.telp);
                }
            });
        });

        $('#tambah-barang').on('click', function() {
            let nomor = $('.content-table tr').length;

            let idBarang = $('#barang-select').val();
            let keterangan = $('#barang-select option:selected').text();

            keterangan = keterangan.split(' - ');
            let kodeBarang = keterangan[0];
            let namaBarang = keterangan[1];
            let hargaBarang = keterangan[2];

            let jumlahBarang = $('input[name=jumlah_barang]').val();
            let diskonBarang = $('input[name=diskon_barang]').val();

            if (jumlahBarang == '' || diskonBarang == '') {
                alert('Jumlah dan diskon barang tidak boleh kosong');
                return;
            } else if (jumlahBarang < 0 || diskonBarang < 0) {
                alert('Jumlah dan diskon barang tidak boleh kurang dari 0');
                return;
            } else if (diskonBarang >= 100) {
                alert('Diskon barang tidak boleh lebih dari 100%');
                return;
            }

            let diskonRupiah = hargaBarang * diskonBarang / 100;
            let hargaDiskon = hargaBarang - diskonRupiah;

            let total = hargaDiskon * jumlahBarang;

            let inTable = false;
            $('.content-table tr').each(function() {
                let kode = $(this).find('input[name="kode_barang[]"]').val();
                if (kode == kodeBarang) {
                    inTable = true;
                    $(this).find('input[name="qty[]"]').val(jumlahBarang);
                    $(this).find('input[name="harga_bandrol[]"]').val(hargaBarang);
                    $(this).find('input[name="persen_diskon[]"]').val(diskonBarang);
                    $(this).find('input[name="rupiah_diskon[]"]').val(diskonRupiah);
                    $(this).find('input[name="harga_diskon[]"]').val(hargaDiskon);
                    $(this).find('input[name="total[]"]').val(total);

                    calculate();
                    calculateTotal();
                }
            });
            if (!inTable) {
                let newRow = makeRow({
                    nomor: nomor,
                    kodeBarang: kodeBarang,
                    namaBarang: namaBarang,
                    jumlahBarang: jumlahBarang,
                    hargaBarang: hargaBarang,
                    diskonBarang: diskonBarang,
                    diskonRupiah: diskonRupiah,
                    hargaDiskon: hargaDiskon,
                    total: total
                });
                $('.content-table').append(newRow);
                calculate();
                calculateTotal();
                $('#barang-select').val('default');
                $('input[name=jumlah_barang]').val('');
                $('input[name=diskon_barang]').val('');
            }
            total = 0;
            hargaBarang = 0;
            diskonBarang = 0;
            jumlahBarang = 0;
            diskonRupiah = 0;
            hargaDiskon = 0;
            kodeBarang = '';
        })

        $('input[name=diskon_total], input[name=ongkir_total]').on('change', function() {
            calculateTotal();
        });

        calculate();
        calculateTotal();
    });

    function deleteItem(event, el) {
        event.preventDefault();
        $(el).parent().parent().remove();

        calculate();
        calculateTotal();
    }

    function notificationAddTransaction(event, el) {
        event.preventDefault();
        {
            $('#addTransaction').modal('show');
            $('#barang-select').val('default');
            $('input[name=jumlah_barang]').val('');
            $('input[name=diskon_barang]').val('');
        }
    }

    function notificationEdit(event, el) {
        event.preventDefault();

        let row = $(el).closest('tr');
        let values = row.find('input').map(function() {
            return $(this).val();
        }).get();

        $('#addTransaction').modal('show');

        $('#barang-select').val(values[0]);
        $('input[name=jumlah_barang]').val(values[2]);
        $('input[name=diskon_barang]').val(values[4]);

    }

    function makeRow(data) {
        let newRow = `
            <tr id="${data.kodeBarang}">
                    <td>${data.nomor+1}</td>
                    <td><input type="text" class="form-control-plaintext" name="kode_barang[]" value="${data.kodeBarang}" readonly form="transaction-form"></td>
                    <td><input type="text" class="form-control-plaintext" name="nama_barang[]" value="${data.namaBarang}" readonly form="transaction-form"></td>
                    <td><input type="number" class="form-control-plaintext" name="qty[]" value="${data.jumlahBarang}" readonly form="transaction-form"></td>
                    <td><input type="number" class="form-control-plaintext" name="harga_bandrol[]" value="${data.hargaBarang}" readonly form="transaction-form"></td>
                    <td><input type="number" class="form-control-plaintext" name="persen_diskon[]" value="${data.diskonBarang}" readonly form="transaction-form"></td>
                    <td><input type="number" class="form-control-plaintext" name="rupiah_diskon[]" value="${data.diskonRupiah}" readonly form="transaction-form"></td>
                    <td><input type="number" class="form-control-plaintext" name="harga_diskon[]" value="${data.hargaDiskon}" readonly form="transaction-form"></td>
                    <td><input type="number" class="form-control-plaintext total" name="total[]" value="${data.total}" readonly form="transaction-form"></td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteItem(event,this)">Hapus</button>
                        <button class="btn btn-primary" onclick="notificationEdit(event,this)">Edit</button>
                    </td>
                </tr>
        `;

        return newRow;
    }

    function calculate() {
        let total = 0;

        $('.total').each(function() {
            total += parseInt($(this).val());
        });

        $('input[name=sub_total]').val(total);
    }

    function calculateTotal() {
        let total = 0;
        let subTotal = 0;
        $('.total').each(function() {
            subTotal += parseInt($(this).val());
        });
        

        let diskon = parseInt($('input[name=diskon_total]').val());
        let ongkir = parseInt($('input[name=ongkir_total]').val());
        if (isNaN(diskon)) {
            diskon = 0;
        }
        if (isNaN(ongkir)) {
            ongkir = 0;
        }
        total = subTotal - diskon + ongkir;
        $('input[name=bayar_total]').val(total);
    }
</script>
@endpush