// fonction en ajax qui sert à envoyer les informations de mes inputs vers le controller de l'inscription
// event.preventDefault sert à empêcher l'envoi du formulaire quand on clique sur le submit
// j'enlève les erreurs si l'utilisateur c'est déjà trompé lors d'un essai
function addUser(event) {
    event.preventDefault();
    document.querySelector('#signin #login').classList.remove('is-invalid');
    document.querySelector('#signin #smallLogin').innerHTML = '';
    document.querySelector('#signin #mail').classList.remove('is-invalid');
    document.querySelector('#signin #smallMail').innerHTML = '';
    document.querySelector('#signin #password').classList.remove('is-invalid');
    document.querySelector('#signin #smallPassword').innerHTML = '';
    document.querySelector('#signin #confirmPassword').classList.remove('is-invalid');
    document.querySelector('#signin #smallConfirmPassword').innerHTML = '';

    // ajax est le paramètre d'url que j'envoie vers le controller 
    // je stocke dans un objet FormData mon formulaire, il est envoyé dans le xmlhttp.send()
    // je lance un objet XMLHttpRequest ça fait mon lien vers ma bdd
    // et me permet de modifier ma page sans avoir besoin de la rafraîchir 
    let ajax = true;
    let signinForm = document.getElementById('signinForm');
    let signinData = new FormData(signinForm)
    let xmlhttp = new XMLHttpRequest();

    // onreadystatechange est un évènement qui réagit à chaque fois que readyState est modifié
    // readyState 4 veut dire que mon opération est terminé
    // status 200 indique la réussite de la requête
    // pour communiquer entre le js et le php on utilise le json
    // JSON.parse convertit le json en objet que le js peut manipuler
    // responseText est la réponse que renvoit le php
    // si data est un objet j'utilise les données contenues pour afficher les erreurs dans les balises small et ajouter une classe aux inputs concernés
    // si c'est le message de réussite qui revient le formulaire disparaît pour laisser place au message et afficher le message
    xmlhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            if (typeof data == 'object') {

                if (data['login']) {
                    document.querySelector('#signin #login').classList.add('is-invalid');
                    document.querySelector('#signin #smallLogin').innerHTML = data['login'];
                }

                if (data['mail']) {
                    document.querySelector('#signin #mail').classList.add('is-invalid');
                    document.querySelector('#signin #smallMail').innerHTML = data['mail'];
                }

                if (data['password']) {
                    document.querySelector('#signin #password').classList.add('is-invalid');
                    document.querySelector('#signin #smallPassword').innerHTML = data['password'];
                }

                if (data['confirmPassword']) {
                    document.querySelector('#signin #confirmPassword').classList.add('is-invalid');
                    document.querySelector('#signin #smallConfirmPassword').innerHTML = data['confirmPassword'];
                }

                if (data['db']) {
                    document.querySelector('#signin .modal-body').innerHTML +=
                        `<div class="alert alert-danger" role="alert">${data['db']}</div>`;
                }

            } else {
                document.querySelector('#signin .modal-body').innerHTML =
                    `<div class="alert alert-success" role="alert">${data}</div>`;
                document.querySelector('#signin .modal-footer').innerHTML =
                    `<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                <small><i class="fas fa-sign-in-alt"></i>connexion</small>
            </button>`;

            }
        }
    }
    // open sert à définir la méthode d'envoi ici en post et aussi l'url avec mon paramètre d'url
    // send envoi la requête avec mon objet formdata
    xmlhttp.open('POST', 'controllers/signinController.php?ajax=' + ajax);
    xmlhttp.send(signinData);

}

// quand je clique sur le submit de l'inscription la fonction addUser se lance
document.getElementById('addUser').addEventListener('click', addUser);


// fonction en ajax qui sert à envoyer les informations de mes inputs vers le controller de la connexion
// event.preventDefault sert à empêcher l'envoi du formulaire quand on clique sur le submit
// j'enlève les erreurs si l'utilisateur c'est déjà trompé lors d'un essai
function connectUser(event) {
    event.preventDefault();
    document.querySelector('#loginModal #login').classList.remove('is-invalid');
    document.querySelector('#loginModal #smallModalLogin').innerHTML = '';
    document.querySelector('#loginModal #password').classList.remove('is-invalid');
    document.querySelector('#loginModal #smallPasswordLogin').innerHTML = '';

    // ajax est le paramètre d'url que j'envoie vers le controller 
    // je stocke dans un objet FormData mon formulaire, il est envoyé dans le xmlhttp.send()
    // je lance un objet XMLHttpRequest ça fait mon lien vers ma bdd
    // et me permet de modifier ma page sans avoir besoin de la rafraîchir
    let ajax = true;
    let loginForm = document.getElementById('loginForm');
    let loginData = new FormData(loginForm)
    let xmlhttp = new XMLHttpRequest();

    // onreadystatechange est un évènement qui réagit à chaque fois que readyState est modifié
    // readyState 4 veut dire que mon opération est terminé
    // status 200 indique la réussite de la requête
    // pour communiquer entre le js et le php on utilise le json
    // JSON.parse convertit le json en objet que le js peut manipuler
    // responseText est la réponse que renvoit le php
    // si data est un objet j'utilise les données contenues pour afficher les erreurs dans les balises small et ajouter une classe aux inputs concernés
    // si c'est le message de réussite qui revient le formulaire disparaît pour laisser place au message et afficher le message
    // quelque soit l'endroit ou clique l'utilisateur la page va se recharger pour actualiser le contenu
    xmlhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            if (typeof data == 'object') {

                if (data['login']) {
                    document.querySelector('#loginModal #login').classList.add('is-invalid');
                    document.querySelector('#loginModal #smallModalLogin').innerHTML = data['login'];
                }

                if (data['password']) {
                    document.querySelector('#loginModal #password').classList.add('is-invalid');
                    document.querySelector('#loginModal #smallPasswordLogin').innerHTML = data['password'];
                }

                if (data['db']) {
                    document.querySelector('#loginModal .modal-body').innerHTML +=
                        `<div class="alert alert-danger" role="alert">${data['db']}</div>`;
                }
            } else {
                document.querySelector('#loginModal .modal-body').innerHTML =
                    `<div class="alert alert-success" role="alert">${data}</div>`;
                document.querySelector('#loginModal .modal-footer').innerHTML =
                    `<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>`;
                document.addEventListener('click', () => document.location.reload());
            }
        }
    }
    // open sert à définir la méthode d'envoi ici en post et aussi l'url avec mon paramètre d'url
    // send envoi la requête avec mon objet formdata
    xmlhttp.open('POST', 'controllers/loginController.php?ajax=' + ajax);
    xmlhttp.send(loginData);
}

// quand je clique sur le submit de la connexion la fonction connectUser se lance
document.getElementById('connectUser').addEventListener('click', connectUser);
