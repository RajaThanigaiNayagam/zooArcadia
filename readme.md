
     Pour exécuter ce projet, vous devez avoir installé un serveur virtuel, c'est-à-dire XAMPP, sur votre PC (pour Windows). 


En machine localhost 
-----------------------
   J'utilise mon propre ordinateur qui fonctionne sous Windows 11. J'ai également installé le logiciel suivant pour exécuter mon projet.
   1. dernière version du "composer"
   2. dernière version du "node.js"
   Il faut télécharger et installée XAMPP serveur depuis le site internet https://www.apachefriends.org/fr/index.html. Lancer le XAMPP depuis son emplacement et démarre le serveur "Apache" et "MySQL" en cliquant sur le premier bouton "Start" ensuite le deuxième bouton "Start". Une fois, les serveurs sont démarrés, vous pouvez ouvrir le "PHPmyadmin" en cliquant sur le deuxième "Admin" bouton sur le même niveau de MySQL. Ils ouvrent la page, "PHPmyadmin" dans un navigateur, où vous pouvez gérer les basse de donnés, les tables et les données.


Création de compte Admin faite a la main. Pour ce faire, 
--------------------------------------------------------
   Ouvrez le page PHPmyadmin comme expliquée juste avant, et crée une base de données nommées "quaiantique" a la main. À l'intérieur de cette base de données "quaiantique" sur l'écran d'à droite, vous cliqué sur le bouton "Importer" juste en haut de l'écran. Sélectionné le fichier nommé "quaiantique.sql" qui se trouve dans le répertoire "Dossier support/quaiantique" et lancer l'importation en cliquant sur le bouton "Importer" tout en bas de cette page.  


Après avoir démarré Apache et MySQL dans XAMPP, suivez les étapes suivantes.

1ere étape : Ce projet est téléchargeable depuis le github.com 
		 https://github.com/RajaThanigaiNayagam/quaiantique.git
2ème étape : Créé un sous-répertoire nommé "quaiantique" a l'intérieure de la répertorier "xampp/htdocs/".   
3ème étape : Coller tous les fichiers de projet dans la répertoire "xampp/htdocs/quaiantique"


Après avoir créé la base de données, ouvrez un navigateur et accédez à l'URL "http://localhost/quaiantique".  La, vous verrez la page d'accueil de Restaurant Quantique

Admin
------
id: admin
pwd: Test@123



Utilisateur
-----------
id: test@test.com
pwd: Test@123      


TRELLO 
Un lien ver Trello : https://trello.com/b/4r3uREve      
         
 En HEROKU server de production 
-------------------------------  
Créez un compte sur le site web HEROKU: https://signup.heroku.com/signup/dc. Dans l'onglet "Deploy", choisissez votre méthode de déploiement (GitHub, Git, Dropbox, etc.) et suivez les instructions pour lier votre compte HEROKU à votre dépôt. Configurez les variables d'environnement HEROKU et les buildpacks necessaire(PHP et NODJS) pour que mon application les utilise pendant son exécution.  Ajoutez des addons pour votre application, tels que JawsDB.  Utiliser la commande "git push heroku master" pour déployer l’application sur Heroku.

J'ai déployé mon projet dans Heroku dans le lien suivant :-
https://git.heroku.com/zooarcadia-bretagne.git

et l'adresse du site Web du Zoo ARCADIA est :-
https://zooarcadia-bretagne-4287ac627e07.herokuapp.com/

         
Résumé du projet
Gestion de zoo ARCADIA
----------------------
Arcadia est un zoo qui veut créer un site web pour que les publics puissent le consulter enligne. Le directeur de zoo M. José veut présenter du zoo et les fonctionnalités pratiques pour les visiteurs, dans son site web de zoo. Le projet a donc pour but la création et la construction d’une interface cohérente et ergonomique afin d’aider leurs équipes à ouvrir des accès aux modules de leur API. il a envie d’une application web qui permettrait aux visiteurs de visualiser les animaux, leurs états et visualiser les services ainsi que les horaires du zoo pour augmenter ainsi la notoriété et l’image de marque du zoo.
Le zoo est entièrement indépendant au niveau des énergies qui ressentent les valeurs de l’écologie. Pour montrer que ce site est aussi écologiste, nous avons utilisé le design et les couleurs pour le mettre en valeur. Les détails de ce projet sont expliqués dans le "dossier du projet" qui sera deposé.