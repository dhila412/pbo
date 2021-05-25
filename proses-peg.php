<?php
    include('database.php');

    $db = new Database();
    $action = $_GET['action'];
    
    if($action == "add") {
        $temp = $_FILES['foto']['tmp_name'];
        $foto = $_FILES['foto']['name'];
        $folder = "images/";
        move_uploaded_file($temp, $folder.$foto);

        $data = array(
            'nip' => $_POST['nip'],
            'id_unitkerja' => $_POST['unit_kerja'],
            'id_jabatan' => $_POST['jabatan'],
            'nama_pegawai' => $_POST['nama_pegawai'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tgl_lahir' => $_POST['tgl_lahir'],
            'foto' => $foto
        );

        $db->insert_data($data);
        header('location:index.php');
    } elseif($action == "update") {
        $temp = $_FILES['foto']['tmp_name'];
        $foto = $_FILES['foto']['name'];
        $folder = "images/";
        move_uploaded_file($temp, $folder.$foto);

        $data = array(
            'nip' => $_POST['nip'],
            'id_unitkerja' => $_POST['unit_kerja'],
            'id_jabatan' => $_POST['jabatan'],
            'nama_pegawai' => $_POST['nama_pegawai'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tgl_lahir' => $_POST['tgl_lahir'],
        );

        if($foto != "") {
            $data['foto'] = $foto;
        }

        $nip = $_GET['nip'];
        $db->update_data($nip, $data);
        header('location:index.php');
    } elseif($action == "delete") {
        $nip = $_GET['nip'];
        $db->delete_data($nip);

        header('location:index.php');
    }
?>