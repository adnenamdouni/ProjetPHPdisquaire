<?php 
$connection = 'mysql:host=localhost;dbname=cd_tek';
$user = "web001";
$pass = "topsecret";
$contenu="";
$nouveau="";
$detail="";
$liste="";
$cat="";
$bouton="";
$form="";

global $dbh;
$cmd = ""; 

$contenu.= "<h1>Le Bâteau Pirate</h1>";
$contenu.= "<h2>La boutique</h2>";
try{
    $dbh = new PDO($connection, $user, $pass);
}catch (PDOException $e) {
    //header("Location: erreur.html");
}
$contenu.= "<h2>Le Catalogue des disques</h2>";
foreach ($dbh->query("SELECT D.id as id, titre, photo, cat FROM cd D,categorie C  WHERE C.id=categorie") as $ligne){
$cat.= "<br>  Album: ".$ligne['titre']."<br> Genre: ".$ligne['cat'].""; 
$cat.="<a href='detail.php?id=".$ligne['id']."'> <img src=".$ligne['photo']."></li>";
}



// fin liste entière

$dbh = NULL;

$texte=array(
    "titre"=>"BATEAU PIRATE",
    "description"=>"Hanc regionem praestitutis celebritati diebus invadere parans dux ante edictus per solitudines Aboraeque amnis herbidas ripas, suorum indicio proditus, qui admissi flagitii metu exagitati ad praesidia descivere Romana. absque ullo egressus effectu deinde tabescebat immobilis.
                        Martinus agens illas provincias pro praefectis aerumnas innocentium graviter gemens saepeque obsecrans, ut ab omni culpa inmunibus parceretur, cum non inpetraret, minabatur se discessurum: ut saltem id metuens perquisitor malivolus tandem desineret quieti coalitos homines in aperta pericula proiectare.
                        Ardeo, mihi credite, Patres conscripti (id quod vosmet de me existimatis et facitis ipsi) incredibili quodam amore patriae, qui me amor et subvenire olim impendentibus periculis maximis cum dimicatione capitis, et rursum, cum omnia tela undique esse intenta in patriam viderem, subire coegit atque excipere unum pro universis. Hic me meus in rem publicam animus pristinus ac perennis cum C. Caesare reducit, reconciliat, restituit in gratiam.",
    "nouveau"=>$nouveau,
    "cat"=>$cat,
    "contenu"=>$contenu,
    "boutique"=>"LE CATALOGUE",
);

$page = file_get_contents("testbout.html");
    foreach ($texte as $key=>$value){
        $page= str_replace("{{ $key }}",$value, $page);
    }
    echo $page;
?>
    ?>


    