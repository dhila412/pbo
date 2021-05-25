<?php
    include('database.php');
    $db = new Database();
                                
    if($_POST['id']) {
                                
        $id = $_POST['id'];
        $data = $db->view($id);
        
        if($data > 0) {
            $num = 1;
            foreach($data as $row) {
                echo "<div class='pic'><img src='images/".$row['foto']."' width='180'></div>
                <div style='text-align: left; margin-left: 45%;'>
                NIP       : ".$row['nip']."<br/>
                Nama      : ".$row['nama_pegawai']."<br/>
                Username  : ".$row['username']."<br/>
                Nama Unit : ".$row['nama_unitkerja']."<br/>
                Jabatan   : ".$row['nama_jabatan']."<br/>
                TTL       : ".$row['tempat_lahir'].", ".$row['tgl_lahir']."</div>";
        
                $num++;
            }
        }
    }
?>