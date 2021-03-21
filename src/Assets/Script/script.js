/* Personnalisation du message d'erreur pour le prénom */
{
    var prenom = document.getElementById("prenom");
    prenom.oninvalid = function (e) {
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
            e.target.setCustomValidity("On veut connaître comment tu t'appelles");
        }
    };
    prenom.oninput = function (e) {
        e.target.setCustomValidity("");
    };
}
/* Personnalisation du message d'erreur pour le nom */
{
    var nom = document.getElementById("nom");
    nom.oninvalid = function (e) {
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
            e.target.setCustomValidity("On veut connaître ton nom !");
        }
    };
    nom.oninput = function (e) {
        e.target.setCustomValidity("");
    };
}
/* Personnalisation du message d'erreur pour l'e-mail */
{
    var email = document.getElementById("email");
    email.oninvalid = function (e) {
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
            e.target.setCustomValidity("Il nous faut une adresse mail valide");
        }
    };
    email.oninput = function (e) {
        e.target.setCustomValidity("");
    };
}
/* Personnalisation du message d'erreur pour la date et mise à jour du max à la date d'aujourd'hui */
{
    var date = document.getElementById("date");
    date.oninvalid = function (e) {
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
            e.target.setCustomValidity("Il nous faut ta date d'anniversaire (tu peux te rajeunir de quelques années si tu veux ;) )");
        }
    };
    date.oninput = function (e) {
        e.target.setCustomValidity("");
    };

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    date.setAttribute("max", today);
}