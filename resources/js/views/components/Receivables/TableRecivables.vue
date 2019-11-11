<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="recivables"
            :items-per-page="recivablesPerPage"
            :page="recivablesPage"
            :search="recivableSearch"
            :server-items-length="recivablesTotal"
            class="elevation-1"
            :loading="!this.isLoadedRecivables"
            loading-text="Loading... Please wait"
            @update:items-per-page="updatePerPage"
            @update:page="updatePage"
            @update:sort-by="updateSort"
            @update:sort-desc="updateIsSortDesc"
            :sort-by="[recivablesSortBy]"
        >
            <template v-slot:body="{ items }">
                <tbody>
                <tr @click="edit(recivable)" v-for="recivable in items" :key="recivable.id">
                    <td>{{ (getRecivableNamerecivable) }}</td>
                    <td>{{ (getRecivableCoderecivable) }}</td>
                    <td>{{recivable.contract_number }}</td>
                    <td nowrap>{{recivable.contract_date }}</td>
                    <td>{{recivable.contract_sum }}</td>
                    <td>{{recivable.contract_percent }}</td>
                    <td>{{recivable.branch_code }}</td>
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
                headers: [
                    {
                        text: "Назва",
                        align: "left",
                        value: "name",
                    },
                    {
                        text: "Код/Номер договору",
                        value: "code",
                    },
                    {
                        text: "Дата договору",
                        value: "recivables.contract_number",
                    },
                    {
                        text: "Сума договору",
                        value: "recivables.contract_sum",
                    },
                    {
                        text: "Відсоток кредиту",
                        value: "recivables.contract_percent",
                    },
                ],
            };
        },
        computed: {
            ...mapGetters([
                'recivables',
                'recivableSearch',
                'isLoadedRecivables',
                'recivablesPerPage',
                'recivablesPage',
                'recivablesTotal',
                'recivablesSortBy',
                'recivablesSortDirection',
            ]),
        },
        methods: {
            ...mapActions(['getRecivables']),
            ...mapMutations([
                'updateRecivablesPerPage',
                'updateRecivablesPage',
                'updateRecivableLoaded',
                'updateRecivablesSort',
                'updateRecivablesSortDirection',
            ]),
            edit(recivable) {
                this.$router.push(`/recivables/edit/${recivable.id}`);
            },
            getRecivableName(recivable) {
                return recivable.type === 3 ? recivable.individual.fio : recivable.legal_entry.name;
            },
            getRecivableCode(recivable) {
                return recivable.type === 3 ? recivable.individual.ipn : recivable.legal_entry.edrpou_code;
            },
            updatePerPage(perPage) {
                this.updateRecivablesPerPage(perPage);
                this.getRecivables();
            },
            updatePage(page) {
                this.updateRecivablesPage(page);
                this.getRecivables();
            },
            updateSort(field) {
                this.updateRecivablesSort(field[0]);
            },
            updateIsSortDesc(isDesc) {
                this.updateRecivablesSortDirection(isDesc[0] ? 'DESC' : 'ASC');
                this.getRecivables();
            }
        },
    };
</script>
