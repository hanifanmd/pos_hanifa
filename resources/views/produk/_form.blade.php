@csrf

@if (!empty($produk->foto))
<div class="mb-2">
    <label>Foto Saat Ini</label><br>
    <img src="{{ asset('storage/' . $produk->foto) }}"
        width="150"
        class="img-thumbnail">
</div>
@endif
<div class="row">
<div class="col">
<div>
    <label>Gambar</label>
    <input type="file"
            name="foto"
            onchange="previewImage(this)"
            class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
    </div>
</div>
<div class="col">
<div class="mb-2">
<label> Preview Foto</label><br>
<img id="preview" class="img-thumbnail mt-2" style="display:noen" width="150">
</div>
</div>
</div>
<div>
    <label>Nama Produk</label><br>
    <input type="text" name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $produk->nama ?? '') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
</div>

<div>
    <label>Harga Beli</label><br>
    <input type="number" name="purchase_price"
            class="form-control @error('purchase_price') is-invalid @enderror"
            value="{{ old('purchase_price', $produk->harga_beli?? '') }}">
            @error('purchase_price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
</div>

<div>
    <label>Harga Jual</label><br>
    <input type="number" name="selling_price"
            class="form-control @error('selling_price') is-invalid @enderror"
            value="{{ old('selling_price', $produk->harga_jual  ?? '') }}">
            @error('selling_price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
</div>

<div>
    <label>Persediaan</label><br>
    <input type="number" name="stock"
            class="form-control @error('stock') is-invalid @enderror"
            value="{{ old('stock', $produk->stok ?? '') }}">
            @error('stock')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const purchaseInput = document.querySelector('input[name="purchase_price"]');
        const sellingInput = document.querySelector('input[name="selling_price"]');

        if (!purchaseInput || !sellingInput) {
            return;
        }

        purchaseInput.addEventListener('input', function () {
            const hargaBeli = Number(this.value);

            if (hargaBeli > 0 && (sellingInput.value === '' || sellingInput.dataset.autoFilled === 'true')) {
                const hargaJual = Math.ceil(hargaBeli * 1.3);
                sellingInput.value = hargaJual;
                sellingInput.dataset.autoFilled = 'true';
            }
        });

        sellingInput.addEventListener('input', function () {
            if (this.value !== '') {
                this.dataset.autoFilled = 'false';
            }
        });
    });
</script>