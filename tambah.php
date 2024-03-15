<?php
include_once 'db.php';
if (isset($_POST['btn-save'])) {
    $nama= $_POST['nama'];
    $jenis_kelamin= $_POST['jenis_kelamin'];
    $tanggal_lahir= $_POST['tanggal_lahir'];
    if ($karyawan->insertData( $nama, $jenis_kelamin, $tanggal_lahir)) {
        header("Location: tambah.php?inserted");
    } else {
        header("Location: tambah.php?failure");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manajemen Karyawan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Form Tambah Karyawan</div>
        <div class="panel-body">
            <?php
            if (isset($_GET['inserted'])) {
                ?>
                <div class="container">
                    <div class="alert alert-info">
                        <strong>Info!</strong> Karyawan berhasil tersimpan! Silakan klik di <a href="index.php">sini</a> untuk kembali ke beranda.
                    </div>
                </div>
                <?php
            } elseif (isset($_GET['failure'])) {
                ?>
                <div class="container">
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> Karyawan gagal tersimpan !
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="clearfix"></div><br />
            <form method='post'>
                <table class='table table-bordered'>
                    <tr>
                        <td>Nama</td>
                        <td><input type='text' name='nama' class='form-control' required maxlength="50"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                            <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" required>
                            <label for="laki-laki">Laki-laki</label><br>
                            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" required>
                            <label for="perempuan">Perempuan</label>
                        </td>
                        <!-- <td><input type='text' name='jenis_kelamin' class='form-control' required></td> -->
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td><input type='text' name='tanggal_lahir' class='form-control' required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary" name="btn-save">Simpan
                            </button>
                            <button type="reset" class="btn btn-primary" name="btn-reset">Reset
                            </button> <br /><br />
                            <a href="index.php" class="btn btn-large btn-success">
                                <i class="glyphicon glyphicon-backward"></i> &nbsp; Kembali ke halaman utama</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="alert alert-success">
        <p><strong>H1D022066 - Tahta Setyo Nugroho</strong></p>
    </div>
</div>
<!--Bootstrap-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>