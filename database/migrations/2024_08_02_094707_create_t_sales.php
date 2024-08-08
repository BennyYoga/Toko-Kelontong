<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('t_sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('kode', 15)->unique();
            $table->timestamp('tanggal');
            $table->integer(('customer_id'));
            $table->float(('subtotal'));
            $table->float(('diskon'));
            $table->float(('ongkir'));
            $table->float(('total_bayar'));

            $table->foreign('customer_id')->references('id')->on('m_customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_sales');
    }
};
