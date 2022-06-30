<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-8 col-12 bg-white p-4">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <?php
                if(@$_POST['lp'] == 'Laporan Data Pegawai'){
                    echo'<h1 class="h3 mb-0 text-gray-800">Laporan Data Pegawai</h1>';
                }elseif(@$_POST['lp'] == 'Laporan Absen Pegawai'){
                    echo'<h1 class="h3 mb-0 text-gray-800">Laporan Absen Pegawai</h1>';
                }else{
                    echo'<h1 class="h3 mb-0 text-gray-800">Laporan</h1>';
                }
            ?>
            
            <div class="btn-right">
            <?php
                if(@$_POST['lp'] == 'Laporan Data Pegawai'){
                    echo'<a href="../../cetak_data/cetak_data_pegawai.php" target="_blank" name="cetakgaji" class="btn btn-primary">Cetak Laporan</a>';
                }elseif(@$_POST['lp'] == 'Laporan Absen Pegawai'){
                    echo'<a href="../../cetak_data/cetak_absen.php" target="_blank" name="cetakkp"  class="btn btn-primary">Cetak Laporan</a>';
                }
            ?>
            
            <a href="?page=dashboard" class="btn btn-success">Kembali</a>
            <!-- <a class='btn btn-info rounded-2' href="?page=scan-qrcode">Absen Dengan QRCode</a> -->
                <!-- <a class='btn btn-secondary rounded-2' href="?page=kehadiran/absensi=tambahdata">Tambah Data</a> -->
                <!-- <a class='btn btn-primary rounded-2 text-white' onclick='print_d()'> Cetak Data
                    <script>
                        function print_d() {
                            window.open('../../cetak_data/cetak_absen.php?id=<?=$_SESSION['nik']?>', '_blank');
                        }
                    </script>
                </a> -->
            </div>
        </div>

        <div class="col-12 col-md-12">
          
                    <form action="" method="POST">
                        <div class="dropdownlp p-4 d-flex justify-content-center mb-2">
                            <select name="lp" id="lp" class="form-control" style="width:80%">
                                <option value="" disabled selected>--Pilih Laporan --
                                </option>
                                <option value="Laporan Data Pegawai">Laporan Data Pegawai</option>
                                <option value="Laporan Absen Pegawai">Laporan Absen Pegawai</option>
                                
                            </select>

                            <button id="submit" name="submit" class="bt-filter btn btn-primary ml-1">
                                <i class="fa fa-filter"></i>
                                <span>Filter</span>
                            </button>
                        </div>
                    </form>
                </div>

        <div class="table-responsive">
            <table id="datatabel" class="table table-bordered table-hover" width="100%">
                <thead class="table-info">
                    <?php

                        if(@$_POST['lp'] == 'Laporan Data Pegawai'){
                            echo '
                            <tr align="center">
                            <th>No</th>
                            <th>ID Pegawai</th>
                            <th>Nama</th>
                            <th>Pangkat/Gol</th>
                            <th>Jenis</th>
                            </tr>
                            ';
                        } 
                        elseif(@$_POST['lp'] == 'Laporan Absen Pegawai'){
                            echo '
                            <tr align="center">
                            <th>No</th>
                            <th>ID Pegawai</th>
                            <th>Nama</th>
                            <th>Tanggal Absen</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            </tr>
                            ';
                        }

                    ?>
                   
                </thead>
                <tbody>
                    <?php
                        
                        if(isset($_POST['submit'])){
                            $lpgaji = $_POST['lp'] == 'Laporan Data Pegawai';
                            $lpkp = $_POST['lp'] == 'Laporan Absen Pegawai';

                            if($lpgaji){
                                include 'fil_pegawai.php';
                            }
                            elseif($lpkp){
                                include 'fil_pegawai.php';
                            }
                        }
                    ?>
                                
                </tbody>
            </table>

        </div>
        </div>
    </div>

</div>
