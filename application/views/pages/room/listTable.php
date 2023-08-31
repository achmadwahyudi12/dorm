<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Ruangan <?= $dorm->name ?></h6>
                <a class="btn btn-primary" href="<?= base_url("room/form?dorm=" . $dorm->id); ?>">
                    <i class="fas fa-fw fa-plus"></i>
                    Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php if($this->session->flashdata('room_message_success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('room_message_success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php if($this->session->flashdata('room_message_failed')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('room_message_failed') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Lantai</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($list_room as $item) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $item['floor'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= format_rupiah($item['price']) ?></td>
                                <td><?= $item['description'] ?></td>
                                <td>
                                    <div class="d-inline-flex align-items-center">
                                        <a class="btn btn-sm btn-secondary btn-edit" title="ubah" href="<?= base_url("room/form?dorm=" . $dorm->id . "&edit=" . $item['id']) ?>" >
                                            Ubah
                                        </a>
                                        <a class="btn btn-sm btn-danger btn-delete ml-2" title="hapus" href="#" data-toggle="modal" data-target="#deleteRoomModal" data-id="<?= $item['id'] ?>" data-dorm="<?= $dorm->id ?>">
                                            Hapus
                                        </a>
                                    </div>
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
<div id="deleteRoomModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url("room/delete_room") ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="modal_detail">
                    <h5>Anda yakin akan menghapus data ini ?</h5>
                    <input type="hidden" name="deleteId" id="deleteId" />
                    <input type="hidden" name="dormId" id="dormId" />
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
            const inputElementDorm = document.getElementById("dormId");
            inputElement.value = $(this).data('id');
            inputElementDorm.value = $(this).data('dorm');
        });
    })
</script>
