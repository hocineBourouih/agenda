# Agenda (Application de gestion de contacts en PHP, SQL, HTML et CSS)

- Projet d'agenda en PHP avec gestion de base de données pour stocker et organiser les contacts et les événements.

- une application de gestion de contacts développée en PHP, avec une base de données SQL et une interface utilisateur en HTML et CSS. 

- Je détaillerai les points techniques suivants:
  - la protection contre les injections SQL
  - les fonctionnalités principales
  - la gestion des erreurs du formulaire
  - les modifications apportées au fichier lib.php pour des raisons de sécurité


* Protection contre les injections SQL grâce aux requêtes préparées:
Afin de protéger notre base de données contre les injections SQL, nous utilisons des requêtes préparées.
Les requêtes préparées permettent de séparer les instructions SQL des données utilisateur, 
empêchant ainsi toute tentative d'injection malveillante. 
Les requêtes sont préparées à l'aide de la méthode prepare() de l'objet PDO et les données sont liées aux paramètres via la méthode bindParam().
