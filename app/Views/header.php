<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$title?></title>
	<link rel="stylesheet" href="<? echo base_url();?>/css/style.css">
</head>
<body>
    <script>
        var base_url='<? echo base_url();?>';
        var current_lang='<?= $lang?>';
        
        function redirect_vs_Lang(lang){
            location.href='<? echo base_url();?>/lang/'+lang;
        }
    </script>
    <div id="header">
        <? if ($return_link == true)
            {
                echo "<p>".lang('header.return_link')."</p>";
            }
        ?>
        <div id="lang">
            <div class="lang cursor-pointer opacity-hover" lang="en" onClick="redirect_vs_Lang('en')">
                EN
            </div>
            <div class="lang cursor-pointer opacity-hover" lang="ru" onClick="redirect_vs_Lang('ru')">
                RU
            </div>
        </div>
    

    </div>