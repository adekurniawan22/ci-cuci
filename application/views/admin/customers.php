<?php
if ($this->session->userdata('role_id') == 2) {
    redirect('employee');
} elseif (empty($_SESSION['role_id'])) {
    redirect('auth');
}
?>
<div class="container-fluid py-4">
    <?= $this->session->flashdata('message');
    unset($_SESSION['message']); ?>
    <div class="row">
        <div class="col-10">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Customers table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone Number</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($customers as $r) : ?>
                                    <tr>
                                        <td>
                                            <span class="ms-3 text-secondary text-xs font-weight-bold"><?= $r['name'] ?></span>
                                        </td>
                                        <td>
                                            <span class=" text-secondary text-xs font-weight-bold"><?= $r['address'] ?></span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold"><?= $r['phone_number'] ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="tel:<?= $r['phone_number'] ?>" class="badge bg-gradient-info font-weight-bold text-xs">
                                                <i class="fa-solid fa-phone"></i> Call
                                            </a>
                                            <a href="https://wa.me/<?= $r['phone_number'] ?>" class="badge bg-gradient-success font-weight-bold text-xs">
                                                <i class="fa-brands fa-whatsapp"></i> Chat
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