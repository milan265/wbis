<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
    }


    function prestupna($godina){
        if(($godina%100!=0 && $godina%4==0)||$godina%400==0){
            return true;
        }else{
            return false;
        }
    }

    function izracunajBrojDanaUMesecu($mesec, $godina){
        switch($mesec){
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                $brojDana = 31;
                break;
            case 4:
            case 6:
            case 9:
            case 11:
                $brojDana = 30;
                break;
            case 2:
                if(prestupna($godina)){
                    $brojDana = 29;
                }else{
                    $brojDana = 28;
                }
                break;
        }
        return $brojDana;
    }

    $kartica = getKartica();

    $dan = date("d");
    $mesec = date("m");
    $godina = date("Y");
    $brojDanaUMesecu = izracunajBrojDanaUMesecu($mesec,$godina);
    if($dan>20 || ($kartica['budzet']==0)){
        $korak = 1;
    }else{
        $korak = 10;
    }
    

    if($kartica['beogradska']){
        $maxBrojObroka1 = $brojDanaUMesecu - $kartica['dorucak'] - $kartica['rucak'] - $kartica['vecera'];
        $maxBrojObroka2 = $maxBrojObroka1;
        $maxBrojObroka3 = $maxBrojObroka1;
    }else{
        $maxBrojObroka1 = $brojDanaUMesecu - $kartica['dorucak'];
        $maxBrojObroka2 = $brojDanaUMesecu - $kartica['rucak'];
        $maxBrojObroka3 = $brojDanaUMesecu - $kartica['vecera'];
    }

    $budzet = $kartica['budzet'];
    $stanje = $kartica['stanje_na_racunu'];

    echo "<div class='main mainHeight'>";
    if($kartica['validna']){
        $const = APP_KEY;
        echo "<input type='hidden' id='app-key-uplata-obroka' name='app-key-uplata-obroka' value=\"$const\"/>";

        echo "<div id='uplata-sadrzaj'>
                <div id='main-uplata-obroka'>
                    <div id='uplata-dorucak' class='uplata-flex'>
                        <p>Doručak</p>
                        <span id='dorucak'>0</span>
                        <div class='strelice'>
                            <i class='fa fa-angle-up fa-lg' onclick=\"dodajObrok('dorucak',$korak,$maxBrojObroka1,$budzet)\"></i>
                            <i class='fa fa-angle-down fa-lg' onclick=\"smanjiObrok('dorucak',$korak,$budzet)\"></i>
                        </div>
                    </div>

                    <div id='uplata-rucak' class='uplata-flex'>
                        <p>Ručak</p>
                        <span id='rucak'>0</span>
                        <div class='strelice'>
                            <i class='fa fa-angle-up fa-lg' onclick=\"dodajObrok('rucak',$korak,$maxBrojObroka2,$budzet)\"></i>
                            <i class='fa fa-angle-down fa-lg' onclick=\"smanjiObrok('rucak',$korak,$budzet)\"></i>
                        </div>
                    </div>

                    <div id='uplata-vecera' class='uplata-flex'>
                    <p>Večera</p>
                        <span id='vecera'>0</span>
                        <div class='strelice'>
                            <i class='fa fa-angle-up fa-lg' onclick=\"dodajObrok('vecera',$korak,$maxBrojObroka3,$budzet)\"></i>
                            <i class='fa fa-angle-down fa-lg' onclick=\"smanjiObrok('vecera',$korak,$budzet)\"></i>
                        </div>
                    </div>

                    <div id='uplata-stanje' class='uplata-flex'>
                        <p>Stanje na računu</p>
                        <span id='stanje'>$stanje</span>
                    </div>

                    <div id='uplata-iznos' class='uplata-flex'>
                        <p>Iznos računa</p>
                        <span id='iznos'>0</span>
                    </div>

                    <button id='btnUplatiObrok' type='button' onclick='uplatiObrok()'>Uplati</button>
                </div>
            </div>";
    }else{
        echo "<div class=\"nije-validna\"><h1>Kartica nije validna</h1><h1>Nije moguće izvršiti uplatu obroka</h1></div>";
    }
    echo "<div id=\"snackbar-uplata-obroka\"></div>";
    echo "</div>";
?>
