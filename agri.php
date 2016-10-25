<?php 
	
    $Dosyam="agri.txt"; 

    $DosyaAc = fopen($Dosyam, r); 

    $Oku = fread($DosyaAc,filesize($Dosyam)); 

    fclose($fopen); 

    $sil = "\n"; 

    $bol = explode($sil, $Oku);

    $array[] = null;
    $tab = "\t"; 

    foreach ($bol as $string) /* Dosya döngüye alınır ve içerisinde bulunan posta kodu ile Hamur ilçesine ait köyleri listelenir.*/
    {
        $row = explode($tab, $string); 
        array_push($array,$row); 

		if (in_array('04852', $row, true)) {
			
			echo '<pre>';
				print_r($row); /*Sadece Hamur ilcesine ait bilgiler gelir.*/
 $IL_ADI =print_r($row[0]); 
 $ILCE_ADI =print_r($row[1]); 
 $MAHALLE  =print_r($row[2]); 
 $POSTAKODU =print_r($row[3]); 
 $Ekle=mysql_query("INSERT INTO ILLER_TABLOSU SET IL='$IL_ADI' , Ilce='$ILCE_ADI', SEMT='$MAHALLE', PostaKodu='$POSTAKODU'") or die("Ekleme yaparken hata oluştu."); 
		}		
    }      
?>
