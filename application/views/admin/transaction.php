<div class="container-fluid py-4">
    <?= $this->session->flashdata('message');
    unset($_SESSION['message']); ?>
    <div class="row">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Transaction table</h6>
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
                                <?php
                                var_dump($details);
                                ?>

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

                                            <a href="" class="badge bg-gradient-success font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#view<?= $s['transaction_id'] ?>">
                                                See Detail >>
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

<!-- Modal Edit-->
<?php foreach ($details as $a) : ?>
    <div class="modal fade" id="view<?= $a['transaction_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaction</h5>
                </div>
                <div class="modal-body">
                    <p>Nama karyawan</p>
                    <p>Nama Customer</p>
                    <p>Tanggal</p>
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
                                <tr>
                                    <td><span class="ms-3"><?= $a['transaction_id'] ?></span></td>
                                    <td><span class="ms-3"><?= $a['vehicle'] ?></span></td>
                                    <td><span class="ms-3"><?= $a['price'] ?></span></td>
                                    <td><span class="ms-3"><?= $a['jumlah'] ?></span></td>
                                    <td><span class="ms-3">Total</span></td>

                                </tr>
                            </tbody>
                        </table>
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