<template>
  <div>
    <v-data-table :headers="headers" :items="clients" :items-per-page="5" :search="clientSearch" class="elevation-1"></v-data-table>
  </div>
</template>
<script>

import { mapGetters } from "vuex";

export default {
    
  data() {
      
    return {
        
      headers: [
        { text: "Назва", align: "left", sortable: false,value: "name" },
        { text: "Код", value: "code" },
        { text: "Номер договору", value: "contractNumber" },
        { text: "Номер відділення", value: "branchNumber" },
      ],
    };
  },
  computed: {
    ...mapGetters(['clients','clientSearch']),
  }
};
</script>