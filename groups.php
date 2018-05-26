<div class="row">

    <?php

    $json = file_get_contents('http://sknt.ru/job/frontend/data.json');
    $groups = json_decode($json, true)['tarifs'];

    foreach ($groups as $key => $group) {

        $prices = array();

        foreach ($group['tarifs'] as $paket) {
            $prices[] = $paket['price'] / $paket['pay_period'];
        }
        $prices = min($prices).'-'.max($prices);

        ?>

        <div class='col-xs-12 col-sm-12 col-md-6 col-lg-4'>

            <p class="green">Тариф "<?php echo $group['title']; ?>"</p>

            <hr>

            <div class='row'>
                <div class='col-xs-10 col-sm-10 col-md-10 col-lg-10'>
                    <p class='speed'><?php echo $group['speed']; ?></p>
                    <p><?php echo $prices; ?> ₽/мес</p>
                    <?php
                    if (!empty($group['free_options'])) {
                        foreach ($group['free_options'] as $freeoption) {
                            echo "<p>$freeoption</p>";
                        }
                    }
                    ?>
                </div>
                <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>
                    <form id="form<?php echo $key; ?>">
                        <input id="group<?php echo $key; ?>" type="text" size="10" value="<?php echo $key; ?>"><br/><br/>
                        <input type="submit" value=">">
                    </form>

                    <script>
                        // $(document).ready(function(){
                        $('#form<?php echo $key; ?>').submit(function(){
                            console.log('next');
                            $.ajax({
                                type: "POST",
                                url: "tariffs.php",
                                data: "group=" + $("#group<?php echo $key; ?>").val(),
                                success: function(html){
                                    $("#content").html(html);
                                }
                            });
                            return false;
                        });
                        // });
                    </script>

                </div>
            </div>
            <hr>
            <a href="<?php echo $group['link'] ?>">узнать подробнее на сайте www.sknt.ru</a>
            <div id="page-bottom"></div>
        </div>

        <?php
    }
    ?>

</div>

