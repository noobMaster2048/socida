<template>
    <div class="content content-fixed">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
                <div class="media-body align-items-center d-none d-lg-flex">
                    <div class="mx-wd-600">
                        <h2>Socida || Concessionnaire automobile <br>
                            Administration</h2>
                    </div>
                </div>

                <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
                    <b-toast class="alert alert-danger" v-model="$page.errors.email" variant="warning" :visible="$page.errors.email">
                        <template v-slot:toast-title>
                            <div class="d-flex flex-grow-1 align-items-baseline">
                                <b-img blank blank-color="#ff5555" class="mr-2" width="12" height="12"></b-img>
                                <strong class="mr-auto">Erreur!</strong>
                            </div>
                        </template>
                        <span>Ces références ne correspondent pas à nos données</span>
                    </b-toast>
                    <b-toast class="alert alert-danger" v-model="$page.errors.password" variant="warning" :visible="$page.errors.password">
                        <template v-slot:toast-title>
                            <div class="d-flex flex-grow-1 align-items-baseline">
                                <b-img blank blank-color="#ff5555" class="mr-2" width="12" height="12"></b-img>
                                <strong class="mr-auto">Erreur!</strong>
                            </div>
                        </template>
                        <span>Le mot de passe est obligatoire</span>
                    </b-toast>
                    <div class="wd-100p">
                        <h3 class="tx-color-01 mg-b-5"></h3>
                        <p class="tx-color-03 tx-16 mg-b-40"></p>
                        <form novalidate @submit.prevent="doLogin">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control" placeholder="votrenom@votremail.com" v-model="form.email">
                            </div>
                            <div class="form-group">
                                <label for="password"> Mot de passe</label>
                                <input id="password" type="password" class="form-control" v-model="form.password">
                            </div>
                            <button class="btn btn-brand-02 btn-block btn-primary" type="submit">
                                <b-spinner small v-if="sending"></b-spinner>
                               <span> Connexion</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        metaInfo: {title: 'Page de connexion'},
        props: [],
        data() {
            return {
                sending: false,
                form: {
                    email: null,
                    password: null,
                    remember: null
                }
            }
        },
        methods: {
            doLogin() {
                this.sending = true;
                this.$inertia.post(this.route(''), {
                    email: this.form.email,
                    password: this.form.password,
                    remember: this.form.remember
                }).then(()=> this.sending = false);
            }
        }
    }
</script>

<style scoped>

</style>
