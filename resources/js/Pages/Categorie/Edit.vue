<template>
    <div>
        <div class="content content-fixed">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                <li class="breadcrumb-item"><inertia-link :href="route('categories')">Liste des modèles</inertia-link></li>
                                <li class="breadcrumb-item active" aria-current="page">Formulaire modèle</li>
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">Bienvenue sur la modification du modèle
                            <span class="badge badge-dark tx-18">{{categorie.nom}}</span>
                        </h4>
                    </div>
                </div>

                <div class="row row-xs">
                    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                        <form @submit.prevent="submit" novalidate>
                            <div class="form-group row">
                            <label for="nom" class="col-sm-2 col-form-label">Nom <span class="tx-danger">*</span></label>
                            <div class="col-sm-10">
                                <input id="nom" type="text" class="form-control" v-model="form.nom">
                                <small v-if="$page.errors.nom" class="text-danger">
                                    {{$page.errors.nom[0]}}
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
                                <inertia-link class="btn btn-secondary" :href="route('categories')"><i class="fas fa-reply"></i> Annuler</inertia-link>
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
    metaInfo: {title: 'Formulaire Categorie'},
    layout: (h, page) => h(Layout, [page]),
    props: ['categorie'],
    data() {
        return {
            sending: false,
            form: {
                nom: this.categorie.nom
            }
        }
    },
    methods: {
        submit() {
            this.sending = true
            this.$inertia.put(this.route('categorie.update', this.categorie.id), this.form)
                .then(() =>  this.sending = false);
        }
    }
}
</script>
