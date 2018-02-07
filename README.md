# Interface d'affichage de données open data temps réel RATP
Ce dépôt a pour objet de fournir un afficheur temps réel des horaires de passage à un arrêt de bus, métro ou RER.
Il consulte directement l'API Open Data Temps Réel RATP (https://data.ratp.fr/page/temps-reel/), et met à jour les informations toutes les minutes.

Sous format web, il est accessible depuis n'importe quel écran, permettant ainsi de donner des informations pertinentes et constamment mise à jour. Voici un exemple du rendu actuel (version 1.3) :

![alt text](https://zaratustra.fr/github/afficheur-open-data-ratp/capt/capture.png)


Afin de pouvoir déployer la solution, veuillez suivre les étapes suivantes :

## 1 - Inscription à l'API Open Data Temps Réel RATP
- Suivre les instructions fournies à l'adresse suivante : https://data.ratp.fr/page/temps-reel/. Il est important de bien renseigner l'adresse IP du serveur qui exécutera les requêtes Open Data.

## 2 - Placement des fichiers et droits d'accès
- Placer les fichiers de sorte que **biv.php** soit à la racine du dossier que vous dédiez à la solution.
- Donner les droits d'écriture à votre serveur web (**apache** par exemple) au fichier **/conf/lines.conf**.
- Editer le contenue des deux variables $topbar_text et $stopinfo_text en haut du fichier **biv.php** :
```
$topbar_text = '$topbar_text - éditez moi dans <b>biv.php</b>';
$stopinfo_text = '$stopinfo_text - éditez moi dans <b>biv.php</b>';
```

## 3 - Ajout des lignes à afficher
- Avec votre navigateur, accéder au fichier **biv.php**, puis cliquer sur l'icone Paramètres en haut à droite de la fenêtre. Vous pourrez ainsi rajouter des lignes à votre afficheur.

## Bibliothèques externes utilisées
-- todo.
