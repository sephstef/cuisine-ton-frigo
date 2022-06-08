<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Connexion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" id="loginForm">
          <div class="mb-3">
            <label class="form-label" for="login">Nom d'utilisateur</label>
            <input type="text" class="form-control" name="login" id="login" placeholder="Asterix" />
            <small class="invalid-feedback" id="smallModalLogin"></small>
          </div>
          <div class="mb-3">
            <label class="form-label" for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="**********" />
            <small class="invalid-feedback" id="smallPasswordLogin"></small>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abandonner</button>
        <input type="submit" class="btn btn-info" id="connectUser" value="Connexion" />
        </form>
      </div>
    </div>
  </div>
</div>