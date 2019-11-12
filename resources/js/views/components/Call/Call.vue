<template>
    <div>
        <v-container>
            <v-row class="justify-space-between align-center">
                <v-col cols="12" sm="8" md="8">
                    <v-btn
                        v-if="isCurrentRoute('calls')"
                        depressed
                        color="primary"
                        @click="$router.push({name: 'calls.new'})"
                    >Дзвінок новому клієнту
                    </v-btn>
                    <v-btn
                        v-if="!isCurrentRoute('calls')"
                        depressed
                        color="primary"
                        @click="$router.push({name: 'calls'})"
                    >Дзвінок Клієнту Існуючому
                    </v-btn>
                </v-col>
                <v-col cols="12" sm="3" md="3">
                    <v-text-field
                        @input="changeSearch()"
                        v-model="searchTableCall"
                        append-icon="search"
                        label="Введіть код або назву клієнта"
                        solo
                        hide-details
                    ></v-text-field>
                </v-col>
            </v-row>

            <v-card>
                <router-view></router-view>
            </v-card>
        </v-container>
    </div>
</template>

<script>
import { mapMutations, mapActions } from "vuex";

export default {
    data() {
        return {
            searchTableCall: ''
        };
    },
    methods: {
        ...mapActions(['getCalls']),
        ...mapMutations(["updateCallsSearch"]),
        changeSearch() {
            this.updateCallsSearch(this.searchTableCall);
            this.getCalls();

            if (!this.isCurrentRoute("calls")) {
                this.$router.push({name: "calls"});
            }
        },
        isCurrentRoute(route) {
            return this.$router.history.current.name === route;
        }
    }
};
</script>
