<?php if (!empty($res)) : ?>
    <h3 class="mb-4">Kategori "<?= $kategori ?>"</h3>

    <div class="row row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2">
        <?php foreach ($res as $barang) :  ?>
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
<?php else : ?>
    <p class="text-center"><i class="fas fa-search display-1"></i></p>
    <h3 class="mb-4 text-center">Maaf! Tidak ada hasil yang ditemukan untuk "<?= $q  ?>"</h3>
    <p class="text-center">Maaf, film yang anda cari tidak ditemukan. Harap coba lagi dengan kata kunci yang lain.</p>
<?php endif; ?>

<?php

$currentPage = !empty($this->input->get('p')) ? $this->input->get('p') : 1;

?>

<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item <?= $currentPage == 1 ? 'disabled' : ''  ?>">
            <a class="page-link">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
            <li class="page-item <?= $i == $currentPage ? 'disabled' : ''  ?>"><a class="page-link" href="<?= "?p=$i" ?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <li class="page-item <?= $currentPage == $totalPage ? 'disabled' : ''  ?>">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>