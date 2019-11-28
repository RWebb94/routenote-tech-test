<template>
    <b-container>
        <b-row>
            <b-col class="text-center">
                <h1>Search for an Artist</h1>

                <v-select label="name"
                          :filterable="false"
                          :options="options"
                          v-model="selectedartist"
                          @search="search_keydown">
                    <template slot="no-options">
                        Type to search for an Artist
                    </template>

                    <template slot="option" slot-scope="artist">
                        <div class="d-center">
                            <div class="dropdownContent">
                                <img :src='artist.images[2].url'
                                     v-if="typeof artist.images !== 'undefined' && '2' in artist.images" />
                                <img src="../assets/missingartwork.png" title="Missing Artwork" v-else />
                            </div>

                            <div class="dropdownContent">
                                {{ artist.name }}
                                <br />
                                {{ artist.followers.total | thousandsfloat }} Followers
                            </div>
                        </div>
                    </template>

                    <template slot="selected-option" slot-scope="artist">
                        <div class="selected d-center">
                            {{ artist.name }}
                        </div>
                    </template>
                </v-select>
            </b-col>
        </b-row>

        <b-row>
            <artistdetails :artistdetails="selectedartist" />
        </b-row>
    </b-container>
</template>


<script>
    import vSelect from 'vue-select'
    import 'vue-select/dist/vue-select.css'
    import axios from 'axios'
    import artistdetails from './sections/ArtistDetails.vue'
    import debounce from 'debounce'

    export default {
        name: 'template-search',
        components: {
            'v-select': vSelect,
            artistdetails
        },
        data() {
            return {
                selectedartist: null,
                timer: '',
                options: []
            }
        },
        methods: {
            search_keydown(search, loading) {
                console.log("Key pressed");
                
                // loading(true);

                if (search == '') {
                    console.log("No Search string");
                    this.options = [];
                } else {
                    this.searchForArtists(loading, search, this);
                }
            },
            searchForArtists: debounce((loading, searchstring, self) => {
                var data = { searchstring: searchstring };
                axios.post('/api/spotifydetails/searchArtists', data)
                    .then(res => {
                        self.options = res.data.artists.items;
                        // loading(false);
                    })
                    .catch(function (res) {
                        console.log("Could not load artists. Response:");
                        console.log(res);
                        // loading(false);
                    });
            }, 350)
        },
        filters: {
            thousandsfloat(value) {
                return value.toLocaleString();
            }
        }
    };
</script>

<style scoped>
    img {
        height: auto;
        margin-right: 1rem;
    }

    .d-center {
        display: flex;
        align-items: center;
    }

    .v-select {
        padding-top: 30px;
    }

        .v-select > div.dropdownContent {
            float: left;
        }

        .v-select .dropdown-toggle {
            display: flex !important;
            flex-wrap: wrap;
        }

    .v-select input[type=search], .v-select input[type=search]:focus {
        flex-basis: 20px;
        flex-grow: 1;
        height: 33px;
        padding: 0 20px 0 10px;
        width: 100% !important;
    }

    .v-select {
        width: 50%;
        margin: auto;
    }

        .v-select .dropdown li {
            border-bottom: 1px solid rgba(112, 128, 144, 0.1);
        }

        .v-select .dropdown li:last-child {
            border-bottom: none;
        }

        .v-select .dropdown li a {
            padding: 10px 20px;
            width: 100%;
            font-size: 1.25em;
            color: blue !important
        }

    .v-select .dropdown-menu .active > a {
        color: #fff;
    }
</style>