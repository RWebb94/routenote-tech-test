<template>
    <b-container v-if="artistdetails !== null">
        <b-row>
            <b-col class="information-box">
                <div class="box-heading"><h3>Followers:</h3></div>
                <div>
                    <span>{{ artistdetails.followers.total | thousandsfloat }}</span>
                </div>
            </b-col>

            <b-col class="information-box">
                <div class="box-heading"><h3>Genres:</h3></div>

                <ul class="music-points">
                    <li v-for="(genre, index) in artistdetails.genres"
                        v-bind:key="index">
                        {{ genre | capitalisefirstletter }}
                    </li>
                </ul>
            </b-col>

            <b-col class="information-box align-content-center">
                <button class="group btn relative transition btn-primary mb-3" v-on:click="showTopTracks">View Top Tracks</button>
                <a :href="artistdetails.external_urls.spotify" target="_blank" class="group btn relative transition btn-secondary">View on Spotify</a>
            </b-col>
        </b-row>

        <b-row>
            <toptracks :tracks="toptracks" />
        </b-row>
    </b-container>
</template>

<script>
    import toptracks from './TopTracks.vue'
    import axios from 'axios'

    export default {
        data() {
            return {
                toptracks: null
            }
        },
        components: {
            toptracks
        },
        props: {
            artistdetails: {
                type: Object
            }
        },
        methods: {
            showTopTracks() {
                console.log("Getting Top Tracks");
                var self = this;
                
                axios.get('/api/spotifydetails/getArtistsTopTracks/' + self.artistdetails.id)
                    .then(res => {
                        self.toptracks = res.data;
                    })
                    .catch(function (res) {
                        console.log("Could not load top tracks. Response:");
                        console.log(res);
                    });
            }
        },
        filters: {
            thousandsfloat(value) {
                return value.toLocaleString();
            },
            capitalisefirstletter(value) {
                return value.charAt(0).toUpperCase() + value.slice(1) || ""
            }
        }
    }
</script>

<style scoped>
    .information-box {
        margin: 25px;
        padding: 15px;
        border: solid;
        border-width: 1px;
        border-color: #c9cce0;
        border-radius: .25rem;
        display: flex;
        flex-direction: column;
        text-align: center;
    }

        .information-box .box-heading {
            padding: 10px;
        }

    ul.music-points {
        list-style: none;
        padding: 0;
    }

        ul.music-points > li {
            padding-left: 1.3em;
        }

            ul.music-points > li:before {
                content: "\f001"; /* FontAwesome Music Unicode */
                font-family: FontAwesome;
                display: inline-block;
                margin-left: -1.3em;
                width: 1.3em;
            }

    .intro-text {
        margin: 15px;
    }

    .btn-primary:hover {
        background-color: #c98091 !important;
    }

    .btn-primary {
        background-color: #e08ea2 !important;
        border: unset !important;
    }

    .align-content-center {
        justify-content: center;
    }
</style>