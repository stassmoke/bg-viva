<template>
  <div>
    <v-data-table :headers="headers" :items="calls" :items-per-page="5" class="elevation-1" :search="callSearch"></v-data-table>
  </div>
</template>
<script>

import { mapGetters } from "vuex";

export default {

  data() {
      
    return {
        
      headers: [
        { text: "Назва", align: "left", sortable: false,value: "name" },
        { text: "Код ЄДРПОУ/ІПН", value: "legalCode" },
        { text: "Номер телефону", value: "phoneNumber" },
        { text: "Контактна особа", value: "contactPerson" },
      ],
    };
  },
  computed: {
    ...mapGetters(['calls','callSearch']),
  }
};
</script>