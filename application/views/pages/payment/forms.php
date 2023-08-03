
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Pembayaran</h6>
            </div>
        </div>
        <div class="card-body">
            <?php if($this->session->flashdata('payment_message_failed')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('payment_message_failed') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <form method="POST" action="<?= base_url("payment/add_payment")  ?>">
                <div class="form-group">
                    <label for="booking_code">Kode Booking</label>
                    <input class="form-control" type="text" name="booking_code" id="booking_code" required>
                </div>             
                <div class="form-group">
                    <label for="amount">Jumlah Bayar</label>
                    <input class="form-control" type="number" name="amount" id="amount" value="0" min="1" required>
                </div>             
                <div class="form-group">
                    <label for="description">Keterangan</label>
                    <input class="form-control" type="text" name="description" id="description" >
                </div>             

                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= base_url("payment") ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
