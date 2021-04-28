
(function() {
  var placesAutocomplete = places({
    appId: '0F5JUQOPZH',
    apiKey: '1f35ed062d8b8f557817ebab7d48ba45',
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