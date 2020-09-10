<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
    }

    $poruke = getPoruke();
    $poruke = array_reverse($poruke);
    $brojPoruka = count($poruke);

    if(!isset($_GET['paginacija'])){
        $_GET['paginacija'] = 1;
    }
    if(isset($_GET['paginacija']) && intval($_GET['paginacija'])>0){
        $stranica = $_GET['paginacija'];
    }else{
        $stranica = 1;
    }

    $poStranici = 10;
    $ukupnoStranica = ceil($brojPoruka / $poStranici);
    if($stranica > $ukupnoStranica){
        $stranica = $ukupnoStranica;
    }
    $pocetak = ($stranica-1)*$poStranici;
    $porukePoStranici = array_slice($poruke, $pocetak, $poStranici);
?>

<div class="main mainHeight">
    <div class="flex-class">
        <div id="poruke-sadrzaj">
            <div  class="panel-group" id="accordion">
                <?php 
                foreach($porukePoStranici AS $i=>$poruka){
                    echo "<div class='panel panel-default'>
                            <div onclick='procitajPoruku(". APP_KEY.",".$poruka['poruka_id'].",\"naslov$i\")' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse$i'>
                                <h4 id='naslov$i' class='panel-title";
                    if($poruka['procitana']==0){
                        echo " poruke-b";
                    }
                                
                    echo    "' >".
                                    $poruka['naslov']
                                ."</h4>
                            </div>
                            <div id='collapse$i' class='panel-collapse collapse'>
                                <div class='panel-body'>
                                    <table>
                                        <tr>
                                            <td class='poruke-b'>Ime:</td>
                                            <td>".$poruka['ime']."</td>
                                        </tr>
                                        <tr>
                                            <td class='poruke-b'>Prezime:</td>
                                            <td>".$poruka['prezime']."</td>
                                        </tr>
                                        <tr>
                                            <td class='poruke-b'>E-mail:</td>
                                            <td>".$poruka['email']."</td>
                                        </tr>
                                        <tr>
                                            <td class='poruke-b'>Broj kartice:</td>
                                            <td>".$poruka['broj_kartice']."</td>
                                        </tr>
                                        <tr>
                                            <td class='poruke-b'>Datum i vreme:</td>
                                            <td>".$poruka['vreme']."</td>
                                        </tr>
                                    </table>
                                    <div class='tekst-poruke'>".
                                        $poruka['tekst']
                                    ."</div>
                                </div>
                            </div>
                        </div>";
                }
                ?>
                    
            </div>
        </div> 
        <nav aria-label="Navigacija" class='paginacija'>
            <ul class="pagination justify-content-center" style="margin:20px 0">
                <li class="page-item">
                <a class="page-link" aria-label="Previous" onclick="paginacijaNazad(<?php echo $stranica;?>,'poruke')">
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
                        echo "' id='broj-$i' href='http://localhost/wbis/index.php?stranica=poruke&paginacija=$i'>$i</a><li>";
                    }
                ?>

                <li class="page-item">
                <a class="page-link" aria-label="Next" onclick="paginacijaNapred(<?php echo $stranica;?>,<?php echo $ukupnoStranica;?>,'poruke')">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
