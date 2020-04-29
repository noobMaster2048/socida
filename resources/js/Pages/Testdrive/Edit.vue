<template>
    <div>
        <div class="content content-fixed">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                <li class="breadcrumb-item"><inertia-link :href="route('drives')">Liste des tests drives</inertia-link></li>
                                <li class="breadcrumb-item active" aria-current="page">Formulaire test drive</li>
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">Bienvenue sur la modification d'un test drive</h4>
                    </div>
                </div>

                <div class="row row-xs">
                    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                        <form @submit.prevent="submit" novalidate>
                            <div class="form-group row">
                                <label for="nom" class="col-sm-2 col-form-label">Nom <span class="tx-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input id="nom" type="text" class="form-control" v-model="form.nom_demandeur">
                                    <small v-if="$page.errors.nom_demandeur" class="text-danger">
                                        {{$page.errors.nom_demandeur[0]}}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tel" class="col-sm-2 col-form-label">Téléphone</label>
                                <div class="col-sm-10">
                                    <input id="tel" type="text" v-model="form.tel_demandeur" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email <span class="tx-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input id="email" type="text" v-model="form.email_demandeur" class="form-control">
                                    <small v-if="$page.errors.email_demandeur" class="text-danger">
                                        {{$page.errors.email_demandeur[0]}}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="vehicule" class="col-sm-2 col-form-label">Véhicule <span class="tx-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select  id="vehicule" v-model="form.vehicule_id" class="form-control">
                                        <option :value="null"></option>
                                        <option v-for="veh in vehicules" :key="veh.id" :value="veh.id">{{veh.nom}}</option>
                                    </select>
                                    <small v-if="$page.errors.vehicule_id" class="text-danger">
                                        {{$page.errors.vehicule_id[0]}}
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="input-group mb-3">
                                    <label for="date_debut" class=""> Date début</label>
                                    <div class="col-sm-10">
                                        <input id="date_debut" v-model="form.date_debut" type="date" class="form-control" >
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="date_fin" class="">Date Fin</label>
                                    <div class="col-sm-10">
                                        <input id="date_fin" v-model="form.date_fin" type="date" class="form-control" >
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="heure_debut" class="">Heure début</label>
                                    <div class="col-sm-10">
                                        <input id="heure_debut" type="time" v-model="form.heure_debut" class="form-control">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="heure_fin" class="">Heure fin</label>
                                    <div class="col-sm-10">
                                        <input id="heure_fin" type="time" class="form-control" v-model="form.heure_fin">
                                    </div>
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
                                    <inertia-link class="btn btn-secondary" :href="route('drives')"><i class="fas fa-reply"></i> Annuler</inertia-link>
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
        metaInfo: {title: 'Formulaire Test drive'},
        layout: (h, page) => h(Layout, [page]),
        props:['vehicules', 'drive'],
        data() {
            return {
                sending: false,
                form: {
                    nom_demandeur: this.drive.nom_demandeur,
                    tel_demandeur: this.drive.tel_demandeur,
                    email_demandeur: this.drive.email_demandeur,
                    vehicule_id: this.drive.vehicule_id,
                    date_debut: this.drive.date_debut,
                    date_fin: this.drive.date_fin,
                    heure_debut: this.drive.heure_debut,
                    heure_fin: this.drive.heure_fin
                }
            }
        },
        methods: {
            submit() {
                this.sending = true;
                this.$inertia.put(this.route('drive.update', this.drive.id), this.form).then(() =>  this.sending = false);
            }
        }
    }
</script>
