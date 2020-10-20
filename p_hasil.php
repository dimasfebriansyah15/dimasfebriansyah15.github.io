<?php

/*
---------------------------------------------
Developed by SUHERY.COM
Website : http://www.suheri37.blogspot.com
---------------------------------------------
*/

if(empty($_SESSION['LOGIN_username'])){
	exit("<script>location.href='./';</script>");
}

if(!empty($_POST['cmd_new'])){
	session_unregister('ANALISA_KRITERIA');
	exit("<script>location.href='?hal=analisa';</script>");
}
//$q=mysql_query("select * from kriteria");
//while($h=mysql_fetch_array($q)){
//	echo $_SESSION['ANALISA_KRITERIA'][$h['id_kriteria']].'<hr>';
//}

# baca jumlah kriteria
$jumlah_kriteria=mysql_num_rows(mysql_query("select * from kriteria"));
# baca jumlah alternatif
$jumlah_alternatif=mysql_num_rows(mysql_query("select * from alternatif"));

# baca data alternatif
$q=mysql_query("select * from alternatif order by nama");
while($h=mysql_fetch_array($q)){
	$alternatif[]=array($h['id_alternatif'],$h['nim'],$h['nama']);
	$title.='<td align="center" width="240">'.strtoupper($h['nama']).'</td>';
}

# baca data kriteria dan nilai bobot dari form input analisa
$q=mysql_query("select * from kriteria");
while($h=mysql_fetch_array($q)){
	$nilai=$_SESSION['ANALISA_KRITERIA'][$h['id_kriteria']];
	$kriteria[]=array($h['id_kriteria'],$h['nama'],$h['atribut'],$nilai);
}

$no=0;
$daftar='<td width="40">NO</td><td width="100">NIM</td><td>NAMA</td>';
for($i=0;$i<count($kriteria);$i++){
	$daftar.='<td width="180">C'.($i+1).'</td>';
}
$daftar='<tr>'.$daftar.'</tr>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar.='<tr><td>'.$no.'</td><td>'.$alternatif[$i][1].'</td><td>'.$alternatif[$i][2].'</td>';
	for($ii=0;$ii<count($kriteria);$ii++){
		$q=mysql_query("select himpunan.nama from klasifikasi inner join himpunan on klasifikasi.id_himpunan=himpunan.id_himpunan where klasifikasi.id_alternatif='".$alternatif[$i][0]."' and himpunan.id_kriteria='".$kriteria[$ii][0]."'");
		$h=mysql_fetch_array($q);
		$himpunan=$h['nama'];
		$daftar.='<td>'.$himpunan.'</td>';
	}
	$daftar.='</tr>';
}

$no=0;
$daftar_1='<td width="40">NO</td><td width="100">NIM</td><td>NAMA</td>';
for($i=0;$i<count($kriteria);$i++){
	$daftar_1.='<td width="60">C'.($i+1).'</td>';
}
$daftar_1='<tr>'.$daftar_1.'</tr>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar_1.='<tr><td>'.$no.'</td><td>'.$alternatif[$i][1].'</td><td>'.$alternatif[$i][2].'</td>';
	for($ii=0;$ii<count($kriteria);$ii++){
		$q=mysql_query("select himpunan.nilai from klasifikasi inner join himpunan on klasifikasi.id_himpunan=himpunan.id_himpunan where klasifikasi.id_alternatif='".$alternatif[$i][0]."' and himpunan.id_kriteria='".$kriteria[$ii][0]."'");
		$h=mysql_fetch_array($q);
		$nilai=$h['nilai'];
		# catat nilai himpunan ke dalam matriks
		$matriks_x[$i+1][$ii+1]=$nilai;
		$daftar_1.='<td>'.$nilai.'</td>';
	}
	$daftar_1.='</tr>';
}
//$no=0;
# menampilkan data hasil pencarian
/*$q=mysql_query("select * from kriteria");
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$no++;
		$tmp='<td valign="top"><strong>C'.$no.'</strong>. '.$h['nama'].'</td>';
		for($i=0;$i<count($id_alternatif);$i++){
			$qqq=mysql_query("select klasifikasi.* from klasifikasi inner join himpunan on klasifikasi.id_himpunan=himpunan.id_himpunan where klasifikasi.id_alternatif='".$id_alternatif[$i]."' and himpunan.id_kriteria='".$h['id_kriteria']."'");
			if(mysql_num_rows($qqq) > 0){
				$hhh=mysql_fetch_array($qqq);
				$id_himpunan=$hhh['id_himpunan'];
			}else{
				$id_himpunan='';
			}
			
			$qqq=mysql_query("select * from himpunan where id_himpunan='".$id_himpunan."'");
			if(mysql_num_rows($qqq) > 0){
				$hhh=mysql_fetch_array($qqq);
				$himpunan=$hhh['nama'];
			}else{
				$himpunan='';
			}
			$tmp.='<td valign="top">'.$himpunan.'</td>';
		}
		$daftar.='<tr>'.$tmp.'</tr>';
	}
}*/

