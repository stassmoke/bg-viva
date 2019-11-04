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
        {
          text: "Dessert (100g serving)",
          align: "left",
          sortable: false,
          value: "name"
        },
        { text: "Calories", value: "calories" },
        { text: "Fat (g)", value: "fat" },
        { text: "Carbs (g)", value: "carbs" },
        { text: "Protein (g)", value: "protein" },
        { text: "Iron (%)", value: "iron" }
      ],
    };
  },
  computed: {
    ...mapGetters(['clients','clientSearch']),
  }
};
</script>