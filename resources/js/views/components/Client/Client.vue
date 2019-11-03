<template>
  <div>
    <v-container>
      <v-row justify="space-between">
        <v-col cols="12" sm="8" md="8">
          <v-btn depressed color="primary" v-on:click="newClient = true">Новий Клієнт</v-btn>
          <v-btn depressed color="primary" v-on:click="newClient = false">Існуючий Клієнт</v-btn>
        </v-col>
        <v-col cols="12" sm="3" md="3">
          <v-text-field v-model="searchTableClient" append-icon="search" label="Введіть код або назву клієнта" solo hide-details></v-text-field>
        </v-col>
      </v-row>
      
      <v-card>
        <NewClient v-if="newClient"></NewClient>
        <TableClients v-else></TableClients>
      </v-card>
    </v-container>
  </div>
</template>

<script>

import NewClient from '../Client/NewClient';
import TableClients from '../Client/tableClients';


export default {
  components: {
    NewClient,
    TableClients
  },
  data() {
    return {
      searchTableClient: '',
      newClient: true,
    };
  }
};
</script>
