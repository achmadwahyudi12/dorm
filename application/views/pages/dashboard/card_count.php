<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pendapatan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= format_rupiah($total_earnings); ?>
                        </div>
                    </div>
                    <!-- <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Uang (Booking/Cancel)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= format_rupiah($money_booked); ?>
                        </div>
                    </div>
                    <!-- <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Kamar (Terisi)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= format_rupiah($total_room_used); ?>
                            </div>
                        </div>
                        <!-- <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Kamar (Tersedia)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= format_rupiah($total_room_available); ?>
                        </div>
                    </div>
                    <!-- <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
