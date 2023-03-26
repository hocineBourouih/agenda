<?php
require_once("Lib.php");
$action = key_exists('action', $_GET)? trim($_GET['action']): null;
$sauvegarde = key_exists('sauvegarde', $_GET)? trim($_GET['sauvegarde']): null;
switch ($action) {

	case "liste": //liste complète
		$corps="<h1>Liste des personnes</h1>";
		$connection =connecter();
		$requete="SELECT * FROM personne";
		
		// On envois la requète
		$query  = $connection->query($requete);

		// On indique que nous utiliserons les résultats en tant qu'objet
		$query->setFetchMode(PDO::FETCH_OBJ);
		
		// Nous traitons les résultats en boucle
		$corps.= "<h4><span class='c1'><b><u>IdP</u></span> <span class='c1'>Nom</span><span class='c1'>Prenom</span>  </span><span class='c1'>Action</b></span></h4>";

		while( $enregistrement = $query->fetch() )
		{
			//$tab_Personne[$enregistrement->idP]=array($enregistrement->nom,$enregistrement->prenom);
			// Affichage des enregistrements
			$idP=$enregistrement->idP;$nom=$enregistrement->nom;$prenom=$enregistrement->prenom;
			$tab_Personne[$idP]=array($nom,$prenom);
			$corps.= "<span class='c1'><u><b>".$enregistrement->idP."</b></u></span> <span class='c1'>".$enregistrement->nom." </span><span class='c1'>". $enregistrement->prenom."</span>";
			$corps.=  '<span class=\'c1\'><a href="index.php?action=select&idP='. $enregistrement->idP.'"><span class="glyphicon glyphicon-eye-open"></span></a>';
			$corps.=  '<a href="index.php?action=update&idP='. $enregistrement->idP.'"><span class="glyphicon glyphicon-pencil"></span></a>';
			$corps.=  '<a href="index.php?action=delete&idP='. $enregistrement->idP.'"><span class="glyphicon glyphicon-trash"></span></a></span>';
			$corps.="<br>";
  
		}
		$zonePrincipale=$corps ;
		$query = null;
		$connection = null;
		break;



	// voir le détail d’une personne,
    case "select":

		// on vérifie si 'idP' existe dans $_GET, on retourne null sinon
        $idP = key_exists('idP', $_GET) ? trim($_GET['idP']) : null;

        if ($idP) 
		{
			// on se connecte à la base 
            $connection = connecter();

			// requete préparer (nous permet de récuperer les détails d'une personne à l'aide de son ID)
            $requete = "SELECT * FROM personne WHERE idP = :idP";

            $query = $connection->prepare($requete);

            $query->bindParam(':idP', $idP, PDO::PARAM_INT);

			// on exécute notre requete 
            $query->execute();
		
            $personne = $query->fetch(PDO::FETCH_OBJ);

			// on affiche les details de la personne 
            if ($personne) 
			{
                $corps = "<h1>Détails de la personne</h1>";

                $corps .= "<p>ID: {$personne->idP}</p>";
                $corps .= "<p>Nom: {$personne->nom}</p>";
                $corps .= "<p>Prénom: {$personne->prenom}</p>";
                $corps .= "<p>Date de naissance: {$personne->dateN}</p>";
                $corps .= "<p>Téléphone: {$personne->telephone}</p>";
                $corps .= "<p>Adresse: {$personne->adresse}</p>";

                $zonePrincipale = $corps;
            } 
			else // sinon on metionne qu'on trouve pas la personne 
			{
                $zonePrincipale = "<p>Personne introuvable.</p>";
            }

			// on se deconnecte de notre base 
            $query = null;
            $connection = null;

        } 
		else // les cas ou 'idP' n'existe pas 
		{
            $zonePrincipale = "<p>ID de personne manquant.</p>";
        }
        break;

		
	case "insert": //Saisie  via le formulaire	et insertion dans la base de données
		$cible='insert';
		if (!isset($_POST["nom"])	&& !isset($_POST["prenom"]) ) /* et autres champs*/
		{
			include("formulairePersonne.html");
		}
		else{
			$nom = key_exists('nom', $_POST)? trim($_POST['nom']): null;
			$prenom = key_exists('prenom', $_POST)? trim($_POST['prenom']): null;

			// l'ajout des nouveaux champ : dateN, telephone, adresse
			$dateN = key_exists('dateN', $_POST)? trim($_POST['dateN']): null;
			$telephone = key_exists('telephone', $_POST)? trim($_POST['telephone']): null;
			$adresse = key_exists('adresse', $_POST)? trim($_POST['adresse']): null;


			if ($nom == "") $erreur["nom"] = "il manque un nom";
			if ($prenom == "") $erreur["prenom"] = "il manque un prenom";

			// gestion des erreurs du formulaire (pour les nouveaux champs ajouter)
			if ($dateN == "") $erreur["dateN"] = "il manque une date de naissance";
			if ($telephone == "") $erreur["telephone"] = "il manque un numéro de téléphone";
			if ($adresse == "") $erreur["adresse"] = "il manque une adresse";

			
			$compteur_erreur=count($erreur);
			foreach ($erreur as $cle=>$valeur){
				if ($valeur==null) $compteur_erreur=$compteur_erreur-1;
			}

			if ($compteur_erreur == 0) {
				$connection =connecter();
				$corps = "Connection etablie <br>";
				//$corps .= "Il faut maintenant insérer les données du formulaire dans la base <br>";
				//$corps .= "et récupérer l'identifiant". $idP. "<br>";

				// Réponse 

			    // Ajout de la requete préparé
				$requete = "INSERT INTO personne (nom, prenom, dateN, telephone, adresse) VALUES (:nom, :prenom, :dateN, :telephone, :adresse)";

				$donne = $connection->prepare($requete);

				$donne->bindParam(':nom', $nom);
				$donne->bindParam(':prenom', $prenom);
				$donne->bindParam(':dateN', $dateN);
				$donne->bindParam(':telephone', $telephone);
				$donne->bindParam(':adresse', $adresse);


				// Exécuter la requete préparé
				$donne->execute();
			
				// ID du dernier élément inséré
				$idP = $connection->lastInsertId();	
				
				$patient = new personne($idP, $nom, $prenom, $dateN, $telephone, $adresse);


				// Afficher 'idP' du dernier élément ajouter 
				$corps .= "ID du dernier élément inséré : ". $idP. "<br>";

				
				$corps .= "Saisie de : ". $patient;

				
				$zonePrincipale=$corps ;
				$connection = null;
			}
			else {
				include("formulairePersonne.html");
			}
		}
		break;

	
 default:
   $zonePrincipale="" ;
   break;
   
}
include("squelette.php");

?>
