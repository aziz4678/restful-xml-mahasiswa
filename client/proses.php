<?php
include "client.php";

if ($_POST['aksi']=='tambah')
{	$data = array("nim"=>$_POST['nim'],
				  "nama"=>$_POST['nama'],
				  "aksi"=>$_POST['aksi']);		
	$abc->tambah_data($data);
	header('location:index.php?page=data-server'); 
} else if ($_POST['aksi']=='ubah')
{	$data = array("nim"=>$_POST['nim'],
				  "nama"=>$_POST['nama'],
				  "aksi"=>$_POST['aksi']);
	$abc->ubah_data($data);
	header('location:index.php?page=data-server'); 
} else if ($_GET['aksi']=='hapus')
{	$abc->hapus_data($_GET['nim']);
	header('location:index.php?page=data-server'); 
} else if ($_POST['aksi']=='sinkronisasi')
{	$abc->sinkronisasi();
	header('location:index.php?page=data-client'); 
}
unset($data,$abc);
?>
