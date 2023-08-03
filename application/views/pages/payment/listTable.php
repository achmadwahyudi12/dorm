<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pembayaran</h6>
                <a class="btn btn-primary" href="<?= base_url("payment/form"); ?>">
                    <i class="fas fa-fw fa-plus"></i>
                    Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php if($this->session->flashdata('booking_message_success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('booking_message_success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php if($this->session->flashdata('booking_message_failed')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('booking_message_failed') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Kode Booking</th>
                            <th>Total Bayar</th>
                            <th>Keterangan</th>
                            <th>Tanggal Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_payment as $item) : ?>
                            <tr>
                                <td><?= $item['code'] ?></td>
                                <td><?= $item['booking_code'] ?></td>
                                <td><?= format_rupiah($item['amount']) ?></td>
                                <td><?= $item['description'] ?></td>
                                <td><?= $item['created_at'] ?></td>
                                <td>
                                    <a class="btn btn-sm btn-danger btn-delete ml-2" title="hapus" href="#" data-toggle="modal" data-target="#deleteCustomerModal" data-id="<?= $item['id'] ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-fw fa-trash-alt"></i>
                                        </span>    
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Confirmation Delete -->
<div id="deleteCustomerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url("booking/delete_booking") ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="modal_detail">
                    <h5>Anda yakin akan menghapus data ini ?</h5>
                    <input type="hidden" name="deleteId" id="deleteId" />
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(document).on('click', '[data-toggle="modal"]', function() {
            const inputElement = document.getElementById("deleteId");
            inputElement.value = $(this).data('id');
        });
    })
</script>
