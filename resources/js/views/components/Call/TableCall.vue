<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="calls"
            :items-per-page="callsPerPage"
            :page="callsPage"
            :search="callsSearch"
            :server-items-length="callsTotal"
            class="elevation-1"
            :loading="!this.isLoadedCalls"
            :footer-props="{
                'items-per-page-options': rowsPerPageItems
            }"
            loading-text="Loading... Please wait"
            @update:items-per-page="updatePerPage"
            @update:page="updatePage"
            @update:sort-by="updateSort"
            @update:sort-desc="updateIsSortDesc"
            :sort-by="[callsSortBy]"
        ></v-data-table>
    </div>
</template>
<script>

    import {mapGetters, mapActions, mapMutations} from "vuex";

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
                        text: "Номер телефону",
                        value: "phone",
                    },
                    {
                        text: "Контактна особа",
                        value: "contact_name",
                    },
                ],
            };
        },
        computed: {
            ...mapGetters([
                'calls',
                'callsSearch',
                'isLoadedCalls',
                'callsPerPage',
                'callsPage',
                'callsTotal',
                'callsSortBy',
                'callsSortDirection',
            ]),
        },
        methods: {
            ...mapActions(['getCalls']),
            ...mapMutations([
                'updateCallsPerPage',
                'updateCallsPage',
                'updateCallsLoaded',
                'updateCallsSort',
                'updateCallsSortDirection',
            ]),
            edit(call) {
                this.$router.push(`/calls/edit/${call.id}`);
            },
            getClientName(call) {
                return call.type === 3 ? call.name : call.contact_name;
            },
            getClientCode(call) {
                return call.type === 3 ? call.ipn : call.edrpou_code;
            },
            updatePerPage(perPage) {
                this.updateCallsPerPage(perPage);
                this.getCalls();
            },
            updatePage(page) {
                this.updateCallsPage(page);
                this.getCalls();
            },
            updateSort(field) {
                this.updateCallsSort(field[0]);
            },
            updateIsSortDesc(isDesc) {
                this.updateCallsSortDirection(isDesc[0] ? 'DESC' : 'ASC');
                this.getCalls();
            }
        },
    };
</script>
