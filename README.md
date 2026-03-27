# evaluation_php_poo
Projet de cours Evaluation PHP POO
Instructions pour récupérer et créer votre projet

### Forker le repository suivant

https://github.com/evaluationWeb/evaluation_php_poo.git 

### 1 Cloner votre repository (Fork)
```sh
git clone https://github.com/votre_compte_github/evaluation_php_poo.git
# remplacer l'url par votre repository (Fork)
```

### 2 Se déplacer dans le projet
```sh
cd evaluation_php_poo
```

### 3 Installer les dépendances
```sh
composer install
```

### 4 Créer un fichier .env avec les informations de la BDD
```env
DATABASE_USERNAME=root
DATABASE_PASSWORD=
DATABASE_NAME=todolist
DATABASE_HOST=localhost:3306
```

### 5 démarrer le serveur PHP
```sh
php -S 127.0.0.1:8000
```