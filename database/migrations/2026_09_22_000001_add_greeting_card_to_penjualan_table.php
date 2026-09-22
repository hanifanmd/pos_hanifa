<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->boolean('ada_kartu_ucapan')->default(false)->after('status');
            $table->string('pengirim')->nullable()->after('ada_kartu_ucapan');
            $table->string('penerima')->nullable()->after('pengirim');
            $table->string('bunga')->nullable()->after('penerima');
            $table->integer('jumlah_tangkai')->nullable()->after('bunga');
            $table->decimal('harga_per_tangkai', 15, 2)->default(0)->after('jumlah_tangkai');
            $table->integer('biaya_kartu_ucapan')->default(0)->after('harga_per_tangkai');
            $table->string('hiasan')->nullable()->after('biaya_kartu_ucapan');
            $table->string('kartu_ucapan')->nullable()->after('hiasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn([
                'ada_kartu_ucapan',
                'pengirim',
                'penerima',
                'bunga',
                'jumlah_tangkai',
                'harga_per_tangkai',
                'biaya_kartu_ucapan',
                'hiasan',
                'kartu_ucapan',
            ]);
        });
    }
};