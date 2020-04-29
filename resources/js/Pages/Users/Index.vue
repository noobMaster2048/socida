<template>
    <div>
        <div class="content content-fixed">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                <li class="breadcrumb-item"><a href="#">Gestion</a></li>
                                <li class="breadcrumb-item active" aria-current="page">des utilisateurs</li>
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">Bienvenue sur la gestion des utilisateurs</h4>
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
                        <inertia-link :href="route('user.create')" class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5">
                            <i class="fas fa-plus"></i>
                            Nouvel utilisateur
                        </inertia-link>
                    </div>
                </div>

                <div class="row row-xs">
                    <div class="container">
                        <table class="table table-hover table-primary">
                            <thead class="thead-primary">
                            <tr>
                                <th>Nom</th>
                                <th>Prénoms</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in filterBy(users.data, search)" :key="user.id">
                                <td>{{user.last_name}}</td>
                                <td>{{user.first_name}}</td>
                                <td>{{user.email}}</td>
                                <td class="text-right">
                                    <inertia-link :href="route('user.edit', user.id)" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit" title="Modifier"></i>
                                    </inertia-link>
                                    <button class="btn btn-danger btn-sm" @click="destroy(user.id)">
                                        <i class="fas fa-trash" title="Supprimer"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="users.data.length === 0">
                                <td class="border-t px-6 py-4" colspan="6">Aucune donné disponible</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="overflow-auto" v-if="users.data.length !== 0">
                            <pagination :links="users.links"></pagination>
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
        metaInfo: {title: 'Utilisateurs'},
        layout: (h, page) => h(Layout, [page]),
        mixins: [Vue2Filters.mixin],
        props: ['users', 'flash'],
        data() {
            return {
                search: ''
            }
        },
        components: {
            Pagination
        },
        methods: {
            destroy(id) {
                if (confirm('Etes vous sur de supprimer cet utilisateur ?')) {
                    this.$inertia.delete(this.route('user.delete', id))

                }
            }
        }
    }
</script>

<style scoped>

</style>
