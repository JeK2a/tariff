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
    <div>
        <button id='backtogroups' class='back'><</button>
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
    <div class='shiftbig'></div>
    <div class='row'>
        <?php foreach ($group['tarifs'] as $tkey => $tarif) { ?>
        <div class='col-xs-12 col-sm-12 col-md-6 col-lg-4'>
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
            <div>
                <p><?php echo ($tarif['price'] / $tarif['pay_period']) ?> ₽/мес</p>
                <p>разовый платёж - <?php echo $tarif['price'] ?> ₽</p>
                <?php

                $sell = $price * $tarif['pay_period'] - $tarif['price'];//
                if ($sell > 0) {
                    echo "<p>скидка - $sell</p>";//
                }

                ?>
                <button id="tariff<?php echo $tkey ?>">></button>
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
            <div id="shift"></div>
        </div>
        <?php
        }
        ?>
    </div>
</div>