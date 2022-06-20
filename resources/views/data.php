<?php 
//require 'koneksi.php';

//$id=$_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
  <table>
    <tr>
      <td>Nama Sinder</td>
      <td>:</td>
      <td><?= $nama; ?></td>
    </tr>
    <tr>
      <td>Wilayah</td>
      <td>:</td>
      <td><?= $wilayah; ?></td>
    </tr>
    <tr>
      <td>Lokasi</td>
      <td>:</td>
      <td><?= $lokasi; ?></td>
    </tr>
  </table>
  <div class="table-responsive">
<table class="table table-bordered" style="border: 5px;">
  <thead class="align-middle text-center">
    <tr>
      <th scope="col" rowspan="2">No</th>
      <th scope="col" rowspan="2">Mandor</th>
      <th scope="col" rowspan="2">Kebun</th>
      <th scope="col" rowspan="2">P<br>T<br>K</th>
      <th scope="col" rowspan="2">Luas <br> (Ha)</th>
      <th scope="col" rowspan="2">Jenis <br> Tebu</th>
      <th scope="col" rowspan="2">K<br>T<br>G</th>
      <th scope="col" rowspan="1" colspan="4">jumlah batang</th>
      <th scope="col" rowspan="1" colspan="2">tinggi<br> batang</th>
      <th scope="col" rowspan="2">Diameter <br> Batang</th>
      <th scope="col" rowspan="2">Berat <br> /Meter</th>
      <th scope="col" rowspan="1" colspan="2">Ku/Ha</th>
      <th scope="col" rowspan="1" colspan="2">Jumlah <br> Taksasi Tebu</th>
    </tr>
    <tr>
    <th scope="col" rowspan="1">Faktor <br> Leng</th>
    <th scope="col" rowspan="1">Jumlah <br> Batang<br> Per<br> Meter</th>
    <th scope="col" rowspan="1">Jumlah<br> Batang<br> Per<br> Row</th>
    <th scope="col" rowspan="1">Jumlah<br> Batang<br> Per<br> Ha</th>
    <th scope="col" rowspan="1">Saat <br> Ini</th>
    <th scope="col" rowspan="1">Saat <br> Tebang</th>
    <th scope="col" rowspan="1">Hit</th>
    <th scope="col" rowspan="1">Pandangan</th>
    <th scope="col" rowspan="1">Per <br> Hit</th>
    <th scope="col" rowspan="1">KUI</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $i=1;
    foreach ($data as $row){
    ?>
    <tr>
      <th><?= $i; $i++;?></th>
      <td><?= $row->mandor; ?></td>
      <td><?= $row->nama_kebun; ?></td>
      <td><?= $row->petak; ?></td>
      <td><?= $row->luas; ?></td>
      <td><?= $row->jenis_tebu; ?></td>
      <td><?= $row->kategori; ?></td>
      <td><?= $row->faktor_leng; ?></td>
      <td><?= $row->batang_per_meter; ?></td>
      <td><?= $row->batang_per_row; ?></td>
      <td><?= $row->batang_per_ha; ?></td>
      <td><?= $row->tinggi_ini; ?></td>
      <td><?= $row->tinggi_tebang; ?></td>
      <td><?= $row->diameter_batang; ?></td>
      <td><?= $row->berat_per_meter; ?></td>
      <td><?= $row->hit; ?></td>
      <td><?= $row->pandangan; ?></td>
      <td><?= $row->per_hit; ?></td>
      <td><?= $row->kui; ?></td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>
</div>
</body>
<script>
</script>
</html>
<?php 
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Data Taksasi.xls");
header("Pragma: no-cache"); 
header("Expires: 0");
?>