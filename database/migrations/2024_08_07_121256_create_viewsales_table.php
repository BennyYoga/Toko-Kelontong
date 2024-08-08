<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viewsales', function (Blueprint $table) {
            DB::statement("CREATE VIEW sales_summary AS
                SELECT
                    s.id AS No,
                    s.kode AS No_Transaksi,
                    s.tanggal AS Tanggal,
                    c.nama AS Nama_Customer,
                    COALESCE(SUM(sd.qty), 0) AS Jumlah_Barang,
                    s.subtotal AS Sub_Total,
                    s.diskon AS Diskon,
                    s.ongkir AS Ongkir,
                    s.total_bayar AS Total
                FROM
                    t_sales s
                JOIN
                    m_customer c ON s.customer_id = c.id
                LEFT JOIN
                    t_sales_det sd ON s.id = sd.sales_id
                GROUP BY
                    s.id, s.kode, s.tanggal, c.nama, s.subtotal, s.diskon, s.ongkir, s.total_bayar
                ORDER BY
                    s.id;
                ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viewsales');
    }
};
