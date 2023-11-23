<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit user</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body mt-4">
                        <!-- General Form Elements -->
                        <form role="form" action="<?= base_url() ?>admin/proses_edit_user" method="post">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="user_id" value="<?= $editUser[0]->user_id ?>">
                                    <select class="form-select" aria-label="Default select example" name="role">
                                        <option value="" selected>Pilih Role</option>
                                        <option value="2" <?php echo set_select('role', '2', ($editUser[0]->role_id == '2')); ?>>Petugas Pendaftaran</option>
                                        <option value="3" <?php echo set_select('role', '3', ($editUser[0]->role_id == '3')); ?>>Perawat</option>
                                        <option value="4" <?php echo set_select('role', '4', ($editUser[0]->role_id == '4')); ?>>Dokter</option>
                                        <option value="5" <?php echo set_select('role', '5', ($editUser[0]->role_id == '5')); ?>>Kasir</option>
                                        <option value="6" <?php echo set_select('role', '6', ($editUser[0]->role_id == '6')); ?>>Rekam Medis</option>
                                        <option value="7" <?php echo set_select('role', '7', ($editUser[0]->role_id == '7')); ?>>Farmasi</option>
                                    </select>
                                    <?= form_error('role', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Status Aktif</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_aktif" id="gridRadios1" value="1" <?php echo ($editUser[0]->status_aktif == 1) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="gridRadios1">
                                            Aktif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_aktif" id="gridRadios2" value="0" <?php echo ($editUser[0]->status_aktif == 0) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="gridRadios2">
                                            Tidak Aktif
                                        </label>
                                    </div>
                                    <?= form_error('status_aktif', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <a class="btn btn-primary" href="<?= base_url() ?>admin/user">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>