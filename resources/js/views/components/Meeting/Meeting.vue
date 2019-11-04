
<template>
  <div>
    <v-container>
      <v-row class="justify-space-between align-center">
        <v-col cols="12" sm="8" md="8">
          <v-btn depressed color="primary" v-on:click="$router.push('/meetings/new')">Зустріч клієнт існуючий</v-btn>
          <v-btn depressed color="primary" v-on:click="$router.push('/meetings/')">Зустріч новий клієнт</v-btn>
        </v-col>
        <v-col cols="12" sm="3" md="3">
          <v-text-field @input="changeSearch()" v-model="searchTableClient" append-icon="search" label="Введіть код або назву клієнта" solo hide-details></v-text-field>
        </v-col>
      </v-row>

      <v-card>
        <router-view></router-view>
      </v-card>
    </v-container>
    </div>
</template>

<script>

import { mapMutations } from "vuex";

export default {
  data() {
    return {
      searchTableClient: '',
    };
  },
  methods: {
    ...mapMutations(['updateClientSearch']),
    changeSearch() {
      this.updateClientSearch(this.searchTableMeeting);
    }
  }
};
</script>