<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap-select.min.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('img/movie-icon-png.jpg') ?>" type="image/x-icon">
    <title>MASKER.CI</title>
    <!-- Font Awesome Script -->
    <script src="https://kit.fontawesome.com/bc14fa0285.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/jquery-3.6.0.min.js') ?>"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url() ?>">Sampah Masker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo01">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if (!$this->session->has_userdata('id')) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("auth/login") ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("auth/register") ?>">Register</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Akun
                            </a>
                            <ul class="dropdown-menu dropdown-menu-">
                                <li><a class="dropdown-item" href="<?= base_url("akun/qr") ?>">QR Code</a></li>
                                <li><a class="dropdown-item" href="<?= base_url("akun/riwayat_mutasi?tglawal=" . date('Y-m-d') . "&tglakhir=" . date('Y-m-d')) ?>">Riwayat Mutasi</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("auth/logout") ?>">Logout</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        $(document).ready(function() {
            $('#searchbar').on('input', function(e) {
                // console.log('onChange gan', e.target.value)
                let q = e.target.value

                if (q == '') {
                    // Kolom pencarian kosong,
                    $("#popup-search").empty() // Kosongkan container
                    return
                }
                $.ajax({
                    url: `<?= base_url() ?>/site/searchajax/${q}`,
                    dataType: 'JSON',
                    success: function(res) {
                        // console.log('res ajax', typeof res)

                        $("#popup-search").empty() // Kosongkan container
                        for (let i = 0; i < res.length; i++) {
                            const film = res[i];
                            // Append elemen hasil pencarian
                            // console.log('film gan', film)
                            $("#popup-search").append(`
                            <a href="<?= base_url() ?>/site/movie/${film.id}">
                                <div class="p-1" style="display: flex;flex-direction: row;">
                                    <div class="thumbnail-wrap mr-2" style="flex: 0.2;">
                                        <!-- Image Overlay -->
                                        <div class="overlay">
                                            <i style="font-size: 48px;color:white" class="fas fa-play-circle"></i>
                                        </div>
                                        <img width="100%" style="height:72px !important;padding: 0" src="<?= base_url() ?>/img/thumbnails/${film.id}.jpg" class="img-thumbnail rounded" alt="...">
                                    </div>
                                    <div class="" style="flex: 0.8;">
                                        <h6>${film.judul}</h6>
                                        <p style="font-size: 12px;color: #aaa;"><i class="fas fa-star"></i> ${film.rating}, Dec 23, 2021, <i class="fas fa-clock"></i> ${film.durasi} menit</p>
                                    </div>
                                </div>
                            </a>
                            `)
                        }
                    }
                });
            })
        })
    </script>
    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Opening Tag Container -->
    <div class="container pt-5 pb-5">