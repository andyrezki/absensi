<div class="container-fluid" style="margin-bottom:200px">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rekap Cuti Dan Izin Pegawai</h1>
        <div class="btn-right">
            <!-- <a class='btn btn-secondary rounded-2' href="?page=kehadiran/absensi=tambahdata">Tambah Data</a> -->
            <!-- <a class='btn btn-primary rounded-2 text-white' onclick='print_d()'> Cetak Data
                <script>
                    function print_d() {
                        window.open('../../cetak_data/cetak_absen.php', '_blank');
                    }
                </script>
            </a> -->
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-4">
            <form action="" method="POST">
                <div class="form-check form-check-inline border p-2">
                    <div class="form-group ml-1" style="width:250px">
                        <label for="jc">Jenis Pengajuan</label>
                        <select name="jc" class="form-control" id="status">
                            <option value="" disabled selected>-- Pilih Jenis--</option>
                            <option value="Cuti Tahunan">Cuti Tahunan</opion>
											<option value="Cuti Sakit">Cuti Sakit</option>
											<option value="Cuti Alasan Penting">Cuti Alasan Penting</option>
											<option value="Cuti Melahirkan">Cuti Melahirkan</option>
											<option value="Cuti Besar">Cuti Besar</option>
											<option value="Cuti Diluar Tanggungan Negara">Cuti Diluar Tanggungan Negara</option>
                        </select>
                    </div>
                    <input type="submit" name="filtercuti" class="form-control btn btn-success mt-3 ml-2"
                        style="width:100px" value="Filter Jenis">
                </div>
            </form>
        </div>
        <!-- <div class="col-md-4">
            <form action="" method="POST" style="margin-left: 50px;">
                <div class="form-check form-check-inline border p-2">
                    <div class="form-group">
                        <label for="mulai">Mulai Tanggal</label>
                        <input type="date" name="mulai" class="form-control">
                    </div>

                    <div class="form-group ml-1">
                        <label for="sampai">Sampai Tanggal</label>
                        <input type="date" name="sampai" class="form-control">
                    </div>
                    <div class="form-group ml-1" style="width:150px">
                        <label for="status">Status</label>
                        <select name="status" name="status" class="form-control" id="status">
                            <option disabled selected">-- Pilih --</option>
                            <option value="Masuk">Masuk</option>
                            <option value="Keluar">Keluar</option>
                        </select>
                    </div>
                    <input type="submit" name="filtewp" class="form-control btn btn-primary mt-3 ml-2 w-50"
                        value="Filter Waktu">
                </div>
            </form>
        </div> -->
    </div>


    <div class="table-responsive mt-4">
        <table id="datatabel" class="table table-bordered table-hover" width="100%">
            <thead class="table-info">
                <tr align="center">
                    <th>No</th>
                    <th>Pegawai</th>
                    <th>Jenis</th>
                    <th>Waktu Pengajuan</th>
                    <th>Akhir</th>
                    <th>Bukti</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        if(isset($_POST['filtercuti'])){
                            $cutit = $_POST['jc'] == 'Cuti Tahunan';
                            $cutis = $_POST['jc'] == 'Cuti Sakit';
                            $cutia = $_POST['jc'] == 'Cuti Alasan Penting';
                            $cutim = $_POST['jc'] == 'Cuti Melahirkan';
                            $cutib = $_POST['jc'] == 'Cuti Besar';
                            $cutid = $_POST['jc'] == 'Cuti Diluar Tanggungan Negara';

                            if($cutit){
                                include 'fil_cuti.php';
                            }elseif($cutis){
                                include 'fil_cuti.php';
                            }elseif($cutia){
                                include 'fil_cuti.php';
                            }elseif($cutim){
                                include 'fil_cuti.php';
                            }elseif($cutib){
                                include 'fil_cuti.php';
                            }elseif($cutib){
                                include 'fil_cuti.php';
                            }
                            else{
                                echo '<script>history.go(-1);</script>';
                            }
                        }
                        elseif(isset($_POST['filtewp'])){
                            $mulai = $_POST['mulai'];
                            $sampai = $_POST['sampai'];

                            if($mulai AND $sampai){
                                include 'fil_cuti.php';
                            }
                        }
                        else{
                            
                            $no = 1;
                             $sqlabsenmsk = mysqli_query($koneksi, "SELECT * FROM cuti
                             INNER JOIN data_pegawai ON cuti.id_pegawai = data_pegawai.id_pegawai
                            ");
                             while($row = mysqli_fetch_array($sqlabsenmsk))
                             {
                            ?>
                        <tr align="center">
                            <td><?=$no++?></td>
                            <td><?php echo $row['id_pegawai']; ?><br><b><?php echo $row['nama']; ?></b></td>
                            <td><?php echo $row['jenis_cuti']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['waktu_pengajuan'])); ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['akhir'])); ?></td>
                            <td>
                            <?php
                                $bukti = $row['bukti'];
                                if($bukti == NULL){
                                    echo '';
                                }else{
                                    echo '<a href="../../assets/bukti/'.$bukti.'" downlaod>Download</a></td>';
                                }
                            ?>
                            
                            <td>
                                <?php
                                    $status = $row['status_cuti'];
                                    if($status == 'Ajukan'){
                                        echo '<div class="btn btn-warning">'.$status.'</div>';
                                    }elseif($status == 'Diperiksa'){
                                        echo '<div class="btn btn-primary">'.$status.'</div>';
                                    }elseif($status == 'Diterima'){
                                        echo '<div class="btn btn-success">'.$status.'</div>';
                                    }elseif($status == 'Ditolak'){
                                        echo '<div class="btn btn-danger">'.$status.'</div>';
                                    }
                                    
                                ?>
                            
                            </td>
                            <!-- <td>
                                <div class="btn-group">
                                                                   
                                
                                    <a href="?page=kehadiran/cuti-izin=editdata&id=<?php echo $row['0'];?>" class="btn btn-warning mr-1"
                                       >Ubah</a>
                                    <a href="?page=kehadiran/cuti-izin=hapus&id=<?php echo $row['0']?>" class="btn btn-danger"
                                        onclick="return confirm('Ingin Menghapus Data Ini ?');">Hapus</a>
                                </div>
                            </td> -->
                        </tr>
                        <?php
                             }
                                        }
                                        
                                        ?>
                        
                    
            </tbody>
        </table>

    </div>


</div>