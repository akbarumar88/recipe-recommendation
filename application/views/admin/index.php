<?php flash('succadd') ?>

<h3 class="mb-4">Data Kategori TOKO.CI</h3>

<a class="btn btn-primary" href="<?= base_url('admin/addmovie') ?>" role="button"><i class="fas fa-plus"></i> Tambah Kategori</a>

<form class="form-inline mt-3 " action="">
    <input class="form-control mr-sm-2" type="text" name="q" placeholder="Search" value="<?= $this->input->get('q') ?>">
    <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
</form>

<div class="mb-4"></div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Kategori</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $grandtotal = 0;
        $start = microtime(true);
        foreach ($kategori as $i => $item) :
            
        ?>
            <tr>
                <th scope="row"><?= $i + 1 ?></th>
                <td><?= $item['nama'] ?></td>
                <td>
                    <div class="row">
                        <a href="<?= base_url('site/editcart/' . $item['id']) ?>" class="btn btn-warning py-1 px-2 mr-2">Ubah</a>
                        <form action="<?= base_url('site/removecart') ?>" method="post" class="mb-0">
                            <input type="hidden" value="<?= $item['id'] ?>" name="idpesanandetail">
                            <button type="submit" class="btn btn-danger py-1 px-2">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php 
            endforeach;
            $end = microtime(true);
        ?>

    </tbody>
</table>

<?php
$timeDiff = $end - $start;
$timeDiffInSecond = $timeDiff / (1000000);
dd([
    'timeDiff' => $timeDiff,
]);
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