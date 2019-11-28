<template>
    <b-container v-if="tracks !== null">
        <b-row>
            <b-col>
                <h1>Top Tracks</h1>
            </b-col>
        </b-row>
        <b-row class="scrollbar nowrap">
            <b-col v-for="(track, index) in tracks.tracks"
                   v-bind:key="index"
                   class="toptracks-box">
                <img :src="track.album.images['1'].url" alt="Album Artwork" />

                <p>{{ track.name }}</p>

                <p>Duration: {{ track.duration_ms | tracklength }}</p>

                <b-row class="popularity-boxes">
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 10) }"></b-col>
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 20) }"></b-col>
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 30) }"></b-col>
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 40) }"></b-col>
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 50) }"></b-col>
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 60) }"></b-col>
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 70) }"></b-col>
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 80) }"></b-col>
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 90) }"></b-col>
                    <b-col :class="{ 'whitebox' : popularityChecker(track.popularity, 100) }"></b-col>
                </b-row>

                <a class="group btn relative transition btn-primary mb-3" :href="track.external_urls.spotify" target="_blank">Listen on Spotify</a>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        props: {
            tracks: {
                type: Object
            }
        },
        methods: {
            popularityChecker: function (popularity, checkvalue) {
                var popnumber = Number(popularity);
                return popnumber >= checkvalue;
            }
        },
        filters: {
            tracklength(value) {
                var seconds = Math.floor((value / 1000) % 60),
                    minutes = Math.floor((value / (1000 * 60)) % 60);

                return minutes + "m " + seconds + "s"
            }
        }
    }
</script>

<style>
    .toptracks-box {
        margin: 25px;
        padding: 15px;
        border: solid;
        border-width: 1px;
        border-color: #c9cce0;
        border-radius: .25rem;
        display: flex;
        flex-direction: column;
        text-align: center;
        max-width: 20% !important;
    }

        .toptracks-box > p:nth-child(2) {
            flex-grow: 1;
        }

    .popularity-boxes {
        padding: 0 15px;
    }

        .popularity-boxes > div {
            height: 20px;
            background-color: lightgrey;
            padding: 0px;
            margin: 0 2px 10px 2px;
        }

            .popularity-boxes > div.whitebox {
                background-color: white !important;
                border: 1px solid lightgrey;
            }

    .btn-primary {
        background-color: #e08ea2 !important;
        border: unset !important;
    }

    .scrollbar {
        display: flex !important;
        flex-wrap: nowrap !important;
        overflow-x: auto !important;
    }

    .nowrap {
        flex-wrap: nowrap !important
    }
</style>