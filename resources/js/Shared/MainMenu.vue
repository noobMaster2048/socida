<template>
    <div>
      <header class="navbar navbar-header navbar-header-fixed">
          <inertia-link href="" id="mainMenuOpen" class="burger-menu"></inertia-link>
          <div class="navbar-brand">
              <inertia-link :href="route('acceuil')" class="df-logo">Admin<span>istration</span></inertia-link>

          </div>
          <div id="navbarMenu" class="navbar-menu-wrapper">
              <ul class="nav navbar-menu">
                <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none"> Main navigation</li>
                  <b-nav-item-dropdown text="Administration" class="nav-item">
                    <b-dropdown-item class="nav-sub-item">
                        <inertia-link :href="route('users')" class="nav-link">Utilisateurs</inertia-link>
                    </b-dropdown-item>
                  </b-nav-item-dropdown>
                  <b-nav-item-dropdown text="Paramètres" class="nav-item">
                       <b-dropdown-item class="nav-sub-item">
                           <inertia-link class="nav-link" :href="route('categories')">Modèles</inertia-link>
                       </b-dropdown-item>
                      <b-dropdown-item class="nav-sub-item">
                          <inertia-link :href="route('marques')" class="nav-link">Marques</inertia-link>
                      </b-dropdown-item>
                      <b-dropdown-item class="nav-sub-item">
                          <inertia-link :href="route('vehicules')" class="nav-link">Véhicules</inertia-link>
                      </b-dropdown-item>
                  </b-nav-item-dropdown>
                <li class="nav-item">
                    <inertia-link :href="route('articles')" class="nav-link">Actualités</inertia-link>
                </li>
                <li class="nav-item">
                    <inertia-link :href="route('lexiques')" class="nav-link">Lexiques</inertia-link>
                </li>
                <li class="nav-item">
                    <inertia-link :href="route('drives')" class="nav-link">Tests drives</inertia-link>
                </li>
                <li class="nav-item">
                    <inertia-link :href="route('offres')" class="nav-link">Offres</inertia-link>
                </li>
              </ul>

              <div class="dropdown dropdown-profile show">
                  <b-dropdown size="lg"  variant="link" toggle-class="text-decoration-none" no-caret class="dropdown-link" >
                      <template v-slot:button-content>
                          <i class="fas fa-users"><span class="sr-only">Compte</span></i>
                      </template>
                          <b-dropdown-text >
                              {{ $page.auth.user.last_name }} {{ $page.auth.user.first_name}}
                          </b-dropdown-text>
                          <b-dropdown-item >
                              <inertia-link :href="route('user.edit', $page.auth.user.id)">Modifier le profil</inertia-link>
                          </b-dropdown-item>
                          <b-dropdown-item >
                              <inertia-link :href="route('deconnexion')" method="post">Déconnexion</inertia-link>
                          </b-dropdown-item>

                  </b-dropdown>
              </div>

          </div>
      </header>
    </div>
</template>

<script>
    export default {
        props : {
            url : String
        },
        methods: {
            isUrl(...urls) {
                if (urls[0] === '') {
                    return this.url === ''
                }

                return urls.filter(url => this.url.startsWith(url)).length
            },
        },
    }
</script>

<style scoped>

</style>
