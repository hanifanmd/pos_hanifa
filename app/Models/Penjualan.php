<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
    'user_id',
    'total_pembayaran',
    'metode_pembayaran',
    'bayar',
    'kembalian',
    'status',
    'ada_kartu_ucapan',
    'pengirim',
    'penerima',
    'bunga',
    'jumlah_tangkai',
    'harga_per_tangkai',
    'biaya_kartu_ucapan',
    'hiasan',
    'kartu_ucapan',
];

    

     public function user()
     {
        return $this->belongsTo(User::class,'user_id');
     }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }
}
