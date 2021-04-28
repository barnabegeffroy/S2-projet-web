
(function() {
  var placesAutocomplete = places({
    appId: '0F5JUQOPZH',
    apiKey: 'aa22f43a3845cf5d968df909b13ffd82',
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