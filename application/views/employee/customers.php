<?php
if ($this->session->userdata('role_id') == 1) {
    redirect('admin');
} else {
    redirect('auth');
};
?>
<div class="container-fluid py-4">
    <button class="btn bg-gradient-info btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomer">+Add new customer</button>
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
                                <?php foreach ($customers as $c) : ?>
                                    <tr>
                                        <td>
                                            <span class="ms-3 text-secondary text-xs font-weight-bold"><?= $c['name'] ?></span>
                                        </td>
                                        <td>
                                            <span class=" text-secondary text-xs font-weight-bold"><?= $c['address'] ?></span>

                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold"><?= $c['phone_number'] ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="" class="badge bg-gradient-success font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editCustomer<?= $c['customer_id'] ?>">
                                                <i class="fa-solid fa-edit"></i> Edit
                                            </a>
                                            <a href="" class="badge bg-gradient-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteCustomer<?= $c['customer_id'] ?>">
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

<!-- Modal Add -->
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
            </div>
            <form action="<?= base_url('employee/addCustomer') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name Customer</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-gradient-primary">Add</button>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Modal Edit-->
<?php foreach ($customers as $a) : ?>
    <div class="modal fade" id="editCustomer<?= $a['customer_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                </div>
                <form action="<?= base_url('employee/editCustomer') ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name Customer</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $a['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address"><?= $a['address'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $a['phone_number'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="<?= $a['customer_id'] ?>" name="customer_id">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn bg-gradient-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>


<!-- End Modal Edit -->

<!-- Modal Delete-->
<?php foreach ($customers as $a) : ?>
    <div class="modal fade" id="deleteCustomer<?= $a['customer_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
                </div>
                <div class="modal-body">
                    Are you sure to delete this customer?
                </div>
                <div class="modal-footer">
                    <form action="<?= base_url('employee/deleteCustomer') ?>" method="post">
                        <input type="hidden" name="customer_id" value="<?= $a['customer_id'] ?>">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn bg-gradient-primary">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>