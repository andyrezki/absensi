<?php 
    date_default_timezone_set("Asia/Makassar");
    $id_pegawai = $_POST['id_pegawai'];
    $jenis = $_POST['jenis'];
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];

    $waktu_pengajuan = date('Y-m-d');
    $keterangan = $_POST['ket'];
    $status = "Ajukan";

    $aw = date('d', strtotime($awal));
    $ak = date('d', strtotime($akhir));

    //FILE IMG 
    $file = $_FILES['bukti']['name'];
    $tmpfile = $_FILES['bukti']['tmp_name'];
    $size = $_FILES['bukti']['size'];
    

    $newfile = date('dmYHis').$file;
    $lokasi = "../../assets/bukti/".$newfile;

    if(move_uploaded_file($tmpfile,$lokasi)){

        $tmbhakun = mysqli_query($koneksi,"INSERT INTO cuti(id_cuti,id_pegawai,jenis,mulai,akhir
        ,waktu_pengajuan,bukti,keterangan,status_cuti)
        VALUES('','$id_pegawai','$jenis','$awal','$akhir','$waktu_pengajuan','$newfile','$keterangan','$status')");

        if($tmbhakun == true){
            echo"
            <script>
                alert('Data Berhasil Ditambahkan');
                document.location = '?page=kehadiran/cuti-izin';
            </script>
            ";
        }else{
            echo"
            <script>
                alert('Data Gagal Ditambahkan');
                history.go(-1);
            </script>
            ";
        }
    }

?>
