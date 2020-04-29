<template>
    <nav>
        <ul class="pagination">
            <li v-for="(link, key) in links" class="page-item" :class="{'active': link.active}">
                <div v-if="link.url === null" :key="key" class="page-link"  :class="{ 'disabled': link.label === 'Precedent' }">{{ link.label }}</div>
                <inertia-link v-else :key="key" class="page-link"  :class="{ 'active': link.active, 'mx-auto': link.label === 'Suivant' }" :href="link.url">{{ link.label }}</inertia-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
       props: ['links']
    }
</script>

<style scoped>

</style>
