<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $this->load->view('pages/dashboard/card_count'); ?>
    <div class="row">
        <div class="col-7">
            <?php $this->load->view('pages/dashboard/summary_room'); ?>
        </div>
        <div class="col-5">
            <?php $this->load->view('pages/dashboard/chart_accoupancy'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php $this->load->view('pages/dashboard/earnings_overview'); ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->