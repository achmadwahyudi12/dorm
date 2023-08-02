
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
            </div>
        </div>
        <div class="card-body">
            <?php if($this->session->flashdata('change_password_message_success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('change_password_message_success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php if($this->session->flashdata('change_password_message_failed')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('change_password_message_failed') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <form method="POST" action="<?= base_url("auth/save_change_password")  ?>">
                <div class="form-group">
                    <label for="old_password">Password lama</label>
                    <input class="form-control" type="text" name="old_password" id="old_password" required>
                </div>             
                <div class="form-group">
                    <label for="new_password">Password baru</label>
                    <input class="form-control" type="text" name="new_password" id="new_password" required>
                </div>             
                <div class="form-group">
                    <label for="new_password_confirmation">Konfirmas password baru</label>
                    <input class="form-control" type="text" name="new_password_confirmation" id="new_password_confirmation" required>
                </div>             

                <input type="hidden" id="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= base_url() ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>