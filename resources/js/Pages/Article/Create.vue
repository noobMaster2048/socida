<template>
    <div>
        <div class="content content-fixed">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                <li class="breadcrumb-item"><inertia-link :href="route('articles')">Liste des articles</inertia-link></li>
                                <li class="breadcrumb-item active" aria-current="page">Formulaire article</li>
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">Bienvenue sur le formulaire d'enregistrement d'un article</h4>
                    </div>
                </div>

                <div class="row row-xs">
                    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                        <form @submit.prevent="submit" novalidate>
                            <b-tabs>
                                <b-tab title="Informations genérales">
                                    <b-card>
                                        <div class="form-group row">
                                            <label for="titre" class="col-sm-2 col-form-label">titre <span class="tx-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <input id="titre" type="text" class="form-control" v-model="form.titre">
                                                <small v-if="$page.errors.titre" class="text-danger">
                                                    {{$page.errors.titre[0]}}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Contenu  <span class="tx-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <ckeditor :editor="editor" v-model="form.contenu" ></ckeditor>
                                                <small v-if="$page.errors.contenu" class="text-danger">
                                                    {{$page.errors.contenu[0]}}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="type_article" class="col-sm-2 col-form-label">Type d'article  <span class="tx-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <select  id="type_article" v-model="form.type_article" class="form-control">
                                                    <option :value="null"></option>
                                                    <option value="img">Image</option>
                                                    <option value="txt">Texte</option>
                                                    <option value="vid">Vidéo</option>
                                                </select>
                                                <small v-if="$page.errors.type_article" class="text-danger">
                                                    {{$page.errors.type_article[0]}}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <label for="photo" class="custom-file-label">Choisissez une photo</label>
                                            <div class="col-sm-10">
                                                <input type="file" @change="processFile($event)" id="photo" class="custom-file-input"></input>
                                            </div>
                                        </div>
                                    </b-card>
                                </b-tab>
                                <b-tab title="Galerie">
                                    <b-card>
                                        <el-upload action="/" list-type="picture-card"
                                                   :on-preview="handleImageCardView"
                                                   :on-change="updateImageList"
                                                   :auto-upload="false">
                                            <i class="fas fa-plus"></i>
                                        </el-upload>
                                    </b-card>
                                </b-tab>
                            </b-tabs>
                            <div class="d-none mg-sm-l-10 mg-sm-t-25 pd-t-4 d-flex align-items-center justify-content-center">
                                <div class="pd-10">
                                    <button :disabled="sending" class="btn btn-primary" type="submit">
                                        <b-spinner small v-if="sending"></b-spinner>
                                        <i class="fas fa-save"></i>
                                        Enregistrer
                                    </button>
                                </div>
                                <div class="pd-10">
                                    <inertia-link class="btn btn-secondary" :href="route('articles')"><i class="fas fa-reply"></i> Annuler</inertia-link>
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
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import * as $ from "lodash";

    export default {
        metaInfo: {title: 'Formulaire Article'},
        layout: (h, page) => h(Layout, [page]),
        components: {
            ckeditor: CKEditor.component
        },
        props: [],
        data() {
            return {
                sending: false,
                editor: ClassicEditor,
                form: {
                    titre: null,
                    contenu: null,
                    type_article: null,
                    attachable_type: null,
                    couverture: null,
                },
                imageList: [],
                dialogImgUrl: '',
                dialogVisible: false,
            }
        },
        methods: {
            submit() {
                this.sending = true;
                this.form.attachable_type = 'vehicule';
                let formData = new FormData();
                formData.append('titre', this.form.titre);
                formData.append('contenu', this.form.contenu);
                formData.append('type_article', this.form.type_article);
                formData.append('couverture', this.form.couverture);
                $.each(this.imageList, function (key, image) {
                    formData.append(`images[${image}]`, key);
                    console.log(key);

                });
                this.$inertia.post(this.route('article.store'), formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(() =>  this.sending = false);
            },
            updateImageList(file) {
                this.imageList.push(file.raw)
            },
            handleImageCardView(file) {
                this.dialogImgUrl = file.url;
                this.imageList.push(file);
                this.dialogVisible = true;
            },
            processFile(event) {
                this.form.couverture = event.target.files[0];
            }
        }
    }
</script>
