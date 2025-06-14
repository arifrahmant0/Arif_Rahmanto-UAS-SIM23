<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3>Buat Sales Order</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('sales/order/store'); ?>" method="post">
                <!-- Pilih Pelanggan -->
                <div class="form-group">
                    <label for="pelanggan_id">Pilih Pelanggan</label>
                    <select name="pelanggan_id" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($pelanggan as $c): ?>
                            <option value="<?= $c->id ?>"><?= $c->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>



                <!-- Produk -->
                <table class="table table-bordered" id="produk-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th><button type="button" class="btn btn-sm btn-success" id="addRow">+</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="produk_id[]" class="form-control produk-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    <?php foreach ($produk as $p): ?>
                                        <option value="<?= $p->id; ?>" data-harga="<?= $p->harga; ?>">
                                            <?= $p->nama_produk; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="number" name="jumlah[]" class="form-control jumlah" required></td>
                            <td><input type="number" name="harga_satuan[]" class="form-control harga_satuan" readonly></td>
                            <td><input type="number" name="total_harga[]" class="form-control total_harga" readonly></td>
                            <td><button type="button" class="btn btn-sm btn-danger removeRow">-</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Simpan Order</button>
            </form>
        </div>
    </section>
</div>