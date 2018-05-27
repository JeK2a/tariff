<?php

$gkey = $_REQUEST['gkey'];
$tkey = $_REQUEST['tkey'];

$json = file_get_contents('http://sknt.ru/job/frontend/data.json');
$tariff = json_decode($json, true)['tarifs'][$gkey]['tarifs'][$tkey];

?>

<div>
    <div>
        <button id="backtotariff"><</button>
        <script>
            $('#backtotariff').click(function(){
                $.ajax({
                    type: "POST",
                    url: "tariffs.php",
                    data: "gkey=" + <?php echo $gkey; ?>,
                    success: function(html){
                        $("#content").html(html);
                    }
                });
                return false;
            });
        </script>
        <p class="center">Выбор тарифа</p>
    </div>
    <br>
    <p>Период оплаты - <?php echo $tariff['pay_period']; ?></p>
    <p><?php echo ($tariff['price'] / $tariff['pay_period']); ?>  ₽/мес</p>
    <hr>
    <p>разовый платём - <?php echo $tariff['price']; ?></p>
    <p>со счёта спишется - <?php echo $tariff['price']; ?></p>
    <hr>
    <p>вступит в силу - сегодня</p>

    <?php
        $timestamp = $tariff['new_payday'];
        $datetimeFormat = 'd-m-Y';

        //$date = new \DateTime();
        $date = new \DateTime('now', new \DateTimeZone('Europe/Helsinki'));
        $date->setTimestamp($timestamp);
        echo "<p>активно до - " . $date->format($datetimeFormat) . "</p>";
    ?>

    <div id="shift"></div>
</div>