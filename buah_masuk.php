<?php
include 'header.php';
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Buah Masuk Page</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h4><a href="tambah_Buah_masuk.php" class="btn btn-primary">Tambah Buah</a></h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama Buah</th>
                                    <th>Banyak Buah</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>Strawberry</td>
                                    <td>1Kg</td>
                                    <td>05 Desember 2024</td>
                                    <td>
                                        <a href="#" class="btn btn-warning">Detail</a>
                                        <a href="#" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
        </div>
    </section>
</div>

<?php
include 'footer.php';
?>