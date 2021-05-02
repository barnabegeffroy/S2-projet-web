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

  const center = { lat: 48.62682123216434, lng: 2.432315013435739 };


  // The map, centered at the announce
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: center,
  });
  
  const myPosition = { lat: 48.62682123216434 , lng: 2.432315013435739 }
  // The marker, positioned at myPosition
  const marker = new google.maps.Marker({
    position: myPosition,
    map: map,
  });
}