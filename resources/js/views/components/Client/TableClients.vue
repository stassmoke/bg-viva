<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="clients"
            :items-per-page="clientsPerPage"
            :page="clientsPage"
            :search="clientSearch"
            :server-items-length="clientsTotal"
            class="elevation-1"
            :loading="!this.isLoadedClients"
            :footer-props="{
                'items-per-page-options': rowsPerPageItems
            }"
            loading-text="Loading... Please wait"
            @update:items-per-page="updatePerPage"
            @update:page="updatePage"
            @update:sort-by="updateSort"
            @update:sort-desc="updateIsSortDesc"
            :sort-by="[clientsSortBy]"
        >
            <template v-slot:body="{ items }">
                <tbody>
                <tr @click="edit(client)" v-for="client in items" :key="client.id">
                    <td>{{ getClientName(client) }}</td>
                    <td>{{ getClientCode(client) }}</td>
                    <td>{{ client.contract_number }}</td>
                    <td nowrap>{{ client.contract_date }}</td>
                    <td>{{ client.contract_sum }}</td>
                    <td>{{ client.contract_percent }}</td>
                    <td>{{ client.branch_code }}</td>
                </tr>
                </tbody>
            </template>
        </v-data-table>
    </div>
</template>
<script>
    import { mapGetters, mapActions, mapMutations } from "vuex";

    export default {
        data() {
            return {
                rowsPerPageItems: [10, 20, 30, 40, 50],
                headers: [
                    {
                        text: "Назва",
                        align: "left",
                        value: "name",
                    },
                    {
                        text: "Код ЄДРПОУ",
                        value: "code",
                    },
                    {
                        text: "Номер договору",
                        value: "clients.contract_number",
                    },
                    {
                        text: "Дата договору",
                        value: "clients.contract_date",
                    },
                    {
                        text: "Сума кредиту",
                        value: "clients.contract_sum",
                    },
                    {
                        text: "Відсоток кредиту",
                        value: "clients.contract_percent",
                    },
                    {
                        text: "Номер відділення",
                        value: "clients.branch_code",
                    },
                ],
            };
        },
        computed: {
            ...mapGetters([
                'clients',
                'clientSearch',
                'isLoadedClients',
                'clientsPerPage',
                'clientsPage',
                'clientsTotal',
                'clientsSortBy',
                'clientsSortDirection',
            ]),
        },
        methods: {
            ...mapActions(['getClients']),
            ...mapMutations([
                'updateClientsPerPage',
                'updateClientsPage',
                'updateClientLoaded',
                'updateClientsSort',
                'updateClientsSortDirection',
            ]),
            edit(client) {
                this.$router.push(`/clients/edit/${client.id}`);
            },
            getClientName(client) {
                return client.type === 3 ? client.individual.fio : client.legal_entry.name;
            },
            getClientCode(client) {
                return client.type === 3 ? client.individual.ipn : client.legal_entry.edrpou_code;
            },
            updatePerPage(perPage) {
                this.updateClientsPerPage(perPage);
                this.getClients();
            },
            updatePage(page) {
                this.updateClientsPage(page);
                this.getClients();
            },
            updateSort(field) {
                this.updateClientsSort(field[0]);
            },
            updateIsSortDesc(isDesc) {
                this.updateClientsSortDirection(isDesc[0] ? 'DESC' : 'ASC');
                this.getClients();
            }
        },
    };
</script>
