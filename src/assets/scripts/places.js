var places = require('places.js');
var placesAutocomplete = places({
  appId: 'YOUR_PLACES_APP_ID',
  apiKey: 'YOUR_PLACES_API_KEY',
  container: document.querySelector('#address-input')
});