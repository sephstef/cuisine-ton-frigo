<div class="modal fade" id="signin" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Inscription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" id="signinForm">
          <div class="mb-3">
            <label class="form-label" for="login">Nom d'utilisateur</label>
            <input type="text" class="form-control" name="login" id="login" placeholder="Asterix" />
            <small class="invalid-feedback" id="smallLogin"></small>
          </div>
          <div class="mb-3">
            <label class="form-label" for="mail">Mail</label>
            <input type="email" class="form-control" name="mail" id="mail" placeholder="Asterix@legaulois.fr" />
            <small class="invalid-feedback" id="smallMail"></small>
          </div>
          <div class="mb-3">
            <label class="form-label" for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="**********" />
            <small class="invalid-feedback" id="smallPassword"></small>
          </div>
          <div class="mb-3">
            <label class="form-label" for="confirmPassword"> Confirmation de mot de passe</label>
            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="**********" />
            <small class="invalid-feedback" id="smallConfirmPassword"></small>
          </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abandonner</button>
        <input type="submit" class="btn btn-info" id="addUser" value="inscription" />
        </form>
      </div>
    </div>
  </div>
</div>