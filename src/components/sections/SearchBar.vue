<template>
    <b-container>
        <b-row>
            <v-select 
                      label="artists" 
                      :filterable="false" 
                      :options="options" 
                      v-model="selectedartist"
                      @search="search_keydown">
                <template slot="no-options">
                    Type to search for an Artist
                </template>

                <template slot="option" slot-scope="artist">
                    <div class="d-center">
                        <img :src='artist.images[2].url'
                             v-if="typeof artist.images !== 'undefined' && '2' in artist.images" />
                        <img src="../../assets/missingartwork.png" title="Missing Artwork" v-else />
                        {{ artist.name }}
                    </div>
                </template>

                <template slot="selected-option" slot-scope="artist">
                    <div class="selected d-center">
                        <img :src='artist.images[2].url'
                             v-if="typeof artist.images !== 'undefined' && '2' in artist.images" />
                        <img src="../../assets/missingartwork.png" title="Missing Artwork" v-else />
                        {{ artist.name }}
                    </div>
                </template>
            </v-select>
        </b-row>
    </b-container>
</template>

<script>
    import vSelect from 'vue-select'
    import 'vue-select/dist/vue-select.css';
    import axios from 'axios'

    export default {
        components: {
            'v-select': vSelect
        },
        name: 'SearchBar',
        data() {
            return {
                searchstring: null,
                selectedartist: null,
                timer: '',
                options: []
            }
        },
        methods: {
            search_keydown(search, loading) {
                console.log("Key pressed");

                var self = this;
                loading = true;
                self.searchstring = search;

                if (search == '') {
                    console.log("No Search string");
                    self.matchingartists = null;
                } else {
                    clearTimeout(self.timer);
                    self.timer = setTimeout(this.searchForArtists(loading), 500);
                }
            },
            searchForArtists(loading) {
                var self = this;
                var data = { searchstring: self.searchstring };
                axios.post('/api/spotifydetails/searchArtists', data)
                    .then(res => {
                        self.options = res.data.artists.items;
                        loading = false;
                    })
                    .catch(function (res) {
                        console.log("Could not load artists. Response:");
                        console.log(res);
                        loading = false;
                    });
            }
        }
	}
</script>

<style scoped>
    img {
        max-width: 50%;
        height: auto;
        max-width: 2.5rem;
        margin-right: 1rem;
    }

    .d-center {
        display: flex;
        align-items: center;
    }

    .selected img {
        width: auto;
        max-height: 23px;
        margin-right: 0.5rem;
    }

    .v-select {
        width: 50%;
        margin: auto auto;
        padding-top: 30px;
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
            color: #3c3c3c;
        }

    .v-select .dropdown-menu .active > a {
        color: #fff;
    }
</style>