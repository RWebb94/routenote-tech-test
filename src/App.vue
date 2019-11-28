<template>
    <div id="app">
        <div class="overflow-visible sidebar-open">
            <Header />
            <Sidebar />

            <main class="mt-16 lg:mt-20 overflow-y-visible overflow-x-hidden lg:overflow-x-visible ml-menu p-8">
                <ArtistContent />
            </main>
        </div>
    </div>
</template>

<script>
    import PushHeader from './components/sections/PushHeader.vue'
    import PushSidebar from './components/sections/PushSidebar.vue'
    import ArtistContent from './components/ArtistContent.vue'

    export default {
        components: {
            'Header': PushHeader,
            'Sidebar': PushSidebar,
            ArtistContent
        }
    }
</script>

<style>
    html, body {
        background-color: #f4f5f9;
        background-size: cover;
        background-position: 50%;
        background-repeat: no-repeat;
        font-weight: 400;
        font-family: hk_grotesk !important;
        line-height: 1.5625;
        color: #000;
        width: 100%;
        font-size: 1rem;
        overflow: visible;
    }

    h1, h2, h3, h4, h5 { color:#293583 }

    #app {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #2c3e50;
    }
</style>
