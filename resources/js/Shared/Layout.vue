<template>
    <div>
        <main-menu></main-menu>
        <notifications group="flash" />
        <div>
            <slot></slot>
        </div>
    </div>
</template>

<script>
import MainMenu from '@/Shared/MainMenu';
    export default {
        components: {
            MainMenu
        }
    }
</script>

<style scoped>

</style>
