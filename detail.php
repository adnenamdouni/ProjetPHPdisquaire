

<?php 
$connection = 'mysql:host=localhost;dbname=cd_tek';
$user = "web001";
$pass = "topsecret";
$contenu="";
$nouveau="";
$detail="";
$liste="";
$cat="";

$form="";

global $dbh;
$cmd = ""; 

$contenu.= "";
try{
    $dbh = new PDO($connection, $user, $pass);
}catch (PDOException $e) {
    //header("Location: erreur.html");
}
echo "<h1> Infos CD </h1>";
    
    $id=$_GET['id'];

    foreach ($dbh->query("SELECT D.id, titre, artiste, evaluation,commentaire, cat, photo FROM cd D, categorie C WHERE D.id=$id AND C.id=categorie ") as $ligne){
        $nouveau.= "<br> Album : ".$ligne['titre']."<br> Ariste:  ".$ligne['artiste']." <br> Evaluation:  ".$ligne['evaluation']." <br> Commentaire:  ".$ligne['commentaire']." <br> categorie:  ".$ligne['cat']." <br> <img src=".$ligne['photo']."></li> <br><br>" ;
    }

    echo"<p> $nouveau</p>";

    //  importer -----------------------------------------------------------------------------------
    function testId($id){
        if($id==0){
            echo "<h4> IL faut entrer un nom</h4>";
            return false;} else { return true;}
        }
try{
    $dbh = new PDO($connection , $user, $pass);
}catch (PDOException $e) {
    // header("Location: erreur.html");
}

if(isset($_GET['cmd'])){
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        $id = 0;
    }
   $cmd = $_GET['cmd'];
   switch($cmd){
    case "add":
        $req = $dbh->prepare("INSERT INTO `com` (`comment`, `cd`) 
                            VALUES(:comment, :cd)");
$req->BindParam(":comment", $_GET['comment']);
$req->BindParam(":cd", $_GET['id']);
$req->execute();
echo "Votre commentaire".$_GET['comment']." a été bien ajouté";
    break;

    case "av":
        $req = $dbh->prepare("INSERT INTO `com` (`avis`, `cd`) 
                                VALUES(:avis, :cd)");
$req->BindParam(":avis", $_GET['avis']);
$req->BindParam(":cd", $_GET['id']);
$req->execute();
    break;

    default:
        echo "<h2>Commande Inconnue</h2>";
    }
}
echo "<form method='GET'>
<br><input type='texte' name='comment' placeholder='saisir votre commentaire ici'><br>";
echo "<input type='hidden' name='id' value='$id'>";
echo "<input type='submit' name='cmd' value='add'>";

echo "</form>";

echo "<form method='GET'>
<br><input type='texte' name='avis' placeholder='Saisir une note de 1 à 5'><br>";
echo "<input type='hidden' name='id' value='$id'>";
echo "<input type='submit' name='cmd' value='av'>";
//echo "Votre avis".$_GET['avis']." a été bien enregistré";
echo "</form>";


$texte=array(
    "titre"=>"BATEAU PIRATE",
    "description"=>"Hanc regionem praestitutis celebritati diebus invadere parans dux ante edictus per solitudines Aboraeque amnis herbidas ripas, suorum indicio proditus, qui admissi flagitii metu exagitati ad praesidia descivere Romana. absque ullo egressus effectu deinde tabescebat immobilis.
                        Martinus agens illas provincias pro praefectis aerumnas innocentium graviter gemens saepeque obsecrans, ut ab omni culpa inmunibus parceretur, cum non inpetraret, minabatur se discessurum: ut saltem id metuens perquisitor malivolus tandem desineret quieti coalitos homines in aperta pericula proiectare.
                        Ardeo, mihi credite, Patres conscripti (id quod vosmet de me existimatis et facitis ipsi) incredibili quodam amore patriae, qui me amor et subvenire olim impendentibus periculis maximis cum dimicatione capitis, et rursum, cum omnia tela undique esse intenta in patriam viderem, subire coegit atque excipere unum pro universis. Hic me meus in rem publicam animus pristinus ac perennis cum C. Caesare reducit, reconciliat, restituit in gratiam.",
    "nouveau"=>$nouveau,
    "cat"=>$cat,
    "contenu"=>$contenu,
);

$page = file_get_contents("testdetail.html");
    foreach ($texte as $key=>$value){
        $page= str_replace("{{ $key }}",$value, $page);
    }
    echo $page;

    ?>



    