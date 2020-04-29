<template>
    <div>
        <div class="content content-fixed">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                <li class="breadcrumb-item"><a href="#">Gestion</a></li>
                                <li class="breadcrumb-item active" aria-current="page">des modèles</li>
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">Bienvenue sur la gestion des modèles de véhicules</h4>

                        <div class="search-form mg-t-20 mg-sm-t-0 pd-t-7">
                            <label class="search-form">
                                <input type="search" class="form-control" v-model="search" placeholder="Recherche">
                                <button class="btn" type="button"><i class="fas fa-search"></i></button>
                            </label>
                        </div>
                    </div>
                    <b-alert variant="success" v-model="flash.success" dismissible fade>
                        {{flash.success}}
                    </b-alert>

                    <div class="d-none d-md-block">
                        <inertia-link :href="route('categorie.create')" class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5">
                            <i class="fas fa-plus"></i>
                            Nouveau modèle
                        </inertia-link>
                    </div>
                </div>
                <div class="row row-xs">
                    <div class="container">
                        <table class="table table-hover table-primary mg-b-0">
                            <thead class="thead-primary">
                            <tr>
                                <th>Nom</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="cat in filterBy(categories.data, search)" :key="cat.id">

                                <td>{{cat.nom}}</td>
                                <td class="text-right">
                                    <inertia-link class="btn btn-primary btn-sm" :href="route('categorie.edit', cat.id)">
                                        <i class="fas fa-edit" title="Modifier"></i>
                                    </inertia-link>
                                    <button class="btn btn-danger btn-sm" @click="destroy(cat.id)">
                                        <i class="fas fa-trash" title="Supprimer"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="categories.data.length === 0">
                                <td class="border-t px-6 py-4" colspan="6">Aucune donné disponible</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="overflow-auto" v-if="categories.data.length !== 0">
                            <pagination :links="categories.links"></pagination>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Layout from '@/Shared/Layout';
import Pagination from '@/Shared/Pagination';
import Vue2Filters from 'vue2-filters'
    export default {
        metaInfo: {title: 'Categories'},
        layout: (h, page) => h(Layout, [page]),
        mixins: [Vue2Filters.mixin],
        components: {
            Pagination
        },
        data() {
            return {
                search: ''
            }
        },
        props: ['categories', 'flash'],
        methods: {
            destroy(cat) {
                if (confirm('Etes vous sur de supprimer cette catégorie?')) {
                    this.$inertia.delete(this.route('categorie.delete', cat))
                }
            },
        }
    }
</script>

<style scoped>
    .search-form {
        display: flex;
        align-items: stretch;

    }
</style>
