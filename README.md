# Test technique — Dixeed

## Résumé

- Sont dans le repo :
  - Un thème, dans le dossier themes
  - Deux plugins, dans le dossier plugins
  - La base de données, dans le dossier sql
- Instance locale sur "https://dixeed-wp.test"
- Plugins installés :
  - Woocommerce
- Identifiants de l'administrateur du site :
  - username : come_fouch
  - password : 6qcdp$5D7vyJEK7T!U
- URL de la nouvelle page avec le formulaire: /informations-sur-les-ananas

## Niveau par niveau

### Niveau obligatoire

- Instance locale sur "https://dixeed-wp.test"
- Thème installé :
  - Storefront
  - Storefront Dixeed Custom (thème custom, hérité de Storefront, présent dans le repo, voir détails plus bas)
- Plugins installés :

  - Akismet Anti-Spam (installé par défaut sur WordPress, non activé)
  - WooCommerce
    - Google Listings and Ads (installé par Woocommerce)
    - Jetpack (installé par Woocommerce)
    - MailPoet 3 (installé par Woocommerce)
    - Paiements WooCommerce (installé par Woocommerce)
    - WooCommerce Shipping & Tax (installé par Woocommerce)
  - Dixeed Dashboard Message (plugin custom, présent dans le repo, voir détails plus bas)
  - Dixeed Add Ananas User Info Page (plugin custom, présent dans le repo, voir détails plus bas)

- Changement de la couleur des boutons.
  - Réalisé dans le thème Storefront Dixeed Custom
  - J'ai pris la liberté de changer aussi la couleur d'accentuation, le violet par défaut jurait avec le orange (je crois ; les couleurs, ce n'est pas vraiment mon talent par excellence !)

### Niveau intermédiaire

- Ajout d'un champ sur la page "Mon Compte"
  - Fait dans le thème Storefront Dixeed Custom
  - Pour pouvoir tester l'ajout en BDD, j'ai dû ajouter un moyen de paiement (Paiement à la livraison), ce qui n'était pas demandé. J'ai pris la liberté de laisser cela ainsi, pour faciliter vos tests.
- Plugin permettant l’affichage d’un message sur le dashboard client (page mon compte)
  - Plugin Dixeed Dashboard Message
    - Le paramétrage se fait dans le Back Office, dans le menu "Dashboard Message"
    - Remarques :
      - le message ne ressort pas suffisamment dans l'UI pour le client (à mon goût)
      - il pourrait être pertinent de mettre une icône explicite sur le menu dans l'espace d'administration

### Niveau expert

- Créer une page avec un formulaire permettant d’ajouter des informations à l'utilisateur courant
  - Fait dans le plugin Dixeed Add Ananas User Info Page
  - URL : /informations-sur-les-ananas
  - Remarques :
    - il serait sans doute pertinent de laisser les administrateurs modifier les textes depuis le Back Office, ce que je n'ai pas fait à ce jour
- Ajouter sous le texte de description des produits (page produit) un bouton affichant, au clic, votre adresse IP en effectuant un call Ajax
  - Fait dans le thème Storefront Dixeed Custom

## Remarques

- Je n'ai pas du tout fait attention à la possibilité de traduction du site, jugeant que l'exercice ne le demandait pas, notamment à cause de l'instruction "Limiter la vente de produit en France seulement"
- J'ai choisi de laisser toutes les fonctions du thème Storefront Dixeed Custom dans le même fichier functions.php, car il reste assez court. Une séparation en plusieurs fichiers serait peut-être souhaitable.
- J'ai omis quelques précautions de sécurité (nonce dans les formulaires notamment, mais je corrigerai sans doute ça avant de vous transmettre le repo)
