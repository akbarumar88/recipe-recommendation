<?php // echo md5('admin'); 
?>
<?php //dd($_SESSION); 
$page = $this->input->get('page');
if (empty($page)) $page = 1;
$offset = ($page - 1) * 15;
?>
<?php flash('welcome') ?>
<?php flash('access') ?>


<h3 class="mb-4">Riwayat Mutasi</h3>

<h6 class="">Sisa Saldo</h6>
<h4 class="mb-4 fw-semibold">Rp<?= number_format($saldo) ?></h4>

<!-- Filter View -->
<form class="row gy-2 gx-3 align-items-center" id="filter">
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Cari Keterangan</label>
        <input name="cari" type="text" class="form-control" id="autoSizingInput" value="<?= $this->input->get("cari") ?>" placeholder="Cari Keterangan">
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="tglawal">Tanggal Awal</label>
        <input type="date" name="tglawal" id="tglawal" value="<?= $this->input->get("tglawal") ?>" class="form-control">
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="tglakhir">Tanggal Akhir</label>
        <input type="date" name="tglakhir" id="tglakhir" value="<?= $this->input->get("tglakhir") ?>" class="form-control">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>

<div class="table-responsive mt-4">
    <table class="table">
        <thead class="table-light">
            <tr>
                <th>No.</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Kredit</th>
                <th>Debit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mutasi as $i => $mut) : ?>
                <tr>
                    <td><?= $offset + ($i + 1) ?></td>
                    <td><?= $mut['keterangan'] ?></td>
                    <td><?= $mut['tgl'] ?></td>
                    <td><?= number_format($mut['kredit']) ?></td>
                    <td><?= number_format($mut['debit']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if (empty($mutasi)) : ?>
    <p class="text-center">Tidak ada data</p>
<?php endif ?>

<?php

$pageCount = ceil($count / 15);
// dd($pageCount);

$isPrevDisabled = $page == 1 ? 'disabled' : '';
$isNextDisabled = $page == $pageCount ? 'disabled' : '';

?>

<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item <?= $isPrevDisabled ?>">
            <a class="page-link">Previous</a>
        </li>
        <?php
        for ($i = 1; $i <= $pageCount; $i++) :
            $isActive = $page == $i ? 'active' : '';
            $queryParam = http_build_query([
                'tglawal' => $this->input->get('tglawal'),
                'tglakhir' => $this->input->get('tglakhir'),
                'cari' => $this->input->get('cari'),
                'page' => $i,
            ]);
            $href = $page == $i ? '#' : base_url("akun/riwayat_mutasi?$queryParam");
        ?>
            <li class="page-item <?= $isActive ?>"><a class="page-link" href="<?= $href ?>"><?= $i ?></a></li>
        <?php endfor ?>
        <li class="page-item <?= $isNextDisabled ?>">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>

<script type="text/javascript">
    $(document).ready(function() {
        $('#filter').submit(function(e) {
            let tglawal = $('#tglawal').val()
            let tglakhir = $('#tglakhir').val()
            console.log({
                tglawal,
                tglakhir
            })

            if (tglawal > tglakhir) {
                alert("Tanggal awal tidak boleh melebihi tanggal akhir")
                e.preventDefault()
            }

            var a = moment(tglawal);
            var b = moment(tglakhir);
            let diff = Math.abs(a.diff(b, 'days')) // 1

            console.log({
                diff
            })
            if (diff > 30) {
                alert("Jangkauan filter tanggal maksimal 30 hari")
                e.preventDefault()
            }
            // e.preventDefault()
        })
    })
</script>