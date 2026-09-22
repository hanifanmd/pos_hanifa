<?php

namespace Tests\Feature;

use App\Http\Requests\Penjualan\CheckoutRequest;
use Illuminate\Support\Str;
use Tests\TestCase;

class PenjualanCheckoutRequestTest extends TestCase
{
    public function test_checkout_request_validates_greeting_card_message(): void
    {
        $request = new CheckoutRequest();
        $rules = $request->rules();

        $this->assertArrayHasKey('ada_kartu_ucapan', $rules);
        $this->assertArrayHasKey('pengirim', $rules);
        $this->assertArrayHasKey('penerima', $rules);
        $this->assertArrayHasKey('bunga', $rules);
        $this->assertArrayHasKey('jumlah_tangkai', $rules);
        $this->assertArrayHasKey('harga_per_tangkai', $rules);
        $this->assertArrayHasKey('hiasan', $rules);
        $this->assertArrayHasKey('kartu_ucapan', $rules);
        $this->assertTrue(Str::contains($rules['bunga'], 'required_if:ada_kartu_ucapan,1'));
        $this->assertTrue(Str::contains($rules['jumlah_tangkai'], 'required_if:ada_kartu_ucapan,1'));
        $this->assertTrue(Str::contains($rules['harga_per_tangkai'], 'required_if:ada_kartu_ucapan,1'));
        $this->assertTrue(Str::contains($rules['hiasan'], 'required_if:ada_kartu_ucapan,1'));
    }
}
