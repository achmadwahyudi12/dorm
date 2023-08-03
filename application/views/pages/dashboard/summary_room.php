<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Ringkasan ketersediaan kamar</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Asrama</th>
                        <th>avalible</th>
                        <th>booked</th>
                        <th>used</th>
                        <th>total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($list_summary_room as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item['dorm_name'] ?></td>
                            <td><?= $item['total_room_available'] ?></td>
                            <td><?= $item['total_room_used'] ?></td>
                            <td><?= $item['total_room_booked'] ?></td>
                            <td><?= $item['total_room'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>