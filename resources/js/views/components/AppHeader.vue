<template>
    <v-app-bar app color="primary" dark>
        <v-icon @click.stop="toggleNav()" left>menu</v-icon>
        <v-toolbar-title>Viva Capital BD</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
            <v-btn v-if="!isAuthenticated" @click="toPage('login')" text>
                <v-icon left>logout</v-icon>
                Вход
            </v-btn>
            <v-btn v-if="isAuthenticated" @click.prevent="onLogout" text>
                <v-icon left>logout</v-icon>
                Выход
            </v-btn>
            <v-btn v-if="!isAuthenticated" @click="toPage('register')" text>
                <v-icon left>how_to_reg</v-icon>
                Регистрация
            </v-btn>
        </v-toolbar-items>
    </v-app-bar>
</template>

<script>
    import { mapMutations, mapGetters, mapActions } from "vuex";

    export default {
        computed: {
            ...mapGetters(['user', 'isAuthenticated']),
        },
        methods: {
            ...mapMutations(['toggleNav']),
            toPage(name) {
                this.$router.push({name: name});
            },
            ...mapActions(['logout']),
            onLogout: function () {
                this.logout().then(() => {
                    this.toPage('login');
                });
            }
        }
    };
</script>
