<template>
    <div>
       <div class="container-fluid">
           <h1> Acceuil</h1>
           <p>Bienvenue sur SOCIDA admin</p>
       </div>
    </div>
</template>

<script>
import Layout from '@/Shared/Layout'
    export default {
        metaInfo: {title: 'Acceuil'},
        layout: (h, page) => h(Layout, [page])

    }
</script>
