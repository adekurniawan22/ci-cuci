    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>RSUD Dr. H. ISHAK UMARELLA</span></strong>. All Rights Reserved
        </div>
    </footer>End Footer

    <script>
        function handleLainnya(selectElementId, inputElementId, lainnya) {
            var selectElement = document.getElementById(selectElementId);
            var inputElement = document.getElementById(inputElementId);
            var originalName = selectElement.getAttribute("name"); // Simpan nama asli

            selectElement.addEventListener("change", function() {
                if (selectElement.value === lainnya) {
                    inputElement.style.display = "block";
                    inputElement.setAttribute("name", originalName); // Set atribut "name" di input
                    selectElement.removeAttribute("name"); // Hapus atribut "name" dari select
                } else {
                    inputElement.style.display = "none";
                    inputElement.removeAttribute("name"); // Hapus atribut "name" dari input jika bukan "lainnya"
                    selectElement.setAttribute("name", originalName); // Set atribut "name" kembali di select
                }
            });
        }

        handleLainnya("wni", "wna", "Warga Negara Asing");
        handleLainnya("suku", "suku_lainnya", "Lainnya");
        handleLainnya("bahasa", "bahasa_lainnya", "Lainnya");
        handleLainnya("pendidikan", "pendidikan_lainnya", "Lainnya");
        handleLainnya("jenis_pembayaran", "jenis_pembayaran_lainnya", "Lainnya");
        handleLainnya("hubungan", "hubungan_lainnya", "Lainnya");
    </script>
    <!-- Vendor JS Files -->
    <script src="<?php echo base_url() ?>assets/bootstrap/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/assets/vendor/quill/quill.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo base_url() ?>assets/bootstrap/assets/js/main.js"></script>

    </body>

    </html>