src="https://cdn.jsdelivr.net/npm/places.js@1.19.0">

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