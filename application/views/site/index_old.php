<?php // echo md5('admin'); ?>
<?php //dd($_SESSION); ?>
<?php flash('welcome') ?>
<?php flash('access') ?>


<h3 class="mb-4">Obat Terlaris</h3>

<div class="row row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2">
    <?php foreach ($latest_aired as $barang) :  ?>
        <div class="col pr-0 mb-4">

            <a href="<?= base_url('site/movie/'.$barang['id']) ?>">
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

<h3 class="my-4">Baru Ditambahkan</h3>

<div class="row row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2">
    <?php foreach ($recently_added as $barang) :  ?>
        <div class="col pr-0 mb-4">

            <a href="<?= base_url('site/movie/'.$barang['id']) ?>">
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