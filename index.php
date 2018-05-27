<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script type="text/javascript" src="jquery.js"></script>
    <title>Tariffs</title>
</head>
<body>
<div id="content"></div>
<script>
    $(document).ready(function(){
        $.ajax({
            type: "POST",
            url:  "groups.php",
            success: function(html){
                $("#content").html(html);
            }
        });
        return false;
    });
</script>
</body>
</html>