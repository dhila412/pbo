<head>
    <title>Unable to login</title>

	<link rel="stylesheet" type="text/css" href="vendor_log/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="fonts_log/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="fonts_log/Linearicons-Free-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" type="text/css" href="vendor_log/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="vendor_log/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="vendor_log/animsition/css/animsition.min.css">

	<link rel="stylesheet" type="text/css" href="vendor_log/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="vendor_log/daterangepicker/daterangepicker.css">

	<link rel="stylesheet" type="text/css" href="css_log/util.css">
	<link rel="stylesheet" type="text/css" href="css_log/main.css">
</head>

<?php
    include('database.php');
    $db = new Database();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) or empty($password)) {
        echo "Masukkan username dan/atau password";
    } else {
        $query = $db->login($username, $password);

        if($query > 0) {
            $data = $query;

            session_start();
            $_SESSION['login'] = TRUE;
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];

            $remember = $_POST['remember'];

            if($remember != "") {
                $kodeacak = hash(sha256, $username);
                setcookie('login', $kodeacak, time()+3600);
            }

            header("location:index.php");
        } else {
            echo "<span class='login100-form-title p-b-32'>Gagal Login</span><br/>";
            echo "<a href='login.php'><button class='login100-form-btn'>Kembali</button></a>";

        }
    }
?>