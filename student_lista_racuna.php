<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
    }

    $transakcije = getTransakcije();

    if(!isset($_GET['paginacija'])){
        $_GET['paginacija'] = 1;
    }
    if(isset($_GET['paginacija']) && intval($_GET['paginacija'])>0){
        $stranica = $_GET['paginacija'];
    }else{
        $stranica = 1;
    }

    $poStranici = 10;
    $brojTransakcija = count($transakcije);
    $ukupnoStranica = ceil($brojTransakcija / $poStranici);
    if($stranica > $ukupnoStranica){
        $stranica = $ukupnoStranica;
    }
    $pocetak = ($stranica-1)*$poStranici;
    $transakcijePoStranici = array_slice($transakcije, $pocetak, $poStranici);
    
?>


<div class='main mainHeight'>
    <div class="flex-class">
        <div class='container tabela'>
            <table id="lista-racuna" class='table table-striped'>
                <thead>
                    <tr>
                        <th>Broj transakcije</th>
                        <th>Datum i vreme</th>
                        <th>Doručak</th>
                        <th>Ručak</th>
                        <th>Večera</th>
                        <th>Iznos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($transakcijePoStranici AS $transakcija){
                            echo "<tr>";
                            $transakcijaId = $transakcija['transakcija_id'];
                            $vreme = $transakcija['vreme'];
                            $dorucak = $transakcija['dorucak'];
                            $rucak = $transakcija['rucak'];
                            $vecera = $transakcija['vecera'];
                            $iznos = $transakcija['iznos'];
                            echo "<td>$transakcijaId</td>";
                            echo "<td>$vreme</td>";
                            echo "<td>$dorucak</td>";
                            echo "<td>$rucak</td>";
                            echo "<td>$vecera</td>";
                            echo "<td>$iznos</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Navigacija" class='paginacija'>
            <ul class="pagination justify-content-center" style="margin:20px 0">
                <li class="page-item">
                <a class="page-link" aria-label="Previous" onclick="paginacijaNazad(<?php echo $stranica;?>,'lista-racuna')">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
                </li>
            
                <?php
                    $brStraniceZaPrikazivanje = ($ukupnoStranica>3)?3:$ukupnoStranica;
                    $pocetakPaginacije = ($stranica>1)?($stranica-1):1;
                    if($stranica==$ukupnoStranica&&$brStraniceZaPrikazivanje==3){
                        $pocetakPaginacije = $ukupnoStranica-2;
                    }
                    for($i=$pocetakPaginacije; $i<$pocetakPaginacije+$brStraniceZaPrikazivanje; $i++){
                        echo "<li class='page-item ";
                        if($stranica == $i){
                            echo "active";
                        }
                        echo "'><a class='page-link ";
                        echo "' id='broj-$i' href='http://localhost/wbis/index.php?stranica=lista-racuna&paginacija=$i'>$i</a><li>";
                    }
                ?>

                <li class="page-item">
                <a class="page-link" aria-label="Next" onclick="paginacijaNapred(<?php echo $stranica;?>,<?php echo $ukupnoStranica;?>,'lista-racuna')">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</div>