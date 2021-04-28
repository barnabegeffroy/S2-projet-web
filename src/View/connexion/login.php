<form action="authenticate.php" method="post">
  <div>
    <label for="email">Email :</label>
    <input type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required />

  </div>
  <div>
    <label>Mot de passe :</label>
    <input type="password" name="password" required />
  </div>
  <?php if (isset($data['failedAuthent'])) : ?>
    <span class="error-message"><?= $data['failedAuthent'] ?></span>
  <?php endif; ?>
  <button type="submit">Valider</button>
</form>


<input type="search" id="address" class="form-control" placeholder="Where are we going?" />

<p>Selected: <strong id="address-value">none</strong></p>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script>
(function() {
  var placesAutocomplete = places({
    appId: '<YOUR_PLACES_APP_ID>',
    apiKey: '<YOUR_PLACES_API_KEY>',
    container: document.querySelector('#address')
  });

  var $address = document.querySelector('#address-value')
  placesAutocomplete.on('change', function(e) {
    $address.textContent = e.suggestion.value
  });

  placesAutocomplete.on('clear', function() {
    $address.textContent = 'none';
  });

})();
</script>
