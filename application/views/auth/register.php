<?= flash('errregister') ?>

<form method="POST">
    <div class="form-group mb-3">
        <label class="form-label" for="nama">Nama Lengkap</label>
        <input required type="text" class="form-control" id="nama" aria-describedby="emailHelp" name="nama_lengkap" value="<?= $this->input->post('nama_lengkap') ?>">
        <small id="emailHelp" class="form-text text-muted">Masukkan nama lengkap anda.</small>
    </div>
    <div class="form-group mb-3">
        <label class="form-label" for="username">Username</label>
        <input required type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" value="<?= $this->input->post('username') ?>">
        <small id="emailHelp" class="form-text text-muted">Masukkan username anda.</small>
    </div>
    <div class="form-group mb-3">
        <label class="form-label" for="email">E-mail</label>
        <input required type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?= $this->input->post('email') ?>">
        <small id="emailHelp" class="form-text text-muted">Masukkan e-mail anda.</small>
    </div>
    <div class="form-group mb-3">
        <label class="form-label" for="password">Password</label>
        <input required type="password" class="form-control" id="password" name="pass" value="<?= $this->input->post('pass') ?>">
        <small id="emailHelp" class="form-text text-muted">Masukkan kata sandi.</small>
    </div>
    <!-- <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>