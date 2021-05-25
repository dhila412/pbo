<?php
    class Database {
        var $host       = "localhost";
        var $user       = "root";
        var $password   = "";
        var $db         = "pemwebdas_db";
        var $koneksi    = "";

        function __construct() {
            $this->koneksi = mysqli_connect($this->host,$this->user,$this->password,$this->db);

            if(mysqli_connect_errno()) {
                die("Gagal terhubung dengan database: ".mysqli_connect_errno());
            }
        }

        function show_data($cari) {
            $perPage = 2;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = $perPage * ($page - 1);

            if($cari != "") {
                $peg = mysqli_query($this->koneksi, "SELECT * FROM pegawai p JOIN unit_kerja u ON p.id_unitkerja = u.id_unitkerja JOIN jabatan j ON p.id_jabatan = j.id_jabatan JOIN pengguna g ON p.id_pengguna = g.id_pengguna WHERE nama_pegawai LIKE '%".$cari."%' LIMIT $start, $perPage");
            } else {
                $peg = mysqli_query($this->koneksi, "SELECT * FROM pegawai p JOIN unit_kerja u ON p.id_unitkerja = u.id_unitkerja JOIN jabatan j ON p.id_jabatan = j.id_jabatan JOIN pengguna g ON p.id_pengguna = g.id_pengguna LIMIT $start, $perPage");
            }

            if(mysqli_num_rows($peg) > 0) {
                foreach($peg as $row) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return 0;
            }
        }

        function view($id) {
            $peg = mysqli_query($this->koneksi, "SELECT * FROM pegawai p JOIN unit_kerja u ON p.id_unitkerja = u.id_unitkerja JOIN jabatan j ON p.id_jabatan = j.id_jabatan JOIN pengguna g ON p.id_pengguna = g.id_pengguna WHERE nip = '$id'");
                                        
            if(mysqli_num_rows($peg) > 0) {
                foreach($peg as $row) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return 0;
            }
        
        }

        function unitkerja() {
            $unit = mysqli_query($this->koneksi, "SELECT * FROM unit_kerja");

            foreach($unit as $row) {
                $data[] = $row;
            }
            return $data;

        }

        function jabatan() {
            $jabatan = mysqli_query($this->koneksi, "SELECT * FROM jabatan");

            foreach($jabatan as $row) {
                $data[] = $row;
            }
            return $data;
            
        }

        function insert_data($data) {
            $col = implode(',', array_keys($data));

            $val = "'".implode("','", array_values($data))."'";

            mysqli_query($this->koneksi, "INSERT INTO pegawai($col) VALUES($val)");
        }

        function get_by_nip($nip) {
            $query = mysqli_query($this->koneksi, "SELECT * FROM pegawai WHERE nip='$nip'");

            return $query->fetch_array();
        }

        function update_data($nip, $data) {
            $dataset = "";

            foreach($data as $key => $val) {
                $dataset .= $key.'="'.$val.'",';
            }

            $dataset = rtrim($dataset, ',');
            mysqli_query($this->koneksi, "UPDATE pegawai SET $dataset WHERE nip=$nip");
        }

        function delete_data($nip) {
            mysqli_query($this->koneksi, "DELETE FROM pegawai WHERE nip='$nip'");
        }

        function login($username, $password) {
            $password = sha1($password);
            $sql = "SELECT * FROM pengguna WHERE username='$username' AND password='$password'";
            $query = mysqli_query($this->koneksi, $sql);

            return $query->fetch_array();
        }

        function get_pages() {
            $perPage = 2;
            $get = mysqli_fetch_array(mysqli_query($this->koneksi, "SELECT COUNT(*) total FROM pegawai"));
            $total = $get['total'];
            $pages = ceil($total/$perPage);

            return $pages;
        }
    }
?>