/*$no=0;
$title_1='<td width="100">NIM</td><td width="200">NAMA</td>';
$q=mysql_query("select * from kriteria");
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$no++;
		$title_1.='<td align="center" width="200"><strong>C'.$no.'</strong></td>';
		# catat atribut kriteria masing2 kriteria
		$kriteria_atribut[]=$h['atribut'];
	}
}*/

# membaca nilai himpunan
/*for($i=0;$i<count($id_alternatif);$i++){
	$ii=0;
	$tmp_1='<td valign="top" width="100">'.$nama_arr[$i].'</td><td valign="top" width="200">'.$nama_arr[$i].'</td>';
	$qq=mysql_query("select * from kriteria");
	if(mysql_num_rows($qq) > 0){
		while($hh=mysql_fetch_array($qq)){
			$ii++;
			$qqq=mysql_query("select klasifikasi.* from klasifikasi inner join himpunan on klasifikasi.id_himpunan=himpunan.id_himpunan where klasifikasi.id_alternatif='".$id_alternatif[$i]."' and himpunan.id_kriteria='".$hh['id_kriteria']."'");
			if(mysql_num_rows($qqq) > 0){
				$hhh=mysql_fetch_array($qqq);
				$id_himpunan=$hhh['id_himpunan'];
			}else{
				$id_himpunan='';
			}
			
			$qqq=mysql_query("select * from himpunan where id_himpunan='".$id_himpunan."'");
			if(mysql_num_rows($qqq) > 0){
				$hhh=mysql_fetch_array($qqq);
				$himpunan_nilai=$hhh['nilai'];
			}else{
				$himpunan_nilai=0;
			}
			$tmp_1.='<td valign="top" width="100" align="center">'.$himpunan_nilai.'</td>';
			# catat nilai himpunan ke dalam matriks
			$matriks_x[$i+1][$ii]=$himpunan_nilai;
		}
	}
	$daftar_1.='<tr>'.$tmp_1.'</tr>';
}*/

# NORMALISASI 1
$no=0;
$daftar_2='<td width="40">NO</td><td width="100">NIM</td><td>NAMA</td>';
for($i=0;$i<count($kriteria);$i++){
	$daftar_2.='<td width="60">C'.($i+1).'</td>';
}
$daftar_2='<tr>'.$daftar_2.'</tr>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar_2.='<tr><td>'.$no.'</td><td>'.$alternatif[$i][1].'</td><td>'.$alternatif[$i][2].'</td>';
	for($ii=0;$ii<count($kriteria);$ii++){
		$arr='';
		for($j=0;$j<count($alternatif);$j++){ # alternatif
			$arr[]=$matriks_x[$j+1][$ii+1];
		}
		if($kriteria[$ii][2]=='benefit'){
			if($matriks_x[$i+1][$ii+1]>0){$jml=$matriks_x[$i+1][$ii+1]/max($arr);}else{$jml=0;}
		}else{
			if(min($arr)>0){$jml=min($arr)/$matriks_x[$i+1][$ii+1];}else{$jml=0;}
		}
		$matriks_1[$i+1][$ii+1]=round($jml,3);
		$daftar_2.='<td>'.round($jml,3).'</td>';
	}
	$daftar_2.='</tr>';
}

/*for($i=1;$i<=$no;$i++){ # alternatif
	$tmp='';
	for($ii=1;$ii<=$no_1;$ii++){ # kriteria
		
		$arr='';
		for($j=1;$j<=$no;$j++){ # alternatif
			$arr[]=$matriks_x[$j][$ii];
		}
		if($kriteria_atribut[$ii-1]=='benefit'){
			if($matriks_x[$i][$ii]>0){$jml=$matriks_x[$i][$ii]/max($arr);}else{$jml=0;}
		}else{
			if(min($arr)>0){$jml=min($arr)/$matriks_x[$i][$ii];}else{$jml=0;}
		}
		$matriks_1[$i][$ii]=round($jml,3);
		$tmp.='<td align="center" width="80">'.round($jml,3).'</td>';
	}
	
	$normalisasi.='<tr>'.$tmp.'</tr>';
}*/

