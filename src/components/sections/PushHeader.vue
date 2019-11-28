<template>
    <header>
        <nav>
            <a href="/" class="router-link-exact-active router-link-active">
                <div class="logo" style="transform: scale(1) translateX(0px);">
                    <span class="p">P</span> 
                    <span class="u">U</span> 
                    <span class="s">S</span> 
                    <span class="h">H</span>
                </div>
            </a>
        </nav>
    </header>
</template>

<script>
    export default {
        name: 'push-header',
    };
</script>

<style>
    header {
        height: 5rem;
        z-index: 50;
        color: #fff;
        left: 0;
        right: 0;
        top: 0;
        position: fixed;
        background-color: #293583;
    }

        header > nav {
            padding-left: 2rem;
            padding-right: 2rem;
            width: 100%;
            height: 100%;
            align-items: center;
            display: flex;
        }

    a.router-link-active {
        text-decoration: none;
        position: relative;
        color: #293583;
        cursor: pointer;
        background-color: transparent;
    }

    .logo {
        font-weight: 800;
        text-decoration: none;
        color: #ffffff;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        position: relative;
        display: inline-block;
        font-size: 2.9375rem;
        width: 119px;
        height: 31px;
    }

        .logo span {
            transition: all .3s ease;
            display: inline-block;
            transform: rotate(15deg);
            line-height: 0;
        }

        .logo:hover span {
            transform: rotate(25deg);
        }

        .logo .p {
            position: absolute;
            top: 15px;
            left: 4px;
        }

        .logo .u {
            position: absolute;
            top: 16px;
            left: 31px;
        }

        .logo .s {
            position: absolute;
            top: 15px;
            left: 64px;
        }

        .logo .h {
            position: absolute;
            top: 16px;
            left: 91px;
        }
</style>