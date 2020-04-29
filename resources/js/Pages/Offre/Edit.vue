<template>
    <div>
        <div class="content content-fixed">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                <li class="breadcrumb-item"><inertia-link :href="route('offres')">Liste des offres</inertia-link></li>
                                <li class="breadcrumb-item active" aria-current="page">Formulaire offre</li>
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">Bienvenue sur le formulaire d'enregistrement d'une offre</h4>
                    </div>
                </div>

                <div class="row row-xs">
                    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                        <form @submit.prevent="submit" novalidate>
                            <div class="form-group row">
                                <label for="veh" class="col-sm-2 col-form-label">Véhicule <span class="tx-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="veh" id="veh" v-model="form.vehicule_id" class="form-control">
                                        <option :value="null"></option>
                                        <option v-for="vehicule in vehicules" :key="vehicule.id" :value="vehicule.id">{{vehicule.nom}}</option>
                                    </select>
                                    <small v-if="$page.errors.vehicule_id" class="text-danger">
                                        le champ véhicule est obligatoire
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prix" class="col-sm-2 col-form-label">Prix</label>
                                <div class="col-sm-10">
                                    <input id="prix" type="text" class="form-control" v-model="form.prix_promo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lien" class="col-sm-2 col-form-label">Lien vidéo</label>
                                <div class="col-sm-10">
                                    <input type="text" id="lien" class="form-control" v-model="form.lien_video">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="statut" class="col-sm-2 col-form-label">Statut</label>
                                <div class="col-sm-10">
                                    <input type="checkbox" id="statut" class="form-check-input" v-model="form.statut">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="debut" class="col-sm-2 col-form-label">Date début</label>
                                <div class="col-sm-10">
                                    <input type="date" id="debut" class="form-control" v-model="form.date_debut">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fin" class="col-sm-2 col-form-label">Date fin</label>
                                <div class="col-sm-10">
                                    <input type="date" id="fin" class="form-control" v-model="form.date_fin">
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
                                    <inertia-link class="btn btn-secondary" :href="route('offres')"><i class="fas fa-reply"></i> Annuler</inertia-link>
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
        metaInfo: {title: 'Formulaire offre'},
        layout: (h, page) => h(Layout, [page]),
        props: ['offre', 'vehicules'],
        data() {
            return {
                sending: false,
                form: {
                    lien_video: this.offre.lien_video,
                    statut: this.offre.statut,
                    date_debut: this.offre.date_debut,
                    date_fin: this.offre.date_fin,
                    vehicule_id: this.offre.vehicule_id,
                    prix_promo: this.offre.prix_promo,
                }
            }
        },
        methods: {
            submit() {
                this.sending = true;
                this.form.statut = this.form.statut ? 1 : 0;
                this.$inertia.put(this.route('offre.update', this.offre.id), this.form)
                    .then(() =>  this.sending = false);
            }
        }
    }
</script>