// NORMALISASI 2
for($i=0;$i<count($alternatif);$i++){
	$jml=0;
	for($ii=0;$ii<count($kriteria);$ii++){
		$jml=$jml + ($kriteria[$ii][3]*$matriks_1[$i+1][$ii+1]);
	}
	$hasil[]=array(round($jml,3),$alternatif[$i][0]);
}
sort($hasil);
//for($i=0;$i<count($hasil);$i++){
for($i=count($hasil)-1;$i>=0;$i--){
	$rank=count($hasil)-$i;
	$hasil_akhir[$hasil[$i][1]]=array($hasil[$i][0],$rank);
	if(empty($best_alternatif)){
		$q=mysql_query("select * from alternatif where id_alternatif='".$hasil[$i][1]."'");
		$h=mysql_fetch_array($q);
		$nama=$h['nama'];
		$best_alternatif=$nama;
	}
}

$no=0;
$daftar_3='<td width="40">NO</td><td width="100">NIM</td><td>NAMA</td><td width="100">NILAI</td><td width="100">RANK</td>';
$daftar_3='<tr>'.$daftar_3.'</tr>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar_3.='<tr><td>'.$no.'</td><td>'.$alternatif[$i][1].'</td><td>'.$alternatif[$i][2].'</td><td>'.$hasil_akhir[$alternatif[$i][0]][0].'</td><td>'.$hasil_akhir[$alternatif[$i][0]][1].'</td></tr>';
	//$daftar_3.='<tr><td>'.$no.'</td></tr>';
}


/*for($i=1;$i<=$no;$i++){ # alternatif
	$jml=0;
	for($ii=1;$ii<=$no_1;$ii++){ # kriteria
		$jml=$jml + ($kriteria_bobot[$ii-1]*$matriks_1[$i][$ii]);
	}
	$hasil[]=array(round($jml,3),$id_alternatif[$i-1]);
}
if($no>0){sort($hasil);}*/
/*$ii=0;
for($i=($no-1);$i>=0;$i--){ # alternatif
	$ii++;
	$q=mysql_query("select * from alternatif where id_alternatif='".$hasil[$i][1]."'");
	$h=mysql_fetch_array($q);
	$nama=$h['nama'];
	$hasil.='
	  <tr>
		<td valign="top">'.$ii.'</td>
		<td valign="top"><a href="?hal=detail&id='.$h['id_alternatif'].'">'.$nama.'</a></td>
		<td valign="top" align="center">'.$hasil[$i][0].'</td>
	  </tr>
		';
	# catat data kacamata pada urutan pertama
	if(empty($best_alternatif)){
		$best_alternatif=$nama;
	}
}*/

?>

        <div style="font-family:Arial;font-size:12px;padding:3px ">
		<div style="font-size:18px;padding:10px 0 10px 0 ">HASIL ANALISA</div>
		<br>
		<!--<div style="overflow:scroll;height:520px;">-->
		<div style="overflow:scroll;width:640px">
		<table width="<?php echo (340+($jumlah_kriteria*180));?>" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <?php echo $daftar;?>
		</table>
		</div>
		<br /><br />
		<div style="overflow:scroll;width:640px">
		<table width="<?php echo (340+($jumlah_kriteria*60));?>" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <?php echo $daftar_1;?>
		</table>
		</div>
		<br /><br />NORMALISASI<br /><br />
		<div style="overflow:scroll;width:640px">
		<table width="<?php echo (340+($jumlah_kriteria*60));?>" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <?php echo $daftar_2;?>
		</table>
		</div>
		<br /><br />
		<div style="overflow:scroll;width:640px">
		<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <?php echo $daftar_3;?>
		</table>
		</div>
		<br /><br />
		Alternatif yang disarankan adalah <strong><?php echo $best_alternatif;?></strong>
		<br /><br />
		<form action="" method="post">
		<input name="cmd_back" type="button" value="&lt; Kembali" onclick="location.href='?hal=analisa';" /> <input name="cmd_new" type="submit" value="Ulangi / Baru" /> <a href="hasil.php"> <input name="cmd_ex" type="button" value="Simpan Ke Excel" onclick="hasil.php';" /></a>
		</form>
		<!--</div>-->
    	</div>
