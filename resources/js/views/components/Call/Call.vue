<template>
  <div>
    <v-container>
      <v-row class="justify-space-between align-center">
        <v-col cols="12" sm="8" md="8">
          <v-btn depressed color="primary" v-on:click="newCall = true">Дзвінок новому клієнту</v-btn>
          <v-btn depressed color="primary" v-on:click="newCall = false">Дзвінок Клієнту Існуючому</v-btn>
        </v-col>
        <v-col cols="12" sm="3" md="3">
          <v-text-field
            v-model="searchTableCall"
            append-icon="search"
            label="Введіть код або назву клієнта"
            solo
            hide-details
          ></v-text-field>
        </v-col>
      </v-row>

      <v-card>
        <NewCall v-if="newCall"></NewCall>
        <TableCall v-else></TableCall>
      </v-card>

    </v-container>
  </div>
</template>

<script>

import NewCall from '../Call/NewCall';
import TableCall from '../Call/TableCall';

export default {
    components: {
        NewCall,
        TableCall
  },
    data() {
        return {
            newCall: true,
            searchTableCall: '',
        }
    }
};

</script>
