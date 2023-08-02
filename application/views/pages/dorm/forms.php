
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Asrama</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url(isset($dorm->id) ? "dorm/update_dorm" : "dorm/add_dorm")  ?>">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= isset($dorm->name) ? $dorm->name : "" ?>" required>
                </div>
                 <div class="form-group">
                    <label for="phone">No. HP</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= isset($dorm->phone) ? $dorm->phone : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" name="address" id="address" rows="3" required>
                        <?= isset($dorm->address) ? $dorm->address : "" ?>
                    </textarea>
                </div>

                <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($dorm->id) ?  $dorm->id : "" ?>" required>
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= base_url("dorm") ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><?= isset($dorm->id) ? "Ubah" : "Simpan" ?></button>
                </div>
            </form>
        </div>
    </div>
</div>