<?php
// koneksi database
include 'koneksi.php';
//Memproses data saat form di submit
if(isset($_POST["npm"]) && !empty($_POST["npm"])){
// menangkap data yang di kirim dari form
$npm = $_POST['npm'];
$nama = $_POST['nama'];
$jekel = $_POST['jekel'];
$jurusan = $_POST['jurusan'];
$kelas = $_POST['kelas'];
$ekstensi_diperbolehkan = array('png','jpg');
$photo = $_FILES['file']['name'];
$x = explode('.', $photo);
$ekstensi = strtolower(end($x));
$ukuran = $_FILES['file']['size'];
$file_tmp = $_FILES['file']['tmp_name'];
$namafile = 'img_'.$npm.'.jpg'; 
if(empty($file_tmp)){
$update=mysqli_query($koneksi,"UPDATE mahasiswa SET
nama='$nama',jns_kelamin='$jekel',kelas='$kelas',jurusan='$jurusan' WHERE
npm='$npm'")or die(mysql_error()); 
if($update){
//echo 'BERHASIL';
echo "<script>alert('DATA BERHASIL DI 
UPDATE');window.location='index.php';</script>";
}else{
echo "<script>alert('UPDATE 
GAGAL');window.location='index.php';</script>";
}
}else{
if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
if($ukuran < 1044070){
if(move_uploaded_file($file_tmp, 'file/'.$namafile)){ // Cek apakah gambar berhasil diupload atau tidak
$update=mysqli_query($koneksi,"UPDATE mahasiswa SET
nama='$nama',jns_kelamin='$jekel',kelas='$kelas',jurusan='$jurusan',photo='$namafile' WHERE npm='$npm'")or die(mysql_error());
if($update){
echo "<script>alert('DATA BERHASIL DI 
UPDATE');window.location='index.php';</script>";
}else{
echo "<script>alert('DATA GAGAL DI 
UPDATE');window.location='index.php';</script>";
}
}
else{
echo "<script>alert('GAGAL MENGUPLOAD 
GAMBAR');window.location='index.php';</script>";
}
}else{
echo "<script>alert('UKURAN FILE TERLALU 
BESAR');window.location='tambahdata.php';</script>";
}
}else{
echo "<script>alert('EKSTENSI FILE YANG DI UPLOAD TIDAK DI 
PERBOLEHKAN');window.location='edit_datamahasiswa.php?id=$npm';</script>";
}
}
}
?>
