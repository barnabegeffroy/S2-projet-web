var searchInput = 'search_input';
var autocomplete;

$(document).ready(function () {
  autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
    types: ['geocode'],
  });
});


// window.addEventListener('load',function(){
//     if(document.getElementById('map')){
//       google.load("maps", "3",{
//         callback:function(){
//            new google.maps.Map(document.getElementById('map'), {
//               center: new google.maps.LatLng(0,0),
//               zoom: 3
//             });
//         }
//       });     
//     }
//   },false);


// Initialize and add the map
function initMap() {
  // var place = autocomplete.getPlace();

  // var lat = place.geometry.location.lat(),
  // var lng = place.geometry.location.lng();


  var coord = autocomplete.getPlace().geometry.location;
  console.log(coord);
  // const myPosition = { lat: lat, lng: lng };


  // The map, centered at the announce
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: coord,
  });
  // The marker, positioned at myPosition
  var marker = new google.maps.Marker({
    position: coord,
    map: map,
    dragable: true,
    visible: true
  });
}