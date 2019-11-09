<template>
    <div>
        <v-app id="inspire">
            <app-navigation></app-navigation>

            <app-header></app-header>

            <app-footer></app-footer>

            <v-content>
                <router-view></router-view>
            </v-content>
        </v-app>
    </div>
</template>


<script>
    import AppFooter from "./components/AppFooter";
    import AppHeader from "./components/AppHeader";
    import AppNavigation from "./components/AppNavigation";


    export default {
        components: {
            AppHeader,
            AppFooter,
            AppNavigation
        },
    };
</script>
