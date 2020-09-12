<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
    }
    $v = getBrojValidnih();
    $bg = getBrojBeogradskih();
    $neBg = $v-$bg;
    $budzet = getBrojBudzetskih();
    $neBudzet = $v-$budzet;

    $brUplata = getBrojUplata();
    $sumaUplata = getSumaUplata();
    $brTransakcija = getBrojTransakcija();
    $sumaTransakcija = getSumaTransakcija();
    
?>

<div class="main mainHeight">
    <div id="admin-pocetna" class="flex-class">
        <div style="display:none;">
            <?php
                echo "<span id='brBg'>$bg</span>";
                echo "<span id='brNeBg'>$neBg</span>";
                echo "<span id='brBudzet'>$budzet</span>";
                echo "<span id='brNeBudzet'>$neBudzet</span>";
            ?>
        </div>

        <div class="admin-pocetna-podaci">
            <p>Ukupan broj validnih kartica: <?php echo $v?></p>
        </div>

        <div id="transakcije" class="admin-pocetna-podaci">
            <h2>Transakcije</h2>
            <p>Ukupan broj uplata: <?php echo $brUplata?></p>
            <p>Suma uplata: <?php echo $sumaUplata?>RSD</p>
            <p>Ukupan broj transakcija: <?php echo $brTransakcija?></p>
            <p>Suma transakcija: <?php echo $sumaTransakcija?>RSD</p>
        </div>

        <div id="bg-bar-chart">

        </div>

        <div id="budzet-bar-chart">

        </div>
    </div>
</div>