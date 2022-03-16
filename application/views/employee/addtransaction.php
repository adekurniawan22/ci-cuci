<?php
if ($this->session->userdata('role_id') == 1) {
    redirect('admin');
} elseif (empty($_SESSION['role_id'])) {
    redirect('auth');
}
?>
<div class="container">
    <?= $this->session->flashdata('message');
    unset($_SESSION['message']); ?>
    <div class="row">
        <div class="col-4">
            <form action="<?= base_url('employee/inserttransactiondetail') ?>" method="post">
                <div class="form-group col-8">
                    <label>Choose Vehicle</label>
                    <select class="form-control" name="vehicle">
                        <option selected value="">--Choose Vehicles--</option>
                        <?php foreach ($vehicles as $v) : ?>
                            <option value="<?= $v['vehicle_id'] ?>"><?= $v['vehicle'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3 col-8">
                    <label for="amount" class="form-label">Amount</label>
                    <input min=0 type="number" class="form-control" id="amount" name="amount">
                </div>
                <button type="submit" class="btn bg-gradient-primary">Add</button>
            </form>
        </div>
        <div class="col-7 card">
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Pilihan</th>
                            <th>Vehicle</th>
                            <th>Amount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="<?= base_url('employee/inserttransaction') ?>" method="post">

                            <?php foreach ($transaction_details as $t) : ?>
                                <tr>
                                    <td><input type="checkbox" class="ms-4" name="check[]" value="<?= $t['transaction_details_id'] ?>"></td>
                                    <?php foreach ($vehicles as $a) : ?>
                                        <?php if ($a['vehicle_id'] == $t['vehicle_id']) : ?>
                                            <td><span class="ms-4" name="a" value="<?= $a['vehicle'] ?>"><?= $a['vehicle'] ?></span></td>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                    <td><span class="ms-4">x <?= $t['amount'] ?></span></td>
                                    <?php foreach ($vehicles as $a) : ?>
                                        <?php if ($a['vehicle_id'] == $t['vehicle_id']) : ?>
                                            <td><span class="ms-4">Rp. <?= $a['price'] * $t['amount'] ?></span></td>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </tr>
                            <?php endforeach ?>
                    </tbody>
                </table>
                <div class="row mt-4">
                    <div class="mb-3 col-8">
                        <label for="name">Name Customer</label>
                        <input class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3 col-4">
                        <label ">Number Transaction</label>
                        <input type=" text" readonly class="form-control mb-2 d-inline-block" name="transaction_id" value="NOTA-<?= $hnota ?>">
                    </div>
                </div>
                <div class="col-4 float-end">
                    <button type="submit" class="btn bg-gradient-primary btn-lg float-end">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>