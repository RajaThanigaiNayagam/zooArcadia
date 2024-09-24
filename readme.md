
     Pour exécuter ce projet, vous devez avoir installé un serveur virtuel, c'est-à-dire XAMPP, sur votre PC (pour Windows). 


En machine localhost 
-----------------------
   J'utilise mon propre ordinateur qui fonctionne sous Windows 11. J'ai également installé le logiciel suivant pour exécuter mon projet.
   1. dernière version du "composer"
   2. dernière version du "node.js"
   Il faut télécharger et installée XAMPP serveur depuis le site internet https://www.apachefriends.org/fr/index.html. Lancer le XAMPP depuis son emplacement et démarre le serveur "Apache" et "MySQL" en cliquant sur le premier bouton "Start" ensuite le deuxième bouton "Start". Une fois, les serveurs sont démarrés, vous pouvez ouvrir le "PHPmyadmin" en cliquant sur le deuxième "Admin" bouton sur le même niveau de MySQL. Ils ouvrent la page, "PHPmyadmin" dans un navigateur, où vous pouvez gérer les basse de donnés, les tables et les données.


Installer et exécuter le projet sur la machine locale. Pour ce faire, 
---------------------------------------------------------------------
   Installez symfony cli en le téléchargeant depuis le site symfony. Installez Symfony 7 en donnant le nom du répertoire ainsi que le nom du projet.
Allez maintenant dans le répertoire du projet qui a été créé automatiquement par l'installation de symfony.
Ici, dans ce répertoire de projet, 
     - Vous devez démarrer le client bash
vous pouvez commencer à exécuter le serveur Symfony en tapant "symfony serve"  
Votre serveur symfony est lancé maintenant.
Dans le fichier .env, vous devez remplir les données d'accès à la base de données correctes avec le nom de la base de données dans le chemin DATABASE_URL. Comme ci-dessous :-
   DATABASE_URL="mysql://root:@root:3306/zooArcadia?serverVersion=mariadb-10.4.32&charset=utf8mb4"

Supprimez la base de données qui existe auparavant et lancez la commande bash comme ci-dessous
   -  php bin/console doctrine:database:drop --force
Pour créer notre nouvelle base de données
   -  php bin/console doctrine:database:create

     Le projet est maintenant prêt et il peut être téléchargé depuis le site Web Github en suivant le chemin suivant:-
https://github.com/RajaThanigaiNayagam/zooArcadia.git
 
 Une fois téléchargé, pour inclure toutes les entités de ce projet dans la base de données nouvellement créée, 
 exécutez la commande bash comme suit :-
   -  php bin/console doctrine:migrations:migrate

Le projet est maintenant prêt à démarrer. L'identité et le mot de passe de l'administrateur, de l'employé et du vétérinaire sont indiqués ci-dessous   
Admin
------
id: admin@zoo.fr
pwd: 123456

employee
--------
id: empo@zoo.com
pwd: 123456    

vétérinaire
--------
id: vete@zoo.com
pwd: 123456  

Le lien vers ce logiciel de gestion de projet
TRELLO
------ 
  -  https://trello.com/b/4r3uREve      
         

 En HEROKU server de production 
-------------------------------  
Créez un compte sur le site web HEROKU: https://signup.heroku.com/signup/dc. Dans l'onglet "Deploy", choisissez votre méthode de déploiement (GitHub, Git, Dropbox, etc.) et suivez les instructions pour lier votre compte HEROKU à votre dépôt. Configurez les variables d'environnement HEROKU et les buildpacks necessaire(PHP et NODJS) pour que mon application les utilise pendant son exécution.  Ajoutez des addons pour votre application, tels que JawsDB.  Utiliser la commande "git push heroku master" pour déployer l’application sur Heroku.

J'ai déployé mon projet dans Heroku dans le lien suivant :-
https://git.heroku.com/zooarcadia-bretagne.git

et l'adresse du site Web du Zoo ARCADIA est :-
https://zooarcadia-bretagne-4287ac627e07.herokuapp.com/home

         
Résumé du projet
Gestion de zoo ARCADIA
----------------------
Arcadia est un zoo qui veut créer un site web pour que les publics puissent le consulter enligne. Le directeur de zoo M. José veut présenter du zoo et les fonctionnalités pratiques pour les visiteurs, dans son site web de zoo. Le projet a donc pour but la création et la construction d’une interface cohérente et ergonomique afin d’aider leurs équipes à ouvrir des accès aux modules de leur API. il a envie d’une application web qui permettrait aux visiteurs de visualiser les animaux, leurs états et visualiser les services ainsi que les horaires du zoo pour augmenter ainsi la notoriété et l’image de marque du zoo.
Le zoo est entièrement indépendant au niveau des énergies qui ressentent les valeurs de l’écologie. Pour montrer que ce site est aussi écologiste, nous avons utilisé le design et les couleurs pour le mettre en valeur. Les détails de ce projet sont expliqués dans le "dossier du projet" qui sera deposé.