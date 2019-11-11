<template>
  <div>
    <v-container>
      <v-row class="justify-end align-center">
        <v-col cols="12" sm="3" md="3">
          <v-text-field
            @input="changeSearch()"
            v-model="searchTableReceivable"
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
import { mapMutations, mapActions } from "vuex";


export default {
  data() {
    return {
      searchTableCall: ""
    };
  },
  methods: {
    ...mapActions(["getReceivables"]),
    ...mapMutations(["updateReceivableSearch"]),
    changeSearch() {
      this.updateReceivableSearch(this.searchTableReceivables);
      this.getReceivable();

      if (!this.isCurrentRoute("receivables")) {
        this.$router.push({ name: "receivables" });
      }
    },
    isCurrentRoute(route) {
      return this.$router.history.current.name === route;
    }
  }
};
</script>
