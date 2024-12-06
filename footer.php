<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2024 <div class="bullet"></div> Design By <a href="https://www.instagram.com/twntysvn_8?igsh=bzRxYnkzZHFsejNl">@twntysvn_8</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/jquery.sparkline.min.js"></script>
  <script src="assets/modules/chart.min.js"></script>
  <script src="assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="assets/modules/summernote/summernote-bs4.js"></script>
  <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  <script>
    function ambilSatuan() {
        // Ambil satuan dari atribut data-satuan pada opsi yang dipilih
        const idBuah = document.getElementById("id_buah");
        const satuan = idBuah.options[idBuah.selectedIndex].getAttribute("data-satuan");
        document.getElementById("satuan").value = satuan || 0;

        // Hitung ulang barang terjual jika ada stok digunakan
        hitungBarangTerjual();
    }

    function hitungBarangTerjual() {
        // Ambil nilai stok awal, stok akhir, dan satuan
        const stokAwal = parseFloat(document.getElementById("stok_awal").value) || 0;
        const stokAkhir = parseFloat(document.getElementById("stok_akhir").value) || 0;
        const satuan = parseFloat(document.getElementById("satuan").value) || 0;

        // Hitung stok digunakan
        const stokDigunakan = stokAwal - stokAkhir;

        // Hitung barang terjual
        const barangTerjual = satuan > 0 ? stokDigunakan / satuan : 0;

        // Periksa apakah hasilnya bilangan bulat atau desimal
        document.getElementById("barang_terjual").value = 
            Number.isInteger(barangTerjual) ? barangTerjual : barangTerjual.toFixed(2);
    }

    function formatRupiah(input) {
        let value = input.value.replace(/\D/g, '');
        value = value ? parseInt(value, 10).toLocaleString('id-ID') : '';
        input.value = value;
    }
</script>


  <script>
    // Fungsi untuk memformat angka menjadi format rupiah
    function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, ""); // Hapus karakter non-digit
        let parts = value.split(",");
        let numberString = parts[0];
        let remainder = numberString.length % 3;
        let rupiah = numberString.substr(0, remainder);
        let thousands = numberString.substr(remainder).match(/\d{3}/g);

        if (thousands) {
            let separator = remainder ? "." : "";
            rupiah += separator + thousands.join(".");
        }

        input.value = rupiah + (parts[1] !== undefined ? "," + parts[1] : "");
    }
</script>

</body>

</html>