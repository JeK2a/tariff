<?php

$gkey = $_REQUEST['gkey'];

$json = file_get_contents('http://sknt.ru/job/frontend/data.json');
$group = json_decode($json, true)['tarifs'][$gkey];

$price = 0;

foreach ($group['tarifs'] as $paket) {
    $price = max($price, ($paket['price'] / $paket['pay_period']));
}

?>

<div>
    <div class="row">
        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 fon'>
            <a><img id="backtogroups" class="back" src="back.png"></a>
            <script>
                $('#backtogroups').click(function(){
                    $.ajax({
                        type: "POST",
                        url:  "groups.php",
                        success: function(html){
                            $('#content').html(html);
                        }
                    });
                    return false;
                });
            </script>
            <p class='center'>Тариф "<?php echo $group['title'] ?>"</p>
        </div>
    </div>
    <div class='shiftbig'></div>
    <div class='row'>
        <?php foreach ($group['tarifs'] as $tkey => $tarif) { ?>
        <div class='col-xs-12 col-sm-12 col-md-6 col-lg-4 box'>
            <p class='green'><?php

                echo $tarif['pay_period'];
                if ($tarif['pay_period'] == 1) {
                    echo ' месяц';
                } elseif ($tarif['pay_period'] < 5) {
                    echo ' месяца';
                } else {
                    echo ' месяцев';
                }

                ?></p>
            <hr>
            <div class="row">
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                    <p><?php echo ($tarif['price'] / $tarif['pay_period']) ?> ₽/мес</p>
                    <p>разовый платёж - <?php echo $tarif['price'] ?> ₽</p>
                    <?php

                    $sell = $price * $tarif['pay_period'] - $tarif['price'];//
                    if ($sell > 0) {
                        echo "<p>скидка - $sell</p>";//
                    }

                    ?>
                    <a><img id="tariff<?php echo $tkey ?>" class="next" src="next.png"></a>
                    <script>
                        $('#tariff<?php echo $tkey ?>').click(function(){
                            $.ajax({
                                type: "POST",
                                url:  "tariff.php",
                                data: ({gkey: <?php echo $gkey ?>,
                                    tkey: <?php echo $tkey ?>}),
                                success: function(html){
                                    $("#content").html(html);
                                }
                            });
                            return false;
                        });
                    </script>
                </div>
            </div>
            <div class="shift"></div>
        </div>
        <?php
        }
        ?>
    </div>
</div>