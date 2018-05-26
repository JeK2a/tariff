<?php
$key =  $_REQUEST['group'];

$json = file_get_contents('http://sknt.ru/job/frontend/data.json');
$group = json_decode($json, true)['tarifs'][$key];

?>
<p>Тариф "<?php echo $group['title']; ?>"</p>
<div class="row">


<?php foreach ($group['tarifs'] as $tarif) { ?>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <p class="green"><?php echo $tarif['pay_period']; ?> месяца</p>
        <hr>
        <p><?php echo ($tarif['price'] / $tarif['pay_period']); ?> ₽/мес</p>
        <div id="page-bottom"></div>
    </div>

<?php
}
?>
</div>



