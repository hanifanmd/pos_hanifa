<?php

namespace App\Http\Requests\Penjualan;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_method' => 'required|in:CASH,QRIS',
            'bayar' => 'required_if:payment_method,CASH|nullable',
            'ada_kartu_ucapan' => 'nullable|boolean',
            'pengirim' => 'required_if:ada_kartu_ucapan,1|nullable|string|max:100',
            'penerima' => 'required_if:ada_kartu_ucapan,1|nullable|string|max:100',
            'bunga' => 'required_if:ada_kartu_ucapan,1|nullable|string|max:100',
            'jumlah_tangkai' => 'required_if:ada_kartu_ucapan,1|nullable|integer|min:1|max:100',
            'harga_per_tangkai' => 'required_if:ada_kartu_ucapan,1|nullable|numeric|min:0',
            'hiasan' => 'required_if:ada_kartu_ucapan,1|nullable|string|max:150',
            'kartu_ucapan' => 'required_if:ada_kartu_ucapan,1|nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method.required' => 'Metode pembayaran wajib dipilih.',
            'payment_method.in' => 'Metode pembayaran tidak valid.',
            'bayar.required_if' => 'Nominal uang yang dibayarkan wajib diisi untuk pembayaran tunai.',
            'ada_kartu_ucapan.boolean' => 'Pilihan kartu ucapan tidak valid.',
            'pengirim.required_if' => 'Nama pengirim wajib diisi jika memilih kartu ucapan.',
            'pengirim.max' => 'Nama pengirim maksimal 100 karakter.',
            'penerima.required_if' => 'Nama penerima wajib diisi jika memilih kartu ucapan.',
            'penerima.max' => 'Nama penerima maksimal 100 karakter.',
            'bunga.required_if' => 'Jenis bunga wajib dipilih jika memilih kartu ucapan.',
            'bunga.max' => 'Jenis bunga maksimal 100 karakter.',
            'jumlah_tangkai.required_if' => 'Jumlah tangkai bunga wajib diisi jika memilih kartu ucapan.',
            'jumlah_tangkai.integer' => 'Jumlah tangkai bunga harus berupa angka.',
            'jumlah_tangkai.min' => 'Jumlah tangkai bunga minimal 1.',
            'jumlah_tangkai.max' => 'Jumlah tangkai bunga maksimal 100.',
            'harga_per_tangkai.required_if' => 'Harga per tangkai bunga wajib diisi jika memilih kartu ucapan.',
            'harga_per_tangkai.numeric' => 'Harga per tangkai bunga harus berupa angka.',
            'harga_per_tangkai.min' => 'Harga per tangkai bunga tidak boleh negatif.',
            'hiasan.required_if' => 'Deskripsi hiasan wajib diisi jika memilih kartu ucapan.',
            'hiasan.max' => 'Deskripsi hiasan maksimal 150 karakter.',
            'kartu_ucapan.required_if' => 'Pesan kartu ucapan wajib diisi jika memilih kartu ucapan.',
            'kartu_ucapan.max' => 'Pesan kartu ucapan maksimal 255 karakter.',
        ];
    }
}
