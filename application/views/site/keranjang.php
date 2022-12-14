<?php 
flash('removecart');
flash('editcart');
?>

<h2 class="mt-4 mb-2">Keranjang</h2>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $grandtotal = 0;
        foreach ($keranjang as $i => $item) :
            $subtotal = $item['harga'] * $item['jml'];
            $grandtotal += $subtotal;
        ?>
            <tr>
                <th scope="row"><?= $i + 1 ?></th>
                <td><?= $item['nama'] ?></td>
                <td><?= $item['jml'] ?></td>
                <td><?= number_format($item['harga']) ?></td>
                <td><?= number_format($subtotal) ?></td>
                <td>
                    <div class="row">
                        <a href="<?= base_url('site/editcart/'.$item['id']) ?>" class="btn btn-warning py-1 px-2 mr-2">Ubah</a>
                        <form action="<?= base_url('site/removecart') ?>" method="post">
                            <input type="hidden" value="<?= $item['id'] ?>" name="idpesanandetail">  
                            <button type="submit" class="btn btn-danger py-1 px-2">Hapus</a>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
<h3>Grand Total: <?= number_format($grandtotal) ?></h3>