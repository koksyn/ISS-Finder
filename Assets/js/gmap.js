function Gmap(latitude, longitude) {
    this.coords = {lat: latitude, lng: longitude};
}

Gmap.prototype.initMap = function () {
    this.map = new google.maps.Map(document.getElementById('map'), {
        center: this.coords,
        scrollwheel: false,
        zoom: 4
    });

    this.marker = new google.maps.Marker({
        map: this.map,
        position: this.coords,
        title: 'ISS is actually here'
    });
};