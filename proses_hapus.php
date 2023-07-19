<?php
include('koneksi.php');
if(isset($_GET['id'])){
$npm=$_GET['id'];
$namafile = 'img_'.$npm.'.jpg'; 
// Cek apakah file fotonya ada di folder images
if(is_file("file/".$namafile)){ // Jika foto ada
unlink("file/".$namafile); // Hapus foto yang telah diupload dari folderimages
}
$del=mysqli_query($koneksi,"DELETE FROM mahasiswa WHERE
npm ='$npm'");
if($del){
echo'Data mahasiswa berhasil dihapus! ';
echo'<a href="index.php">Kembali</a>';
}else{
echo'Gagal menghapus data! ';
echo'<a href="index.php">Kembali</a>';
}
}
?>
