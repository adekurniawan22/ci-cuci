<?php
if ($this->session->userdata('role_id') == 1) {
    redirect('admin');
} elseif (empty($_SESSION['role_id'])) {
    redirect('auth');
}
?>
<div class="container-fluid py-4">
    <a href="<?= base_url('employee/addtransaction') ?>" class="btn bg-gradient-info btn-sm">+Add new Transaction</a>
    <?= $this->session->flashdata('message');
    unset($_SESSION['message']); ?>
    <div class="row">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Transactions table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transactions as $s) : ?>
                                    <tr>
                                        <td>
                                            <span class="ms-3 text-secondary text-xs font-weight-bold"><?= $s['transaction_id'] ?></span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold"><?= date("d-M-Y", $s['time']) ?></span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold"><?= date("H:i", $s['time']) ?></span>
                                        </td>

                                        <td class="align-middle text-center">

                                            <a href="" class="badge bg-gradient-success font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#viewTransaction<?= $s['transaction_id'] ?>">
                                                See Detail >>
                                            </a>
                                            <a href="" class="badge bg-gradient-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteTransaction<?= $s['transaction_id'] ?>">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Modal detail-->
<?php foreach ($details as $a) : ?>
    <div class="modal fade" id="viewTransaction<?= $a['transaction_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaction</h5>
                </div>
                <div class="modal-body">
                    <table cellpadding="7px">
                        <tr>
                            <th>Karyawan</th>
                            <td align="center">:</td>
                            <?php foreach ($users as $d) : ?>
                                <?php if ($d['user_id'] == $a['user_id']) : ?>
                                    <td> <?= $d['name'] ?> </td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Customer</th>
                            <td align="center">:</td>
                            <?php foreach ($customers as $e) : ?>
                                <?php if ($e['customer_id'] == $a['customer_id']) : ?>
                                    <td><?= $e['name'] ?> </td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td align="center">:</td>
                            <td><?= date("d F Y", $a['time']); ?></td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td align="center">:</td>
                            <td><?= date("H:i", $a['time']); ?> WIB</td>
                        </tr>
                    </table>

                    <div class="border border-dark table-responsive">
                        <table class="table">
                            <thead class="bg-info">
                                <tr>
                                    <th scope="col">Nomor Nota</th>
                                    <th scope="col">Kendaraan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $jtotal = 0; ?>
                                <?php foreach ($details as $b) : ?>
                                    <?php if ($b['transaction_id'] == $a['transaction_id']) : ?>
                                        <tr>
                                            <td><span class="ms-3"><?= $b['transaction_id'] ?></span></td>
                                            <?php foreach ($vehicles as $c) : ?>
                                                <?php if ($c['vehicle_id'] == $b['vehicle_id']) : ?>
                                                    <td><span class="ms-3"><?= $c['vehicle'] ?></span></td>
                                                    <td><span class="ms-3">Rp. <?= $c['price'] ?></span></td>
                                                    <td><span class="ms-3">x <?= $b['amount'] ?></span></td>
                                                    <td><span class="ms-3">Rp. <?= $b['amount'] * $c['price'] ?></span></td>
                                                <?php $total = $b['amount'] * $c['price'];
                                                    $jtotal += $total;
                                                endif; ?>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <p class="text-left me-4 "><strong>Jumlah Total : Rp. <?= $jtotal ?></strong></p>
                        <div></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="vehicle_id">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Delete-->
<?php foreach ($details as $a) : ?>
    <div class="modal fade" id="deleteTransaction<?= $a['transaction_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Transaction</h5>
                </div>
                <div class="modal-body">
                    Are you sure to delete this Transaction?
                </div>
                <div class="modal-footer">
                    <form action="<?= base_url('employee/deleteTransaction') ?>" method="post">
                        <?php $i = 1;
                        foreach ($transaction as $z) : ?>
                            <?php if ($z['transaction_id'] == $a['transaction_id']) : ?>
                                <?php foreach ($transaction_details as $s) : ?>
                                    <?php if ($s['transaction_details_id'] == $z['transaction_details_id']) : ?>
                                        <input type="hidden" name="transaction_details_id[<?= $i++ ?>]" value="<?= $z['transaction_details_id'] ?>">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <input type="hidden" name="transaction_id" value="<?= $a['transaction_id'] ?>">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn bg-gradient-primary">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- End Modal Delete -->