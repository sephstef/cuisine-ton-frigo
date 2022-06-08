let deleteUser = document.querySelector('#deleteUser'); // id de la modale qui sert à supprimer l'utilisateur
// show-bs-modal est un évènement js de bootstrap 
deleteUser.addEventListener('show.bs.modal', function (event) {
  // lien de l'évènement à la modale
  let trigger = event.relatedTarget;
  // on récupère l'attribut
  let userLogin = trigger.getAttribute('data-bs-login');

  let targetHidden = deleteUser.querySelector('#targetHidden');
  let targetName = deleteUser.querySelector('#targetName');
  // le login est attribué à l'input hidden et à une balise p dans la modale  
  targetHidden.value = userLogin;
  targetName.textContent = userLogin;
});