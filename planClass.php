<?PHP



class plan_lekcji {

var $polaczenie; // uchwyt do bazy danych
var $id_klasy = array (    1 => '1a',    2 => '1b',   3 => '1c',
                          4 => '1d',    5 => '2a',   6 => '2b',
                          7 => '2c',    8 => '2d',   9 => '2e',
                          10 => '3a',   11 => '3b',  12 => '3c',
                          13 => '3d' ); // napis zamiast cyfry
                          
var $tydz = array (       1 => 'pon.',  2 => 'wt.',  3 => '¶r.',
                          4 => 'czw.',  5 => 'pt' ); // napis zamiast cyfry

// bool lacz_z_bd()
// polaczenie z bd
function lacz_z_bd($host="localhost", $user="lo", $haslo="lo.123") {
 if(!$this -> polaczenie = mysql_connect($host, $user, $haslo)) return false;
 if(!mysql_select_db("lo")) return false;

 return true;
}


// string dzien_tygodnia(int nr)
// wy¶wietla tekstowy dzien tygodnia , zamiast numeru
function dzien_tygodnia($nr) {
  $dzien = array (
   1 => 'poniedzia³ek',
   2 => 'wtorek',
   3 => '¶roda',
   4 => 'czwartek',
   5 => 'pi±tek' );
   
  return $dzien[$nr];
}

// void godziny_lekcji()
// wyswietla gorny wiersz tabeli, z godzinami lekcji
function godziny_lekcji () {
         echo "\n\n\n<table cellspacing='1' cellpadding='0' class='plan1'>\n"
         . "<tr class='gorne'>\n"
         . "<td>Godz.:</td>\n"
         . "<td>8.00-8.45</td>\n"
         . "<td>8.55-9.40</td>\n"
         . "<td>9.50-10.35</td>\n"
         . "<td>10.55-11.40</td>\n"
         . "<td>11.50-12.35</td>\n"
         . "<td>12.45-13.30</td>\n"
         . "<td>13.35-14.20</td>\n"
         . "<td>14.25-15.10</td>\n"
         . "</tr>";
}

// void wyswietl lekcje(string klasa, int dzien)
//
function wyswietl_lekcje($klasa, $dzien) {
  $query = "SELECT przedmiot FROM plan WHERE klasa='$klasa'"; // poczatek zapytania - zawsze taki sam
  ($dzien==6) ? $query .= ";" : $query .= " AND dzien=$dzien;"; // tylko wybrany dzieñ lu ca³y tydzieñ

  if (!$wynik = mysql_query($query, $this -> polaczenie)) return false;

  while ($myrow = mysql_fetch_assoc($wynik)) {
       echo '<td>'.$myrow['przedmiot']."</td>\n";
  }
}


// void wyswietl_calosc()
// wyswietla wszystkiedni i wszystkie klasy
function wyswietl_calosc() {
   for ($i=1; $i<=5; $i++) {
      echo '<p><b>'.$this -> dzien_tygodnia($i).'</b></p>';
      $this -> godziny_lekcji();

      for ($m=1; $m<=13; $m++) {
         echo "<tr>\n";
         echo '<td class="bok">kl.'. $this -> id_klasy[$m]."</td>\n";
         echo $this -> wyswietl_lekcje($this -> id_klasy[$m],$i);
         echo '</tr>';
      }

      echo "</table>";
   }

}


// void wyswietl selektywnie(int ktora_klasa, int ktory_dzien)
// wyswietla jeden dzien dla konkretnej klasy lub ca³ej szkoly,
// lub caly tydzien dla klasy
function wyswietl_selektywnie($ktora_klasa, $ktory_dzien) {
   if ($ktory_dzien != 6) {
        echo '<p><b>'.$this -> dzien_tygodnia($_GET['dzien']) . ' dla klasy '. $_GET['klasa'].':</b></p>';
        echo $this -> godziny_lekcji();
        echo "<tr>\n";
        echo '<td class="bok">'.$this -> tydz[$_GET['dzien']]."</td>\n";
        echo $this -> wyswietl_lekcje($_GET['klasa'],$_GET['dzien']);
        echo '</tr>';
        echo "</table>\n";
   } else if ($ktory_dzien == 6) {
        echo '<p><b>Klasa '. $_GET['klasa'] ." na ca³y tydzieñ:</b></p>\n";
        $this -> godziny_lekcji();

        for ($i=1; $i<6; $i++) {
             echo "<tr>\n";
             echo '<td class="bok">'.$this -> tydz[$i]."</td>\n";
             echo $this -> wyswietl_lekcje($_GET['klasa'],$i);
             echo "</tr>\n";
       }

       echo "</table>\n";
    }

}


// void ile_dni()
// sprawdza przekazane do skryptu zmienne i wyswietla odpowiednia liczbe dni
function wyswietl() {
 include('pliki/plan.htm');
 if (!isset($_GET['zmiana'])) $this -> wyswietl_calosc();
 if (isset($_GET['zmiana']) && isset($_GET['dzien'])) $this -> wyswietl_selektywnie($_GET['klasa'], $_GET['dzien']);
} // koniec funkcji

} // koniec klasy
?>
