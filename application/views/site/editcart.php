<h2 class="mt-4 mb-2">Informasi Obat</h2>

<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-8 mb-lg-0 mb-4">
        <img width="100%" style="padding: 0" src="<?= base_url('img/medicine.png') ?>" class="img-thumbnail rounded" alt="...">
    </div>
    <div class="col-lg-9 col-md-12 col-sm-12 col-12">
        <h4><?= $detail['nama'] ?></h4>
        <div class="row">
            <!-- <div class="col-6">
                <p class="mb-2"><i class="fas fa-dot-circle text-danger" style="font-size:12px;"></i> <b>STATUS :</b> Completed</p>
                <p><i class="fas fa-dot-circle text-danger" style="font-size:12px;"></i> <b>RILIS :</b> <?= $tglRilis ?></p>
            </div> -->

            <div class="col-6">
                <p class="mb-2"><i class="fas fa-dot-circle text-danger" style="font-size:12px;"></i> <b>HARGA : Rp </b> <?= number_format($detail['harga']) ?> </p>
                <p><i class="fas fa-dot-circle text-danger" style="font-size:12px;"></i> <b>RATING :</b> <?= rand(3, 5) ?> <i class="fas fa-star text-warning"></i></p>
            </div>
        </div>

        <a href="<?= base_url('site/search_genre/' . $detail['idkategori']) ?>" class="badge badge-warning badge-pill py-2 px-3 mr-1 mb-2" style="font-size:14px"><?= $detail['kategori'] ?></a>

        <form style="display: flex;flex-direction: row;align-items: center;" action="<?= base_url('site/updatecart') ?>" method="post">
            <input type="hidden" value="<?= $detail['id'] ?>" name="id">
            <input type="hidden" value="<?= $detail['harga'] ?>" name="harga">
            <input type="number" min="1" max="99" class="mr-3" placeholder="jml" value="1" name="jml" >
            <button type="submit" id="add-to-cart" href="<?= base_url('site/search_genre/' . $detail['idkategori']) ?>" class="badge badge-info badge-pill py-3 px-3 mr-1 mb-2" style="font-size: 16px"><i class="fas fa-edit"></i> Ubah Keranjang</a>
        </form>
    </div>
</div>