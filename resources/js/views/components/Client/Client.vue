<template>
    <div>
        <v-container>
            <v-row class="justify-space-between align-center">
                <v-col cols="12" sm="8" md="8">
                    <v-btn
                        v-if="isCurrentRoute('clients')"
                        depressed
                        color="primary"
                        @click="$router.push({name: 'clients.new'})"
                    >
                        Новий Клієнт
                    </v-btn>
                    <v-btn
                        v-if="!isCurrentRoute('clients')"
                        depressed
                        color="primary"
                        @click="$router.push({name: 'clients'})"
                    >
                        Існуючий Клієнт
                    </v-btn>
                </v-col>
                <v-col cols="12" sm="3" md="3">
                    <v-text-field
                        @input="changeSearch()"
                        v-model="searchTableClient"
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
    import { mapMutations, mapActions } from 'vuex';

    export default {
        data() {
            return {
                searchTableClient: ''
            };
        },
        methods: {
            ...mapActions(['getClients']),
            ...mapMutations([
                'updateClientSearch',
            ]),
            changeSearch() {
                this.updateClientSearch(this.searchTableClient);
                this.getClients();

                if (!this.isCurrentRoute('clients')) {
                    this.$router.push({ name: 'clients' });
                }
            },
            isCurrentRoute(route) {
                return this.$router.history.current.name === route;
            }
        }
    };
</script>
