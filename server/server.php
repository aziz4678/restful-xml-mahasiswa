<?php
error_reporting(1);	// error ditampilkan
header('Content-Type: text/xml; charset=UTF-8');

include "database.php";
// buat objek baru dari class Database
$abc = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	$input = file_get_contents("php://input");
	$data = simplexml_load_string($input);
	$aksi = $data->mahasiswa->aksi;
	$nim = $data->mahasiswa->nim;
	$nama = $data->mahasiswa->nama;
	
	if ($aksi == 'tambah')
	{	$data2=array('nim' => $nim, 
				 	 'nama' => $nama
					);	
		$abc->tambah_data($data2);
	} elseif ($aksi == 'ubah') 
	{	$data2=array('nim' => $nim, 
				 	 'nama' => $nama
					);	
		$abc->ubah_data($data2);	
	} elseif ($aksi == 'hapus') 
	{	$abc->hapus_data($nim);
	}	
	// hapus variable dari memory
	unset($input,$data,$data2,$nim,$nama,$aksi,$abc);

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') 
{	if ( ($_GET['aksi']=='tampil') and (isset($_GET['nim'])) )
	{	$nim = $abc->filter($_GET['nim']);	
		$data=$abc->tampil_data($nim);
		$xml = "<uinmalang>";
			$xml .= "<mahasiswa>";	
				$xml .= "<nim>".$data['nim']."</nim>";			    
		   		$xml .= "<nama>".$data['nama']."</nama>";		      
		    $xml.="</mahasiswa>";
	    $xml.="</uinmalang>";
	    echo $xml;

	} else  //menampilkan semua data 
	{	$data = $abc->tampil_semua_data();
		$xml = "<uinmalang>";
		foreach($data as $a)
		{ 	$xml .= "<mahasiswa>";	
		    foreach($a as $kolom => $value)
		    {	$xml .= "<$kolom>$value</$kolom>";  
				// atau menggunakan
		    	// $xml .= "<$kolom><![CDATA[$value]]></$kolom>";			    	  	
		    }	      
		    $xml.="</mahasiswa>";
	    }
	    $xml.="</uinmalang>";
	    echo $xml;	     
	}
	unset($nim,$data,$xml);		
}
?>