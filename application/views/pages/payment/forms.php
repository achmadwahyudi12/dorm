
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Booking</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url(isset($booking->id) ? "booking/update_booking" : "booking/add_booking")  ?>">
                <div class="form-group">
                    <label for="customer_id">Pelanggan</label>
                    <select class="form-control" id="customer_id" name="customer_id" required>
                        <option value="">Pilih pelanggan ...</option>
                        <?php foreach ($list_customer as $customer) : ?>
                            <option value="<?= $customer["id"] ?>"><?= $customer["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="room_id">Kamar</label>
                    <select class="form-control" id="room_id" name="room_id" required>
                        <option value="">Pilih Kamar ...</option>
                        <?php foreach ($list_dorm as $dorm) : ?>
                            <option value="<?= $dorm['id'] ?>"><?= $dorm["name_dorm"] . " (Lantai-" . $dorm["floor"] . " Kamar-" . $dorm["name"] . ")" ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input class="form-control" type="date" name="start_date" id="start_date" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="length_of_stay">Lama Tinggal (bulan)</label>
                            <input class="form-control" type="number" name="length_of_stay" id="length_of_stay" min="1" value="1" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="current_payment">Bayar</label>
                    <input class="form-control" type="number" name="current_payment" id="length_of_stay" value="0" required>
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
