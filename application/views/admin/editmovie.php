<a href="<?= base_url("admin/deletemovie/{$movie['id']}") ?>" onclick="return confirm('Apakah anda yakin ingin menghapus film ini?')" class="btn btn-danger mb-2"><i class="fas fa-trash"></i> Hapus Film</a>

<h3 class="mb-4 mt-2">Ubah Film</h3>

<?php 

// dd($movie);

if (!$this->input->post()) {
    // Jika belum submit, ambil value dari db
    $judul = $movie['judul'];
    $sinopsis = $movie['sinopsis'];
    $tglrilis = $movie['tglrilis'];
    $durasi = $movie['durasi'];
    $rating = $movie['rating'];
    $link_hd = $movie['link_hd'];
    $link_sd = $movie['link_sd'];
} else {
    // Sudah submit, isi dengan inputan POST.
    $judul = $this->input->post('judul');
    $sinopsis = $this->input->post('sinopsis');
    $tglrilis = $this->input->post('tglrilis');
    $durasi = $this->input->post('durasi');
    $rating = $this->input->post('rating');
    $link_hd = $this->input->post('link_hd');
    $link_sd = $this->input->post('link_sd');
}

?>

<form method="POST" enctype="multipart/form-data" id="myform">
    <input type="hidden" name="id" value="<?= $movie['id'] ?>">
    <div class="form-group">
        <label for="exampleInputEmail1">Judul Film</label>
        <input required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="judul" value="<?=  $judul ?>">
        <small id="emailHelp" class="form-text text-muted">Masukkan judul film.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Sinopsis</label>
        <textarea rows="6" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sinopsis"><?= $sinopsis ?></textarea>
        <small id="emailHelp" class="form-text text-muted">Masukkan sinopsis film.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Tanggal Rilis</label>
        <input required type="date" class="form-control" id="exampleInputPassword1" name="tglrilis" value="<?=  $tglrilis ?>">
        <small id="emailHelp" class="form-text text-muted">Tanggal Rilis Film.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Durasi</label>
        <input required type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="durasi" value="<?=  $durasi ?>">
        <small id="emailHelp" class="form-text text-muted">Durasi film.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Rating</label>
        <input min="1" max="10" required type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rating" value="<?=  $rating ?>" step="0.1">
        <small id="emailHelp" class="form-text text-muted">Rating Film.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Link Video SD</label>
        <input required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="link_sd" value="<?= $link_sd ?>">
        <small id="emailHelp" class="form-text text-muted">Link Video SD Film.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Link Video HD</label>
        <input required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="link_hd" value="<?= $link_hd ?>">
        <small id="emailHelp" class="form-text text-muted">Link Video HD Film.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Thumbnail Film</label>
        <input type="file" class="form-control-file" id="exampleInputEmail1" aria-describedby="emailHelp" name="gambar" accept=".jpeg,.jpg,.png">
        <small id="emailHelp" class="form-text text-muted">Gambar Thumbnail Film.</small>
    </div>

    <div class="form-row" id="genre-wrapper">
        <!-- Loop data genre -->
        <?php foreach($movie['genre'] as $genre): ?>
            <a onclick="removeGenre(event)" href="#." class="badge badge-warning badge-pill py-2 px-3 mr-1 mb-2" style="font-size:14px" data-value="<?= $genre['idgenre'] ?>"><?= $genre['genre'] ?></a>
        <?php endforeach; ?>
    </div>

    <!-- <div class="form-row"> -->
        <div class="form-group">
            <!-- <input type="email" class="form-control" id="inputEmail4"> -->
            <select id="select-genre" class="selectpicker" data-live-search="true">
                <?php foreach($genres as $genre): ?>
                    <option value="<?= $genre['id']  ?>"><?= $genre['genre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button id="b-tambahgenre" type="button" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Genre</button>
        </div>
    
    <?php foreach($movie['genre'] as $genre): ?>
        <input class="h-genre" type="hidden" value="<?= $genre['idgenre'] ?>" name="genre[]" />
    <?php endforeach; ?>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php 

$idgenres = array_map(function ($item) {
    return $item['idgenre'];
}, $movie['genre']);

?>

<script>
    let added_genres = <?= json_encode($idgenres) ?>

    function removeGenre(e) {
        let currentElement = e.target
        // Hapus element badge nya
        currentElement.parentNode.removeChild(currentElement);
        console.log('masuk gan', e.target)

        // Hapus input type hiddennya, agar tidak masuk form POST
        let idgenre = e.target.getAttribute('data-value')
        // console.log({idgenre})
        $(`.h-genre[value=${idgenre}]`).remove()

        // Hapus dari daftar added_genres, agar bisa ditambah lagi
        added_genres = added_genres.filter(item => item != idgenre)
    }

    $(document).ready(function() {

        $("#b-tambahgenre").click(function() {
            let idgenre = $("#select-genre").val()
            let genre = $('#select-genre :selected').text()
            console.log({idgenre,genre})
            if (added_genres.indexOf(idgenre) != -1) {
                // Jika genre sudah ditambahkan, maka block
                alert('Anda sudah menambahkan genre ini.')
                return
            }
            // Append badge ke container
            $("#genre-wrapper").append(`
                <a onclick="removeGenre(event)" href="#." class="badge badge-warning badge-pill py-2 px-3 mr-1 mb-2" style="font-size:14px" data-value="${idgenre}">${genre}</a>
            `)
            // Append input type hidden
            $("#myform").append(`
                <input class="h-genre" type="hidden" value="${idgenre}" name="genre[]" />
            `)
            added_genres = [...added_genres, idgenre]
        })

        $("#myform").submit(function(e) {
            // Mengecek apakah sudah menambahkan genre
            if (!added_genres.length) {
                alert("Harap tambahkan genre terlebih dahulu.")
                e.preventDefault()
            }
        })
    })
</script>