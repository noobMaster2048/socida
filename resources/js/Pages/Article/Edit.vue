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
                        <h4 class="mg-b-0 tx-spacing--1">Bienvenue sur le formulaire de modification de l'article
                            <span class="badge badge-dark tx-18">{{article.titre}}</span>
                        </h4>
                    </div>
                </div>

                <div class="row row-xs">
                    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                        <form @submit.prevent="submit" novalidate>
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
                                <label for="slug" class="col-sm-2 col-form-label">Slug  <span class="tx-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input id="slug" type="text" v-model="form.slug" class="form-control">
                                    <small v-if="$page.errors.slug" class="text-danger">
                                        {{$page.errors.slug[0]}}
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
    export default {
        metaInfo: {title: 'Formulaire Article'},
        layout: (h, page) => h(Layout, [page]),
        components: {
            ckeditor: CKEditor.component
        },
        props: ['article'],
        data() {
            return {
                sending: false,
                editor: ClassicEditor,
                form: {
                    titre: this.article.titre,
                    slug: this.article.slug,
                    contenu: this.article.contenu,
                    type_article: this.article.type_article
                }
            }
        },
        methods: {
            submit() {
                this.sending = true;
                this.$inertia.put(this.route('article.update', this.article.id), this.form).then(() =>  this.sending = false);
            }
        }
    }
</script>
