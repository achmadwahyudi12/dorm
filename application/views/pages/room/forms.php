
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Ruangan</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url(isset($room->id) ? "room/update_room" : "room/add_room")  ?>">
                <div class="form-group">
                    <label for="floor">Lantai</label>
                    <input 
                        required
                        type="text" 
                        class="form-control" 
                        id="floor" 
                        name="floor" 
                        value="<?= isset($room->floor) ?  $room->floor : "" ?>" 
                    />
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="name" 
                        name="name" 
                        value="<?= isset($room->name) ? $room->name : "" ?>" 
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input 
                        required
                        type="number" 
                        class="form-control" 
                        id="price" 
                        name="price" 
                        value="<?= isset($room->price) ? $room->price : 0 ?>" 
                        min="1" 
                    />
                </div>
                <div class="form-group">
                    <label for="down_payment">Uang Muka</label>
                    <input 
                        required
                        type="number" 
                        class="form-control" 
                        id="down_payment" 
                        name="down_payment" 
                        value="<?= isset($room->down_payment) ? $room->down_payment : 0 ?>" 
                        min="0" 
                    />
                </div>
                <div class="form-group">
                    <label for="description">Keterangan</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="description" 
                        name="description" 
                        value="<?= isset($room->description) ? $room->description : "" ?>" 
                    />
                </div>

                <input type="hidden" class="form-control" id="id_dorm" name="id_dorm" value="<?= $this->input->get('dorm'); ?>" required>
                <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($room->id) ?  $room->id : "" ?>" required>
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= base_url("room?dorm=" . $this->input->get('dorm')) ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><?= isset($room->id) ? "Ubah" : "Simpan" ?></button>
                </div>
            </form>
        </div>
    </div>
</div>