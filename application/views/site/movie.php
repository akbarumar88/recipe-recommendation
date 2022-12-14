<!-- <h3 class="mb-4">Hasil Pencarian untuk</h3> -->
<?php

$tglRilis = formatDate($barang['tgl_dibuat'], "M d, Y");
flash('addcart');

?>

<h2 class="mt-4"><?= $barang['nama'] ?></h2>
<p class=""><?= $barang['deskripsi'] ?></p>

<h2 class="mt-4 mb-2">Informasi Obat</h2>

<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-8 mb-lg-0 mb-4">
        <img width="100%" style="padding: 0" src="<?= base_url('img/medicine.png') ?>" class="img-thumbnail rounded" alt="...">
    </div>
    <div class="col-lg-9 col-md-12 col-sm-12 col-12">
        <h4><?= $barang['nama'] ?></h4>
        <div class="row">
            <!-- <div class="col-6">
                <p class="mb-2"><i class="fas fa-dot-circle text-danger" style="font-size:12px;"></i> <b>STATUS :</b> Completed</p>
                <p><i class="fas fa-dot-circle text-danger" style="font-size:12px;"></i> <b>RILIS :</b> <?= $tglRilis ?></p>
            </div> -->

            <div class="col-6">
                <p class="mb-2"><i class="fas fa-dot-circle text-danger" style="font-size:12px;"></i> <b>HARGA : Rp </b> <?= number_format($barang['harga']) ?> </p>
                <p><i class="fas fa-dot-circle text-danger" style="font-size:12px;"></i> <b>RATING :</b> <?= rand(3, 5) ?> <i class="fas fa-star text-warning"></i></p>
            </div>
        </div>

        <a href="<?= base_url('site/search_genre/' . $barang['idkategori']) ?>" class="badge badge-warning badge-pill py-2 px-3 mr-1 mb-2" style="font-size:14px"><?= $barang['kategori'] ?></a>

        <form style="display: flex;flex-direction: row;align-items: center;" action="<?= base_url('site/addcart') ?>" method="post">
            <input type="hidden" value="<?= $barang['id'] ?>" name="id">
            <input type="hidden" value="<?= $barang['harga'] ?>" name="harga">
            <input type="number" min="1" max="99" class="mr-3" placeholder="jml" value="1" name="jml" >
            <button type="submit" id="add-to-cart" href="<?= base_url('site/search_genre/' . $barang['idkategori']) ?>" class="badge badge-primary badge-pill py-3 px-3 mr-1 mb-2" style="font-size: 16px"><i class="fas fa-plus"></i> Tambahkan ke Keranjang</a>
        </form>
    </div>
</div>

<?php if (!empty($related_barang)) : ?>
    <h2 class="mt-5 mb-2">Obat Terkait</h2>
    <div class="row row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2">
        <?php foreach ($related_barang as $barang) :  ?>
            <div class="col pr-0 mb-4">

                <a href="<?= base_url('site/movie/' . $barang['id']) ?>">
                    <div class="thumbnail-wrap">
                        <!-- Durasi -->
                        <div class="durasi py-1 px-2">
                            <i class="fas fa-tag"></i>
                            <b>Rp <?= number_format($barang['harga'], 0, ',', '.') ?></b>
                        </div>
                        <!-- Rating -->
                        <div class="rating py-1 px-2">
                            <i class="fas fa-star"></i>
                            <b><?= rand(3, 5) ?></b>
                        </div>
                        <!-- HD Badge -->
                        <!-- <div class="hd py-1 px-2"><b>Ori</b></div> -->
                        <!-- Image Overlay -->
                        <div class="overlay">
                            <i style="font-size: 48px;color:white" class="fas fa-play-circle"></i>
                        </div>
                        <img width="100%" style="padding: 0" src="<?= base_url('img/medicine.png') ?>" class="img-thumbnail rounded" alt="...">
                    </div>
                    <h6 class="text-center mt-2"><?= limit($barang['nama'], 7) ?></h6>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>