<?php
require 'Function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pengajuan Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Stock Barang</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="Stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a> 
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a> 
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang keluar
                            </a>
                            <a class="nav-link" href="PengajuanBarang.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pengajuan Barang
                            </a>
                        </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pengajuan Barang</h1>
                        
                        
                         
                        <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                        + Masukan Pengajuan Barang
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Unit</th>
                                            <th>Pemohon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $ambilsemuadatastock = mysqli_query($conn,"select * from pengajuanbarang");
                                    while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idp = $data['Id_pengajuan'];
                                            $Tanggal = $data['Tanggal'];
                                            $Nama_Barang = $data['Nama_Barang'];
                                            $Jumlah_Barang = $data['Jumlah_Barang'];
                                            $Unit   =$data['Unit'];
                                            $Pemohon = $data['Pemohon'];
                                    ?>
                                    <tr> 
                                            <td><?=$Tanggal;?></td>
                                            <td><?=$Nama_Barang;?></td>
                                            <td><?=$Jumlah_Barang;?></td>
                                            <td><?=$Unit;?></td>
                                            <td><?=$Pemohon;?></td>
                                            <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Aprove<?=$idp;?>">
                                                Aprove
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Delete<?=$idp;?>">
                                                Reject
                                            </button>
                                        </td>   
                                       
                                        </tr>

                                                 <!-- Delete Modal -->
                                                 <div class="modal fade" id="Aprove<?=$idp;?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Aprove</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form method="post">
                                                            <div class="modal-body">
                                                            Apakah Anda Yakin? 
                                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                                            <input type="hidden" name="kty" value="<?=$qty;?>">
                                                            <input type="hidden" name="idp" value="<?=$idp;?>">
                                                            <br>
                                                            <br>   
                                                            <button type="submit" class="btn btn-primary" name="pengajuan">Submit</button>
                                                            </div>
                                                        </form>


                                                            </div>
                                                        </div>
                                                      </div>

                                                      </div>
                                                      <!-- Delete Modal -->
                                                 <div class="modal fade" id="Delete<?=$idp;?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Reject?</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form method="post">
                                                            <div class="modal-body">
                                                            Apakah Anda Yakin ? 
                                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                                            <input type="hidden" name="kty" value="<?=$qty;?>">
                                                            <input type="hidden" name="idp" value="<?=$idp;?>">
                                                            <br>
                                                            <br>   
                                                            <button type="submit" class="btn btn-danger" name="pengajuan">submit</button>
                                                            </div>
                                                        </form>


                                                            </div>
                                                        </div>
                                                      </div>

                                                      </div>
                                       <?php
                                        };

                                       ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

    <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pengajuan Barang</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <form method="post">
      <div class="modal-body">    
      
      <select name="Nama_Barang" class="form-control">
        <?php
            $ambildatapengajuan = mysqli_query($conn, "select * from stock");
            while($fetcharray = mysqli_fetch_array($ambildatapengajuan)){
            $Nama_Barang = $fetcharray['Nama_Barang'];
            $Id_Barang = $fetcharray['Id_Barang'];

        ?>

            <option value="<?=$Nama_Barang;?>"><?=$Nama_Barang;?></option>

    <?php

        }
      ?>
    </select>
      <br>      
      <input type="Number" name="Jumlah_Barang" class="form-control" placeholder="Jumlah Barang" required>
      <br> 
      <input type="text" name="Unit" class="form-control" placeholder="Unit" required>
      <br> 
      <input type="text" name="Pemohon" class="form-control" placeholder="Pemohon" required>
      <br> 
      <button type="submit" class="btn btn-primary" name="masukanpengajuan">submit</button>
      </div>
</form>


    </div>
  </div>
</div>
</html>
