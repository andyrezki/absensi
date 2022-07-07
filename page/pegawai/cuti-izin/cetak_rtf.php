<?php
    
    require '../../../settings/koneksi.php';

    $temfile = file_get_contents("../../../assets/rtf/template.rtf");

    $id = $_GET['id'];
    $sql = mysqli_query($koneksi,"SELECT * FROM cuti 
    INNER JOIN data_pegawai ON cuti.id_pegawai = data_pegawai.id_pegawai
    INNER JOIN pangkat ON data_pegawai.id_pangkat = pangkat.id_pangkat
    INNER JOIN bidang ON data_pegawai.id_bidang = bidang.id_bidang
    WHERE id_cuti='$id'");
    $data = mysqli_fetch_array($sql);

    $tahun = date('Y');
    $ml = date('d', strtotime($data['mulai']));
    $ak = date('d', strtotime($data['akhir']));
    $lama = abs($ak - $ml +1);

    $akh = strtotime($data['akhir']);
    $kembali = date('d-m-Y', strtotime('+1 day', $akh));

    $temfile = str_replace('jenis_cuti', $data['jenis_cuti'],  $temfile);
    //   $temfile = str_replace('waktu_pengajuan', date('d-m-Y', STRTOTIME($data['waktu_pengajuan'])), $temfile);
      $temfile = str_replace('tahun', $tahun,  $temfile);
      $temfile = str_replace('nama', $data['nama'],  $temfile);
      $temfile = str_replace('id_pegawai', $data['id_pegawai'],  $temfile);
      $temfile = str_replace('pangkat', $data['pangkat'],  $temfile);
      $temfile = str_replace('golongan', $data['golongan'],  $temfile);
      $temfile = str_replace('divisi', $data['nama_bidang'],  $temfile);
      $temfile = str_replace('lama', $lama,  $temfile);
      $temfile = str_replace('mulai', date('d-m-Y', STRTOTIME($data['mulai'])),  $temfile);
      $temfile = str_replace('akhir', date('d-m-Y', STRTOTIME($data['akhir'])),  $temfile);
      $temfile = str_replace('kmb', date('d-m-Y', STRTOTIME($kembali)),  $temfile);

      if($data['nama'] == 'Hamdah, SP, MT.'){
        $temfile = str_replace('ket','WALIKOTA',  $temfile);
        $temfile = str_replace('ttd', 'H Muhammad Aditya Mufti Ariffin, SH, MH',  $temfile);
      }else{
        $temfile = str_replace('ket','KEPALA DINAS',  $temfile);
        $temfile = str_replace('ttd', 'Hamdah, SP, MT.',  $temfile);
      }

      
        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=cuti.rtf");
        header("Content-length: " . strlen($temfile));
        echo $temfile;
?>
