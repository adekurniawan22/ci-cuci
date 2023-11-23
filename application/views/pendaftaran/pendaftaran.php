<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Pendaftaran</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body mt-3">
                        <div class="pb-3">
                            <a href="<?= base_url() ?>pendaftaran/tambah_pendaftaran" class="btn btn-primary">+ Tambah Pendaftaran</a>
                        </div>
                        <?= $this->session->flashdata('message');
                        unset($_SESSION['message']); ?>
                        <div class="table-container">
                            <!-- Table with stripped rows -->
                            <table id="example" class="table datatable table-striped my-4">
                                <thead>
                                    <tr>
                                        <th>No. Rekam Medis</th>
                                        <th>Nama Pasien</th>
                                        <th>Waktu Pendaftaran</th>
                                        <th>Poliklinik</th>
                                        <th>Ketentuan RS ke Pasien</th>
                                        <th>Informasi Pasien</th>
                                        <th>Informasi Penanggung Jawab</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendaftaran as $data) : ?>
                                        <tr>
                                            <td><?= $data->nomor_rekam_medis ?></td>
                                            <td><?= $data->nama_lengkap_pasien ?></td>
                                            <td><?= $data->waktu_pendaftaran ?></td>
                                            <td><?= $data->poliklinik ?></td>
                                            <td><?= $data->ketentuan_rs_ke_pasien ?></td>
                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPasien<?= $data->id_pendaftaran ?>">
                                                    Detail <i class="bi bi-eye-fill"></i>
                                                </button></td>
                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPJ<?= $data->id_pendaftaran ?>">
                                                    Detail <i class="bi bi-eye-fill"></i>
                                                </button></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPJ<?= $data->id_pendaftaran ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPJ<?= $data->id_pendaftaran ?>">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- Modal Pasien -->
<?php foreach ($pendaftaran as $dataModal) : ?>
    <div class="modal fade" id="modalPasien<?= $dataModal->id_pendaftaran ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informasi Pasien</h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <!-- Vertical Form -->
                            <form class="row g-3 mt-2">
                                <div class="col-12">
                                    <label class="form-label">Nomor Rekam Medis</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->nomor_rekam_medis ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->nama_lengkap_pasien ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tempat dan Tanggal Lahir</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->tempat_lahir . ', ' . date('d-m-Y', strtotime($dataModal->tanggal_lahir)) ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Kartu Identitas</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->kartu_identitas ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nomor Kartu Identitas</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->nomor_kartu_identitas ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->jenis_kelamin ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->pekerjaan ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Warga Negara</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->warga_negara ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Suku</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->suku ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" style="height: 100px" readonly><?= $dataModal->alamat_lengkap ?></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Status Perkawinan</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->status_perkawinan ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Agama</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->agama ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Bahasa yang digunakan</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->bahasa ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Pendidikan</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->pendidikan ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->nomor_hp ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Jenis Pembayaran</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->jenis_pembayaran ?>" readonly>
                                </div>
                            </form><!-- Vertical Form -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Penangung Jawab -->
    <div class="modal fade" id="modalPJ<?= $dataModal->id_pendaftaran ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informasi Penanngung Jawab</h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body g-3">
                            <!-- Vertical Form -->
                            <form class="row g-3 mt-2">
                                <div class="col-12">
                                    <label class="form-label">Penanggung Jawab</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->penanggung_jawab ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->nama_penanggung_jawab ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Hubungan</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->hubungan ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" style="height: 100px" readonly><?= $dataModal->alamat_penanggung_jawab ?></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control" value="<?= $dataModal->nomor_hp_penanggung_jawab ?>" readonly>
                                </div>
                            </form><!-- Vertical Form -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>