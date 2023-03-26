# Agenda (Application de gestion de contacts en PHP, SQL, HTML et CSS)

- Projet d'agenda en PHP avec gestion de base de données pour stocker et organiser les contacts et les événements.

- une application de gestion de contacts développée en PHP, avec une base de données SQL et une interface utilisateur en HTML et CSS. 

- Je détaillerai les points techniques suivants:
  - la protection contre les injections SQL
  - les fonctionnalités principales
  - la gestion des erreurs du formulaire
  - les modifications apportées au fichier lib.php pour des raisons de sécurité


### Protection contre les injections SQL grâce aux requêtes préparées:
Afin de protéger notre base de données contre les injections SQL, nous utilisons des requêtes préparées.
Les requêtes préparées permettent de séparer les instructions SQL des données utilisateur, 
empêchant ainsi toute tentative d'injection malveillante. 
Les requêtes sont préparées à l'aide de la méthode prepare() de l'objet PDO et les données sont liées aux paramètres via la méthode bindParam().

### Fonctionnalités de l'application:
- L'application offre les fonctionnalités suivantes:
  - a. Liste des personnes: Affiche la liste de tous les contacts présents dans la base de données.
  - b. Voir le détail d'une personne: Permet de consulter les informations détaillées d'un contact sélectionné.
  - c. Insérer une personne: Ajoute un nouveau contact à la base de données via un formulaire.
  - d. Modifier une personne: Modifie les informations d'un contact existant à l'aide d'un formulaire pré-rempli.
  - e. Supprimer une personne: Supprime un contact de la base de données.


### Mise à jour de la base de données:
- Toute action telle que l'ajout, la modification ou la suppression d'un contact met à jour la base de données en conséquence.

### Informations de contact et gestion des erreurs du formulaire:
- Le formulaire de l'application permet de saisir les informations suivantes: 
  - nom, prénom, date de naissance, téléphone et adresse. Des contrôles de validation sont mis en place pour vérifier
la saisie des données utilisateur et afficher des messages d'erreur appropriés en cas d'erreurs.


### Modifications apportées au fichier lib.php pour des raisons de sécurité:
- Le fichier lib.php a été modifié pour des raisons sécurité, car il contient les informations de connexion à ma base de données, telles que le nom d'hôte,
mon identifiant et mon mot de passe.
- Pour le lier à votre propre base de données, vous pouvez compléter les informations manquantes. Une fonction connecter() a été codée pour gérer la connexion à la base de données et lever une exception en cas d'échec de connexion. La partie catch{} sera exécutée pour gérer l'erreur de connexion.

