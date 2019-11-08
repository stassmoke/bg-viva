<template>
  <div>
    <v-data-table :headers="headers" :items="meetings" :items-per-page="5" :search="meetingSearch" class="elevation-1"></v-data-table>
  </div>
</template>
<script>

import { mapGetters } from "vuex";

export default {
    
  data() {
      
    return {
        
      headers: [
        { text: "Назва/ФІО", align: "left", sortable: false,value: "name" },
        { text: "Код", value: "legalCode" },
        { text: "Номер", value: "phoneNumber" },
        { text: "Дата зустрічі", value: "contractNumber" },
        { text: "Час зустрічі", value: "branchNumber" },
        { text: "Домовились з клієнтом про", value: "whatAgees" },
      ],
    };
  },
  computed: {
    ...mapGetters(['meetings','meetingSearch']),
  }
};
</script>