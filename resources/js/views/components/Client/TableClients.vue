<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="clients"
            :items-per-page="5"
            :search="clientSearch"
            class="elevation-1"
        >
            <template v-slot:body="{ items }">
                <tbody>
                <tr @click="edit(client)" v-for="client in items" :key="client.id">
                    <td>{{ getClientName(client) }}</td>
                    <td>{{ client.contract_number }}</td>
                    <td>{{ client.branch_code }}</td>
                </tr>
                </tbody>
            </template>
        </v-data-table>
    </div>
</template>
<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
        data() {
            return {
                headers: [
                    {
                        text: "Назва",
                        align: "left",
                        sortable: false,
                        value: "name",
                    },
                    {
                        text: "Номер договору",
                        value: "contract_number",
                    },
                    {
                        text: "Номер відділення",
                        value: "branch_code",
                    },
                ],
            };
        },
        computed: {
            ...mapGetters(['clients', 'clientSearch','isLoadedClients']),
        },
        mounted() {
            if (this.isLoadedClients === false) {
                this.getClients();
            }
        },
        methods: {
            ...mapActions(['getClients']),
            edit(client) {
                this.$router.push(`/clients/edit/${client.id}`);
            },
            getClientName(client) {
                return client.type === 3 ? client.individual.fio : client.legal_entry.name;
            },
        },
    };
</script>
