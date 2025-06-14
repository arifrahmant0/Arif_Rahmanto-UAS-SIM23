<div class="container mt-4">
    <h2>Buat Sales Order</h2>
    <form action="<?= base_url('sales/salesorder/simpan') ?>" method="post">
        <div class="form-group">
            <label for="pelanggan_id">Pilih Pelanggan</label>
            <select name="pelanggan_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                <?php foreach ($customers as $c): ?>
                    <option value="<?= $c->id ?>"><?= $c->nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <hr>
        <h4>Produk</h4>
        <div id="produk-wrapper">
            <div class="produk-row row mb-3">
                <div class="col-md-5">
                    <select name="produk_id[]" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produk as $p): ?>
                            <option value="<?= $p->id ?>" data-harga="<?= $p->harga ?>">
                                <?= $p->nama_produk ?> - Rp <?= number_format($p->harga) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="jumlah[]" class="form-control jumlah" placeholder="Jumlah" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="harga_satuan[]" class="form-control harga_satuan" placeholder="Harga Satuan" required readonly>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-row">Hapus</button>
                </div>
            </div>
        </div>

        <button type="button" id="tambah-produk" class="btn btn-secondary">+ Tambah Produk</button>
        <br><br>
        <button type="submit" class="btn btn-primary">Simpan Order</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('produk-wrapper');
        const tambahBtn = document.getElementById('tambah-produk');

        tambahBtn.addEventListener('click', function() {
            const clone = wrapper.querySelector('.produk-row').cloneNode(true);
            clone.querySelectorAll('input').forEach(input => input.value = '');
            clone.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            wrapper.appendChild(clone);
        });

        wrapper.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                const rows = wrapper.querySelectorAll('.produk-row');
                if (rows.length > 1) e.target.closest('.produk-row').remove();
            }
        });

        wrapper.addEventListener('change', function(e) {
            if (e.target.name === 'produk_id[]') {
                const selected = e.target.options[e.target.selectedIndex];
                const harga = selected.getAttribute('data-harga');
                e.target.closest('.produk-row').querySelector('.harga_satuan').value = harga;
            }
        });
    });
</script>