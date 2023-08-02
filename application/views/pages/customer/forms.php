
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Pelanggan</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url(isset($customer->id) ? "customer/update_customer" : "customer/add_customer")  ?>">
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="<?= isset($customer->nik) ?  $customer->nik : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= isset($customer->name) ? $customer->name : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="gender">Jenis kelamin</label>
                    <div id="gender">
                        <label>
                            <input type="radio" id="gender" name="gender" value="L" <?= isset($customer->gender) && $customer->gender == "L" ? "checked" : "" ?>  required>
                            Laki - laki
                        </label>
                        <label class="ml-5">
                            <input type="radio" id="gender" name="gender" value="P" <?= isset($customer->gender) && $customer->gender == "P" ? "checked" : "" ?> required>
                            Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">No. HP</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= isset($customer->phone) ? $customer->phone : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone_emergency">No. HP (Darurat)</label>
                    <input type="text" class="form-control" id="phone_emergency" name="phone_emergency" value="<?= isset($customer->phone_emergency) ? $customer->phone_emergency : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" name="address" id="address" rows="3" required>
                        <?= isset($customer->address) ? $customer->address : "" ?>
                    </textarea>
                </div>

                <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($customer->id) ?  $customer->id : "" ?>" required>
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= base_url("customer") ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><?= isset($customer->id) ? "Ubah" : "Simpan" ?></button>
                </div>
            </form>
        </div>
    </div>
</div>