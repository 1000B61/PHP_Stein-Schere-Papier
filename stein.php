<?php
$siege=[];
$geg=rand(1,3);
if(isset($_POST["send"])&&$_POST["runden"]>0&&isset($_POST["aus"])){
    $siege["PC"]=$_POST["pc"];
    $siege["Spieler"]=$_POST["spieler"]; 
if($geg==$_POST["aus"]){ $ausgabe=" Unentschieden";}
else if ($geg==1&&$_POST["aus"]==2){ $siege["PC"]++; $ausgabe=" Stein schlägt Schere"; $_POST["runden"]--;}
else if ($geg==1&&$_POST["aus"]==3){ $siege["Spieler"]++; $ausgabe=" Papier schlägt Papier"; $_POST["runden"]--;}
else if ($geg==2&&$_POST["aus"]==1){ $siege["Spieler"]++; $ausgabe=" Stein schlägt Schere"; $_POST["runden"]--;}
else if ($geg==2&&$_POST["aus"]==3){ $siege["PC"]++; $ausgabe=" Schere schlägt Papier"; $_POST["runden"]--;}
else if ($geg==3&&$_POST["aus"]==1){ $siege["PC"]++; $ausgabe=" Papier schlägt Stein"; $_POST["runden"]--;}
else if ($geg==3&&$_POST["aus"]==2){ $siege["Spieler"]++; $ausgabe=" Schere schlägt Papier"; $_POST["runden"]--;}
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stein Schere Papier</title>
</head>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<?php if(isset($_POST["runden"])&&is_int($_POST["runden"]+0)&&$_POST["runden"]>0) { ?>
<br>
<select name="aus" >
    <option value="1">Stein</option>
    <option value="2">Schere</option>
    <option value="3">Papier</option>
</select>
<?php } else if((!isset($_POST["runden"])||!is_int($_POST["runden"]+0)||!($_POST["runden"]>0))&&!isset($siege["PC"])&&!isset($siege["Spieler"])) {?>
<p>Lass uns Stein Schere Papier spielen. Best of?</p> <?php } ?>
<input type="<?php if(isset($_POST["runden"])&&is_int($_POST["runden"]+0)&&$_POST["runden"]>=0) echo "hidden"; else echo "text";?>" name="runden" value="<?php if(isset($_POST["runden"])&&is_int($_POST["runden"]+0)&&$_POST["runden"]>0) echo $_POST["runden"];?> ">
<input type="hidden" name="pc" value="<?php if(isset($siege["PC"])&&$siege["PC"]>0) echo $siege["PC"]; else echo "0";?> ">
<input type="hidden" name="spieler" value="<?php if(isset($siege["Spieler"])&&$siege["Spieler"]>0) echo $siege["Spieler"]; else echo "0";?> ">
<?php if(!isset($_POST["runden"])||$_POST["runden"]!=0){ ?>
<input type="submit" name="send" value="Meine Wahl">
<?php if(isset($ausgabe)){ echo $ausgabe; }?>
<?php } else if(isset($siege["Spieler"])&&isset($siege["PC"])) { if($siege["Spieler"]==$siege["PC"]){?> 
<p>Unentschieden</p>
<?php } else if($siege["Spieler"]<$siege["PC"]){ ?>
<p>Ich habe gewonnen.</p>
<?php } else if($siege["Spieler"]>$siege["PC"]){ ?>
<p>Du hast gewonnen.</p>
<?php }} ?>
</body>
</html>