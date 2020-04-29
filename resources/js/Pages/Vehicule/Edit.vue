<template>
    <div>
        <div class="content content-fixed">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                <li class="breadcrumb-item"><inertia-link :href="route('vehicules')">Liste des véhicules</inertia-link></li>
                                <li class="breadcrumb-item active" aria-current="page">Formulaire véhicule</li>
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">Bienvenue sur le formulaire de modification des données d'un véhicule</h4>
                    </div>
                </div>

                <div class="row row-xs">
                    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                        <form @submit.prevent="submit" novalidate>
                            <fieldset class="form-group row">
                                <legend class="col-form-legend ">Informations générales</legend>
                                <b-card>
                                    <div class="form-group row">
                                        <label for="nom" class="col-sm-2 col-form-label">Nom <span class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input id="nom" type="text" class="form-control" v-model="form.nom">
                                            <small v-if="$page.errors.nom" class="text-danger">
                                                {{$page.errors.nom[0]}}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="disponible" class="col-sm-2 col-form-label">Disponible</label>
                                        <div class="col-sm-10">
                                            <input id="disponible" type="checkbox" v-model="form.disponible" class="form-check-input">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="prix" class="col-sm-2 col-form-label">Prix <span class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input id="prix" type="text" v-model="form.prix" class="form-control">
                                            <small v-if="$page.errors.prix" class="text-danger">
                                                {{$page.errors.prix[0]}}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="marque" class="col-sm-2 col-form-label">Marque <span class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <select  id="marque" v-model="form.marque_id" class="form-control">
                                                <option :value="null"></option>
                                                <option v-for="marque in marques" :key="marque.id" :value="marque.id">{{marque.nom}}</option>
                                            </select>
                                            <small v-if="$page.errors.marque_id" class="text-danger">
                                                {{$page.errors.marque_id[0]}}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="categorie" class="col-sm-2 col-form-label">Categorie <span class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <select  id="categorie" v-model="form.categorie_id" class="form-control">
                                                <option :value="null"></option>
                                                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{cat.nom}}</option>
                                            </select>
                                            <small v-if="$page.errors.categorie_id" class="text-danger">
                                                {{$page.errors.categorie_id[0]}}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lien_ext" class="col-sm-2 col-form-label">Lien 360° exterieur</label>
                                        <div class="col-sm-10">
                                            <input id="lien_ext" type="text" class="form-control" v-model="form.lien_visuel_ext">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lien_int" class="col-sm-2 col-form-label">Lien 360° interieur</label>
                                        <div class="col-sm-10">
                                            <input id="lien_int" type="text" class="form-control" v-model="form.lien_visuel_int">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="desc" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea  id="desc" class="form-control" v-model="form.description"></textarea>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <label for="photo" class="custom-file-label">Choisissez une photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" @change="processFile($event)" id="photo" class="custom-file-input"></input>
                                        </div>
                                    </div>
                                </b-card>
                            </fieldset>
                            <fieldset class="form-inline">
                                <legend>Données techinques</legend>
                                <b-card>
                                    <div class="form-inline">
                                        <div class="form-group mb-2 mx-sm-3">
                                            <label for="consommation" class="sr-only">Consommation</label>
                                            <input type="text" class="form-control" id="consommation" v-model="form.consommation" placeholder="Consommation">
                                        </div>
                                        <div class="form-group mb-2 mx-sm-3">
                                            <label for="hauteur" class="sr-only">Hauteur</label>
                                            <input type="text" class="form-control" id="hauteur" v-model="form.hauteur" placeholder="Hauteur">
                                        </div>
                                        <div class="form-group mb-2 mx-sm-3">
                                            <label for="longueur" class="sr-only">Longueur</label>
                                            <input type="text" class="form-control" id="longueur" v-model="form.longueur" placeholder="Longueur">
                                        </div>
                                        <div class="form-group mb-2 mx-sm-3">
                                            <label for="largeur" class="sr-only">Largeur</label>
                                            <input type="text" class="form-control" id="largeur" v-model="form.largeur" placeholder="Largeur">
                                        </div>
                                    </div>
                                </b-card>
                            </fieldset>
                            <fieldset>
                                <legend>Galerie</legend>
                                <b-card>
                                    <el-upload action="/" list-type="picture-card"
                                               :on-preview="handleImageCardView"
                                               :on-change="updateImageList"
                                               :auto-upload="false">
                                        <i class="fas fa-plus"></i>
                                    </el-upload>
                                </b-card>
                            </fieldset>
                            <div class="d-none mg-sm-l-10 mg-sm-t-25 pd-t-4 d-flex align-items-center justify-content-center">
                                <div class="pd-10">
                                    <button :disabled="sending" class="btn btn-primary" type="submit">
                                        <b-spinner small v-if="sending"></b-spinner>
                                        <i class="fas fa-save"></i>
                                        Enregistrer
                                    </button>
                                </div>
                                <div class="pd-10">
                                    <inertia-link class="btn btn-secondary" :href="route('vehicules')"><i class="fas fa-reply"></i> Annuler</inertia-link>
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
    import * as $ from "lodash";
    export default {
        metaInfo: {title: 'Formulaire Vehicule'},
        layout: (h, page) => h(Layout, [page]),
        props:['marques', 'categories', 'vehicule'],
        data() {
            return {
                sending: false,
                form: {
                    nom: this.vehicule.nom,
                    disponible: this.vehicule.disponible,
                    marque_id: this.vehicule.marque_id,
                    categorie_id: this.vehicule.categorie_id,
                    consommation: this.vehicule.consommation,
                    prix: this.vehicule.prix,
                    hauteur: this.vehicule.hauteur,
                    longueur: this.vehicule.longueur,
                    largeur: this.vehicule.largeur,
                    nb_places: this.vehicule.nb_places,
                    cap_coffre: this.vehicule.cap_coffre,
                    ray_braq: this.vehicule.ray_braq,
                    lien_visuel_ext: this.vehicule.lien_visuel_ext,
                    lien_visuel_int: this.vehicule.lien_visuel_int,
                    img_path: this.vehicule. img_path,
                },
                imageList: [],
                dialogImgUrl: '',
                dialogVisible: false,
            }
        },
        methods: {
            submit() {
                this.sending = true;
                this.form.disponible = this.form.disponible ? 1 : 0;
                this.form.nb_places = this.form.nb_places ? this.form.nb_places : 0;
                this.form.cap_coffre = this.form.cap_coffre ? this.form.cap_coffre : 0;
                this.form.ray_braq = this.form.ray_braq ? this.form.ray_braq : 0;
                let formData = new FormData();
                formData.append('nom', this.form.nom);
                formData.append('disponible', this.form.disponible);
                formData.append('marque_id', this.form.marque_id);
                formData.append('categorie_id', this.form.categorie_id);
                formData.append('consommation', this.form.consommation);
                formData.append('prix', this.form.prix);
                formData.append('hauteur', this.form.hauteur);
                formData.append('longueur', this.form.longueur);
                formData.append('largeur', this.form.largeur);
                formData.append('nb_places', this.form.nb_places);
                formData.append('cap_coffre', this.form.cap_coffre);
                formData.append('ray_braq', this.form.ray_braq);
                formData.append('lien_visuel_ext', this.form.lien_visuel_ext);
                formData.append('lien_visuel_int', this.form.lien_visuel_int);
                formData.append('description', this.form.description);
                formData.append('img_path', this.form.img_path);
                $.each(this.imageList, function (key, image) {
                    this.form.append(`images[${key}]`, image)
                });
                this.$inertia.put(this.route('vehicule.update', this.vehicule.id), this.form).then(() =>  this.sending = false);
            },
            updateImageList(file) {
                this.imageList.push(file.raw)
            },
            handleImageCardView(file) {
                this.dialogImgUrl = file.url;
                this.dialogVisible = true;
            },
            processFile(event) {
                this.form.img_path = event.target.files[0];
                console.log(this.form.img_path)
            }
        }
    }
</script>

