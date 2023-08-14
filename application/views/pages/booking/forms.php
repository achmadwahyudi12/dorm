
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Pemesanan</h6>
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
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="asrama">Asrama</label>
                            <select class="form-control" id="asrama" name="asrama" required>
                                <option value="">Pilih Asrama ...</option>
                                <?php foreach ($list_dorm as $dorm) : ?>
                                    <option value="<?= $dorm['id'] ?>"><?= $dorm["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="room_id">Kamar</label>
                            <select class="form-control" id="room_id" name="room_id" required>
                                <option value="">Pilih Kamar ...</option>
                                <!-- <?php foreach ($list_dorm as $dorm) : ?>
                                    <option value="<?= $dorm['id'] ?>"><?= $dorm["name_dorm"] . " (Lantai-" . $dorm["floor"] . " Kamar-" . $dorm["name"] . ")" ?></option>
                                <?php endforeach; ?> -->
                            </select>
                        </div>
                    </div>
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
                    <label for="total_amount">Total bayar</label>
                    <input class="form-control" type="number" name="total_amount" id="total_amount" value="0" required disabled>
                </div>             
                <div class="form-group">
                    <label for="current_payment">Bayar / Uang Muka</label>
                    <input class="form-control" type="number" name="current_payment" id="current_payment" value="0" required>
                </div>             

                <input type="hidden" class="form-control" id="last_price" name="last_price" value="">
                <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($customer->id) ?  $customer->id : "" ?>" required>
                <input type="hidden" id="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= base_url("customer") ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><?= isset($customer->id) ? "Ubah" : "Simpan" ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const total_amount_input = document.getElementById('total_amount');
        const length_of_stay_input = document.getElementById('length_of_stay');
        const current_payment_input = document.getElementById('current_payment');
        const price_input = document.getElementById('last_price');
        let total_amount;

        $('#asrama').on('change', function() {
            let selectedValue = $(this).val();
            let selected_dorm;
            const csrfToken = $('#csrf_token').val(); 

            const dorms = <?php echo json_encode($list_dorm); ?>;
            dorms.forEach(function(item) {
                if(item.id == selectedValue){
                    console.log(item);
                    const dp = parseInt(item.down_payment);
                    const minimum_order = parseInt(item.minimum_order);
                    // if (parseInt(current_payment_input.value) < dp) {
                    //     current_payment_input.value = selectedValue; // Ensure the current value is not below the new min value
                    // }
                    current_payment_input.min = dp; // Update the min attribute of the input element
                    current_payment_input.value = dp;
                    length_of_stay_input.min = minimum_order;
                    length_of_stay_input.value = minimum_order;
                }
            })
            // const selected_dorm = dorms.map(dorm => parseInt(dorm.id) === selectedValue);
            // console.log("selectedValue", selectedValue);
            // console.log("selected_dorm", selected_dorm);

            $.ajax({
                type: 'POST',
                url: '<?= base_url("booking/get_rooms_available") ?>',
                data: {
                    'dorm_id': selectedValue,
                    '<?= $this->security->get_csrf_token_name(); ?>': csrfToken
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    $('#room_id').empty().append('<option value="">Pilih Kamar ...</option>');
                    $.each(data, function(key, value) {
                        $("#room_id").append($('<option></option>').attr("value", value.id).text(`Lantai-${value.floor} Kamar-${value.name}`));
                    });
                },
                error: function(xhr, status, error) {
                }
            });
        });

        $('#room_id').on('change', function() {
            let selectedValue = $(this).val();
            const csrfToken = $('#csrf_token').val(); 

            $.ajax({
                type: 'POST',
                url: '<?= base_url("booking/get_detail_room") ?>',
                data: {
                    'room_id': selectedValue,
                    '<?= $this->security->get_csrf_token_name(); ?>': csrfToken
                },
                success: function(response) {
                    const result = JSON.parse(response);
                    const price = parseInt(result.price);
                    
                    total_amount = price;
                    total_amount_input.value = total_amount * length_of_stay_input.value;
                    price_input.value = price;
                },
                error: function(xhr, status, error) {
                }
            });
        });

        $('#length_of_stay').on('change', function() {
            total_amount_input.value = total_amount * length_of_stay_input.value;
        })
    });
</script>