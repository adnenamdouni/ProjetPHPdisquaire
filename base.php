
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
try{
    $dbh = new PDO($connection, $user, $pass);
}catch (PDOException $e) {
    //header("Location: erreur.html");
}

$contenu.="<h2>Liste des CD nouveautés</h2>";
// liste nouveautés
    foreach ($dbh->query("SELECT id, titre, artiste, evaluation, photo FROM cd WHERE categorie=4") as $ligne){
        $nouveau.= "<br> Album : ".$ligne['titre']." <br> Ariste:  ".$ligne['artiste']."></li> <br><br>" ;
    }
// fin liste nouveautés

// Liste entière
//$contenu.= "<h2>Le Catalogue des disques</h2>";
//foreach ($dbh->query("SELECT D.id as id, titre, photo, cat FROM cd D,categorie C  WHERE C.id=categorie") as $ligne){
//$cat.= "<br> <li>/ Titre album: ".$ligne['titre']."/ Genre: ".$ligne['cat']."></li>"; 
//$cat.="<a href='detail.php?id=".$ligne['id']."'> <img src=".$ligne['photo']."></li>";
//}
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
);

$page = file_get_contents("test.html");
    foreach ($texte as $key=>$value){
        $page= str_replace("{{ $key }}",$value, $page);
    }
    echo $page;
?>
