# chat_line
#On clone le depot 
git clone 
#Puis on se deplace dans le dossier 🗃 chat-line
#On installe les dependances
composer install
#On cree la base de donnees
symfony console doctrine:databse:create
#On execute les migrations
symfony console doctrine:migrations:migrate
#On lance le serveur
symfony serve -d
#On lance l'application
symfony open:local
#Puis on cree deux utilisateurs pour simuler le chat_line
