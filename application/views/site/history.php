<h3 class="mb-4">Hari Ini</h3>

<div class="row row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2">
    <?php foreach ($history as $movie) :  ?>
        <div class="col pr-0 mb-4">

            <a href="<?= base_url('site/movie/'.$movie['id']) ?>">
                <div class="thumbnail-wrap">
                    <!-- Durasi -->
                    <div class="durasi py-1 px-2">
                        <i class="fas fa-clock"></i>
                        <b><?= $movie['durasi'] ?>m</b>
                    </div>
                    <!-- Rating -->
                    <div class="rating py-1 px-2">
                        <i class="fas fa-star"></i>
                        <b><?= $movie['rating'] ?></b>
                    </div>
                    <!-- HD Badge -->
                    <div class="hd py-1 px-2"><b>HD</b></div>
                    <!-- Image Overlay -->
                    <div class="overlay">
                        <i style="font-size: 48px;color:white" class="fas fa-play-circle"></i>
                    </div>
                    <img width="100%" style="height:300px !important;padding: 0" src="<?= base_url('img/thumbnails/' . $movie['id'] . '.jpg') ?>" class="img-thumbnail rounded" alt="...">
                </div>
                <h6 class="text-center mt-2"><?= limit($movie['judul'], 7) ?></h6>
            </a>
        </div>
    <?php endforeach; ?>
</div>