<?php
    session_start();

    if(empty($_SESSION['login'])) {
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Table</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
            min-width: 100%;
        }

        .table-title h2 {
            margin: 8px 0 0;
            font-size: 22px;
        }

        .search-box {
            position: relative;
            float: right;
        }

        .search-box input {
            height: 34px;
            border-radius: 20px;
            padding-left: 35px;
            border-color: #ddd;
            box-shadow: none;
        }

        .search-box input:focus {
            border-color: #3FBAE4;
        }

        .search-box i {
            color: #a0a5b1;
            position: absolute;
            font-size: 19px;
            top: 8px;
            left: 10px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child {
            width: 130px;
        }

        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }

        table.table td a.view {
            color: #03A9F4;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #E34724;
        }

        table.table td i {
            font-size: 19px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 95%;
            width: 30px;
            height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 30px !important;
            text-align: center;
            padding: 0;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 6px;
            font-size: 95%;
        }

        .pic {
            float: left;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Tabel Data</h2>
                        </div>

                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <form action="index.php" method="get">
                                    <input type="text" class="form-control" placeholder="Search&hellip;" name="cari">
                                </form>
                            </div>
                        </div>

                        <?php
                            $cari = "";
                            if(isset($_GET['cari'])) {
                                $cari = $_GET['cari'];
                                echo "<div class='col-sm-4'><p>Hasil pencarian : <b>".$cari."</b></p></div>";
                            }
                        ?>

                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead style="text-align: center;">
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Unit Kerja</th>
                            <th>Jabatan</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('database.php');
                            $db = new Database();
                            $data = $db->show_data($cari);

                            $perPage = 2;
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start = $perPage * ($page - 1);
                    
                            if($data > 0) {

                                $no = $start + 1;
                                foreach ($data as $row) {

                                    echo "<tr>
                                        <td>".$row['nip']."</td>
                                        <td>".$row['nama_pegawai']."</td>
                                        <td>".$row['username']."</td>
                                        <td>".$row['nama_unitkerja']."</td>
                                        <td>".$row['nama_jabatan']."</td>
                                        <td>".$row['tempat_lahir']."</td>
                                        <td>".$row['tgl_lahir']."</td>
                                        <td> <img src='images/".$row['foto']."' width='150'> </td>
                                        <td>
                                            <a href='#exampleModal' class='view' title='View' data-toggle='modal' id='".$row['nip']."'><i class='material-icons'>&#xE417;</i></a>
                                            <a href='form-edit.php?nip=<?= $row[nip]; ?>' class='edit' title='Edit' data-toggle='tooltip'><i
                                            class='material-icons'>&#xE254;</i></a>
                                            <a href='proses-peg.php?action=delete&nip=<?= $row[nip]; ?>' class='delete' title='Delete' data-toggle='tooltip'><i
                                            class='material-icons'>&#xE872;</i></a>
                                        </td>
                                    </tr>";
                                $no++;
                                }
                            
                            } else {
                                echo "<tr><td colspan='9'>Data tidak ditemukan</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>

                <div class="clearfix">
                    <div class="hint-text">
                        <a href='logout.php'><button
                                style="border-style: none; border-radius: 4px; padding: 5px; background-color: red; color: white;">Logout</button></a>
                        <a href='form-input.php'><button
                                style="border-style: none; border-radius: 4px; padding: 5px; margin-left: 8px; background-color: #03A9F4">Form
                                Input</button></a>
                    </div>
                    <ul class="pagination">
                        <?php
                            $pages = $db->get_pages();
                            
                            echo "<li class='page-item'><a href='?page=".($page-1)."' class='page-link'><i class='fa fa-angle-double-left'></i></a></li>";

                            for($i = 1; $i <= $pages; $i++) {
                                if($i != $page) {
                                    echo "<li class='page-item'><a href='?page=".$i."' class='page-link'>".$i."</a></li>";
                                } else {
                                    echo "<li class='page-item active'><a href='?page=".$i."' class='page-link'>".$i."</a></li>";
                                }   
                            }

                            echo "<li class='page-item'><a href='?page=".($page+1)."' class='page-link'><i class='fa fa-angle-double-right'></i></a></li>";
                        ?>
                    </ul>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Karyawan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="data-peg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

<script>
    $(document).ready(function(){

		$('.view').click(function(){

			var id = $(this).attr("id");
			
			$.ajax({
				url: 'view.php',
				method: 'post', 
				data: {id:id},

				success:function(data){
					$('#data-peg').html(data);
					$('#exampleModal').modal("show");
				}
			});
		});
	});
</script>

</html>