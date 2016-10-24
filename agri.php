<?php 
	
	$Dosyam="agri.txt"; /*Dosyayı seçiyorum agri.txt */

    $DosyaAc = fopen($Dosyam, r); /*Dosyayı acıyorum.*/

    $Oku = fread($DosyaAc,filesize($Dosyam)); /*Dosyayı okutuyorum. */

    fclose($fopen); /*Okuma bittikten sonra kapatıyorum.*/

    $sil = "\n"; /*Enter veya boşlukları sil*/

    $bol = explode($sil, $Oku);/*okuduğum yerleri bölüyorum */

    $array[] = null; /*array tanımlıyorum*/
    $tab = "\t";  /*tab*/

    foreach ($bol as $string) /* döngüye alıyorum dosyayı ve içerisinde bulunan posta kodu ile Hamur ilçesine ait köyleri listeliyorum.*/
    {
        $row = explode($tab, $string); /*değişkene atıyorum*/
        array_push($array,$row); /*elemanları dizinin sonuna kadar ekliyorum*/

		if (in_array('04852', $row, true)) { /*bu aşamada posta kodu eğer iceriyorsa echo ile ekrana basıyorum veya sql kodu ile sql sistemine kaydediyorum.*/
			
			echo '<pre>';
				print_r($row); /*Ekrana dizi bastırıyorum ve sadece Hamur ilcesine ait bilgiler geliyor.*/
			echo '</pre>';
			/*
				Eğer verileri tek tek veya hangi alanı listelemek istiyorsan 
				şu şekilde bir işlem yapılabilir. 
				
				print_r($row[0]) //sadece sıfırıncı değer Ağrı yazdıracak toplamda 5 tane değer bulunmakta tek tek almak için 0 yazan yere hangi değeri
				almak istiyorsan onu yazarız örneğin sadece mahalle isimlerini almak istiyorsak
				print_r($row[4])  ->>Buda sadece mahalle değerini verecektir. 
			*/
			/*aşağıda bulunan sql kodu ise veri tabanına ekleme yapacaktır.*/
			$IL_ADI =print_r($row[0]); //il Adını aldım
			$ILCE_ADI =print_r($row[1]); //ilce adı
			$MAHALLE  =print_r($row[2]); //mahalle adını aldım.
			$POSTAKODU =print_r($row[3]); //posta kodunu aldım. ü
			
			/*Döngü içerisinde olduğu için her döndüğünde sql tablosuna veri ekleyecek.*/
			$Ekle=mysql_query("INSERT INTO ILLER_TABLOSU SET IL='$IL_ADI' , Ilce='$ILCE_ADI', SEMT='$MAHALLE', PostaKodu='$POSTAKODU'") or die("Ekleme yaparken hata oluştu."); 
		}
		
    }
    
  
?>
