<?php
    
    if(isset($_POST['submit'])){
        $lp = $_POST['lp'];
        
        if($lp == 'Laporan Data Pegawai')
        {
        $no =1;
        $sql = mysqli_query($koneksi,"SELECT * FROM data_pegawai
        INNER JOIN pangkat ON data_pegawai.id_pangkat = pangkat.id_pangkat
        ");
        while($row = mysqli_fetch_assoc($sql))
        {
        ?>
            <tr align="center">
            <td><?=$no++?></td>
            <td><?php echo $row['id_pegawai']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['pangkat']?>/(<?=($row['golongan'])?>)</td>
            <td><?php echo $row['jenis']; ?></td>
            </tr>
            <?php } 

        }
        elseif($lp == 'Laporan Absen Pegawai')
        {
        $no =1;
        $sql = mysqli_query($koneksi,"SELECT * FROM absensi
        INNER JOIN data_pegawai ON absensi.id_pegawai = data_pegawai.id_pegawai
        ");
        while($row = mysqli_fetch_assoc($sql))
        {
        ?>
            <tr align="center">
            <td><?=$no++?></td>
            <td><?php echo $row['id_pegawai']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo date('d-m-Y', STRTOTIME($row['tgl'])); ?></td>
            <td><?php echo $row['waktu_masuk']; ?></td>
            <td><?php echo $row['waktu_keluar']; ?></td>
            </tr>
            <?php } 

        }
    }

    
?>