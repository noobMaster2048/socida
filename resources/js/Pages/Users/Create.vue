<template>
    <div>
        <div class="content conten-fixed">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                <li class="breadcrumb-item"><inertia-link :href="route('users')">Liste des utiliseurs</inertia-link></li>
                                <li class="breadcrumb-item active" aria-current="page">Formulaire utilisateur</li>
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">Bienvenue sur la création d'un utilisateur</h4>
                    </div>
                </div>

                <div class="row row-xs">
                    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                        <form novalidate @submit.prevent="submit">
                            <div class="form-group row">
                                <label for="first_name" class="col-sm-2 col-form-label">Prénoms</label>
                                <div class="col-sm-10">
                                    <input id="first_name" type="text" class="form-control" v-model="form.first_name">
                                    <small v-if="$page.errors.first_name" class="text-danger">
                                        {{$page.errors.first_name[0]}}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_name" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-10">
                                    <input id="last_name" type="text" class="form-control" v-model="form.last_name">
                                    <small v-if="$page.errors.last_name" class="text-danger">
                                        {{$page.errors.last_name[0]}}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Adresse email</label>
                                <div class="col-sm-10">
                                    <input id="email" type="text" class="form-control" v-model="form.email">
                                    <small v-if="$page.errors.email" class="text-danger">
                                        {{$page.errors.email[0]}}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
                                <div class="col-sm-10">
                                    <input id="password" type="password" class="form-control" v-model="form.password">
                                    <small v-if="$page.errors.password" class="text-danger">
                                        {{$page.errors.password[0]}}
                                    </small>
                                </div>
                            </div>
                            <div class="d-none mg-sm-l-10 mg-sm-t-25 pd-t-4 d-flex align-items-center justify-content-center">
                                <div class="pd-10">
                                    <button :disabled="sending" class="btn btn-primary" type="submit">
                                        <b-spinner small v-if="sending"></b-spinner>
                                        <i class="fas fa-save"></i>
                                        Enregistrer
                                    </button>
                                </div>
                                <div class="pd-10">
                                    <inertia-link class="btn btn-secondary" :href="route('users')"><i class="fas fa-reply"></i> Annuler</inertia-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';
    export default {
        metaInfo: {title: 'Formulaire utilisateur'},
        layout: (h, page) => h(Layout, [page]),
        props: [],
        data() {
            return {
                sending: false,
                form: {
                    first_name: null,
                    last_name: null,
                    email: null,
                    password: null
                }
            }
        },
        methods: {
            submit() {
                this.sending = true;
                this.$inertia.post(this.route('user.store'), this.form).then(() =>  this.sending = false);
            }
        }
    }
</script>

<style scoped>

</style>
