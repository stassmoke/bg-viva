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
    import {mapGetters} from "vuex";

    export default {
        data() {
            return {
                headers: [
                    {text: "Назва/ФІО", align: "left", sortable: false, value: "name"},
                    {text: "Код", value: "legalCode"},
                    {text: "Номер", value: "phoneNumber"},
                    {text: "Дата зустрічі", value: "contractNumber"},
                    {text: "Час зустрічі", value: "branchNumber"},
                    {text: "Домовились з клієнтом про", value: "whatAgees"}
                ]
            };
        },
        computed: {
            ...mapGetters(["meetings", "meetingSearch"])
        },
        methods: {
            showAlert(a) {
                if (event.target.classList.contains("btn__content")) return;
                alert("Alert! \n" + a.name);
            }
        }
    };
</script>
