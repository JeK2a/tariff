<div class="row">
    <?php

    $json = file_get_contents('http://sknt.ru/job/frontend/data.json');
    $groups = json_decode($json, true)['tarifs'];

    foreach ($groups as $gkey => $group) {

        $prices = array();

        foreach ($group['tarifs'] as $paket) {
            $prices[] = $paket['price'] / $paket['pay_period'];
        }
        $prices = min($prices) . '-' . max($prices);

    ?>

    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-4 box'>
        <p class='green'>Тариф "<?php echo $group['title'] ?>"</p>
        <hr>
        <div class="row">
            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <p class='speed'><?php echo $group['speed'] ?> Мбит/с</p>
                <p class="price"><?php echo $prices ?> ₽/мес</p>
                <?php

                if (!empty($group['free_options'])) {
                    foreach ($group['free_options'] as $freeoption) {
                        echo "<p>$freeoption</p>";
                    }
                }

                ?>
                <a><img id="group<?php echo $gkey ?>" class="next" src="next.png" alt="Кекс"></a>
                <script>
                    $('#group<?php echo $gkey ?>').click(function(){
                        $.ajax({
                            type: "POST",
                            url:  "tariffs.php",
                            data: "gkey=" + <?php echo $gkey ?>,
                            success: function(html){
                                $("#content").html(html);
                            }
                        });
                        return false;
                    });
                </script>
            </div>
        </div>
        <hr>
        <a href="<?php echo $group['link'] ?>">узнать подробнее на сайте www.sknt.ru</a>
        <div class="shift"></div>
    </div>
    <?php
    }
    ?>
</div>

