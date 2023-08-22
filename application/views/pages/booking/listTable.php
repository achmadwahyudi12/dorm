<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pemesanan</h6>
                <a class="btn btn-primary" href="<?= base_url("booking/form"); ?>">
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
                            <th>Kode</th>
                            <th>Asrama</th>
                            <th>Kamar</th>
                            <th>Pelangggan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Harga Terakhir</th>
                            <th>Sudah Bayar</th>
                            <th>Total Bayar</th>
                            <th>Diskon</th>
                            <th>Sisa Bayar</th>
                            <th>Status</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_booking as $item) : ?>
                            <tr>
                                <td><?= $item['code'] ?></td>
                                <td><?= $item['dorm_name'] ?></td>
                                <td><?= "Lantai-" . $item['floor'] . ", Kamar-" . $item['room_name'] ?></td>
                                <td><?= $item['customer_name'] ?></td>
                                <td><?= date('d-m-Y', strtotime($item['start_date'])) ?><Atd>
                                <td><?= date('d-m-Y', strtotime($item['end_date'])) ?><Atd>
                                <td><?= format_rupiah($item['last_price']) ?></td>
                                <td><?= format_rupiah($item['current_payment']) ?></td>
                                <td><?= format_rupiah($item['total_payment']) ?></td>
                                <td><?= format_rupiah($item['discount']) ?></td>
                                <td><?= format_rupiah(($item['total_payment'] - $item['current_payment'] - $item['discount'])) ?></td>
                                <td>
                                    <?php if($item['status'] == 'paid'){ ?> 
                                        <div class="badge p-2" style="background-color:#2ecc71;color:white;"><?= $item['status'] ?></div>
                                    <?php } ?>
                                    <?php if($item['status'] == "unpaid") { ?>
                                        <div class="badge p-2" style="background-color:#d3d3d3;color:black;"><?= $item['status'] ?></div>
                                    <?php  } ?>
                                    <?php if($item['status'] == "outstanding") { ?>
                                        <div class="badge p-2"  style="background-color:#f39c12;color:white;"><?= $item['status'] ?></div>
                                    <?php } ?>
                                 </td>
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
