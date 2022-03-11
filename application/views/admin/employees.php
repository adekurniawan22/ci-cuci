<div class="container" style="margin-left: -8px; width:97%">
    <div class="row">
        <div class="col">
            <p class="text-justify">Halo, <?= $this->session->userdata('username'); ?></p>
            <p>Selamat datang dimenu Employees</p>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <?= $this->session->flashdata('message');
                unset($_SESSION['message']); ?>
                <div class="card-header pb-0">
                    <h6>Employees table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone Number</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Member of</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $e) : ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="<?= base_url('assets/img/profile/') . $e['image'] ?>" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?= $e['name'] ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold"><?= $e['username'] ?></span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold"><?= $e['address'] ?></span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold"><?= $e['phone_number'] ?>8</span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold"><?= $e['gender'] ?></span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <?php if ($e['is_active'] == 1) : ?>
                                                <span class="badge badge-sm bg-gradient-success">Active<a class="ms-1" href=""><i class="fa-regular fa-pen-to-square"></i></a></span>
                                            <?php else : ?>
                                                <span class="badge badge-sm bg-gradient-danger">Not Active <a class="ms-1" href=""><i class="fa-regular fa-pen-to-square"></i></a></span>
                                            <?php endif ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= date("Y-m-d", $e['created']) ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="" class="badge bg-gradient-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteEmployee<?= $e['user_id'] ?>">
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

<!-- Modal -->
<?php foreach ($employees as $a) : ?>
    <div class="modal fade" id="deleteEmployee<?= $a['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this account?
                </div>
                <div class="modal-footer">
                    <form action="<?= base_url('admin/deleteEmployee') ?>" method="post">
                        <input type="hidden" name="user_id" value="<?= $a['user_id'] ?>">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn bg-gradient-primary">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>