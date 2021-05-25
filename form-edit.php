<?php
    include('database.php');

    $db = new Database();
    $nip = $_GET['nip'];

    if($nip != "") {
        $data = $db->get_by_nip($nip);
        $unitkerja = $db->unitkerja();
        $jabatan = $db->jabatan();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">


    <title>Form Edit</title>


    <link href="vendor_form/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor_form/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <link href="vendor_form/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor_form/datepicker/daterangepicker.css" rel="stylesheet" media="all">


    <link href="css_form/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">FORM EDIT</h2>
                    <form method="POST" action="proses-peg.php?action=update&nip=<?= $nip ?>" name="form" enctype="multipart/form-data">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">NIP</label>
                                    <input class="input--style-4" type="hidden" value="<?= $data['nip'];?>"
                                        name="nip">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">NAMA</label>
                                    <input class="input--style-4" type="text" value="<?= $data['nama_pegawai'];?>"
                                        name="nama_pegawai">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">TEMPAT LAHIR</label>
                                    <input class="input--style-4" type="text" value="<?= $data['tempat_lahir'];?>"
                                        name="tempat_lahir">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">TANGGAL LAHIR</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4" type="date"
                                            value="<?= $data['tgl_lahir'];?>" name="tgl_lahir">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">UNIT KERJA</label>
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="unit_kerja">

                                            <option disabled="disabled" selected="selected">Choose option</option>

                                            <?php
                                                foreach ($unitkerja as $row){
                                            ?>

                                            <option value="<?= $row['id_unitkerja'] ?>" <?php echo
                                                ($data['id_unitkerja']==$row['id_unitkerja']) ? "selected" : "" ?>>
                                                <?= $row['nama_unitkerja'] ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">JABATAN</label>
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="jabatan">

                                            <option disabled="disabled" selected="selected">Choose option</option>

                                            <?php
                                            foreach ($jabatan as $row){
                                        ?>

                                            <option value="<?= $row['id_jabatan'] ?>" <?php echo
                                                ($data['id_jabatan']==$row['id_jabatan']) ? "selected" : "" ?>>
                                                <?= $row['nama_jabatan'] ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ID PENGGUNA</label>
                                    <input class="input--style-4" type="text" value="<?= $data['id_pengguna'];?>"
                                        name="id_pengguna">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">FOTO</label>
                                    <input class="input--style-4" type="file" name="foto">
                                </div>
                            </div>
                            <div class="p-t-15">
                                <button class="btn btn--radius-2 btn--blue" type="submit" value="simpan">SIMPAN
                                    PERUBAHAN</button>
                                <button class="btn btn--radius-2 btn--blue" type="submit" value="back"><a
                                        href="index.php">KEMBALI</a></button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="vendor_form/jquery/jquery.min.js"></script>

    <script src="vendor_form/select2/select2.min.js"></script>
    <script src="vendor_form/datepicker/moment.min.js"></script>
    <script src="vendor_form/datepicker/daterangepicker.js"></script>

    <script src="js_form/global.js"></script>

</body>

</html>