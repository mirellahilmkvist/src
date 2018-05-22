<script>
    import Rounds from './Rounds.vue'

    export default {
        props: {
            name: String,
            coordinates: Array
        },

        data: function () {
            return {
                mapName: this.name + "-map",
                map: null,
                bounds: null,
                markers: []
            }
        },
        mounted: function () {
            this.bounds = new google.maps.LatLngBounds();
            const element = document.getElementById(this.mapName)
            this.map = new google.maps.Map(element);
        },
        watch: {
            coordinates() {
                this.markers.forEach((marker) => {
                    marker.setMap(null);
                });
                this.reloadMarkers();
            }
        },
        methods: {
            reloadMarkers() {
                this.coordinates.forEach((coord) => {
                    const position = new google.maps.LatLng(coord.latitude, coord.longitude);
                    const marker = new google.maps.Marker({
                        position,
                        map: this.map
                    });
                    this.markers.push(marker)
                    this.map.fitBounds(this.bounds.extend(position))
                });
            }
        }
    };
</script>
<style scoped>
    .google-map {
        width: 800px;
        height: 600px;
        margin: 0 auto;
        background: gray;
    }
</style>