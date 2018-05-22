<script>
    import axios from 'axios'
    import GoogleMap from './GoogleMap.vue'

    export default {
        props: {
            baseurl: String
        },
        components: {
            GoogleMap,
        },

        data() {
            return {
                roundCount: 0,
                oneround: null,
                rounds: null,
                title: null,
                seen: false,
                roundNr: 0,
                datapointCoordinates: [],
            }
        },

        created() {
            this.loadRounds()
        },

        methods: {
            clickFunction(roundId, event) {
                this.loadDatapoints(roundId);
                this.seen = true;
                this.oneround = this.rounds[roundId - 1];
                this.resetMarked();
                event.target.classList.add('is-marked');
            },
            resetMarked() {
                let marked = document.querySelector('.is-marked');
                if (marked !== null) {
                    marked.classList.remove('is-marked');
                }
            },
            postFunction() {
                axios.post('/rounds/create', {
                    title: this.title
                }).then(response => {

                })
            },
            loadRounds() {
                console.log('working');
                axios.get('/rounds').then(response => {
                    this.rounds = response.data;
                }).catch(error => {
                    console.log(response);
                })
            },
            loadDatapoints(roundId) {
                axios.get('/datapoints/' + roundId).then(response => {
                    this.datapointCoordinates = [];
                    let datapoints = response.data;
                    datapoints.forEach((datapoint) => {
                        let coordinateObject = {
                            latitude: datapoint.point_pos_lat,
                            longitude: datapoint.point_pos_long
                        };
                        this.datapointCoordinates.push(coordinateObject)
                        console.log(this.datapointCoordinates)
                    });
                }).catch(error => {
                    console.log(error);
                })
            },
        }
    }
</script>
