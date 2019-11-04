<template>
  <div>
    <v-container>
      <v-row justify="space-between">
        <v-col cols="12" sm="3" md="3">
          <v-radio-group v-model="PersonChoice" row>
            <v-radio label="Юридична особа" value="legalEntity"></v-radio>
            <v-radio label="Фізична особа підприємець" value="IndividualEntrepreneur"></v-radio>
            <v-radio label="Фізична особа" value="individual"></v-radio>
          </v-radio-group>
        </v-col>
        <v-col cols="12" sm="3" md="3">
          <v-text-field label="Код відділення яке створює"></v-text-field>
        </v-col>
      </v-row>

      <LegalEntity v-if="PersonChoice === 'legalEntity'"></LegalEntity>
      <IndividualEntrepreneur v-else-if="PersonChoice === 'IndividualEntrepreneur'"></IndividualEntrepreneur>
      <IndividualClient v-else></IndividualClient>
    </v-container>
  </div>
</template>

<script>

import LegalEntity from '../Meeting/OwnershipMeeting/LegalEntity'; 
import IndividualEntrepreneur from '../Meeting/OwnershipMeeting/IndividualEntrepreneur';
import IndividualClient from '../Meeting/OwnershipMeeting/IndividualClient';
import { mapActions } from 'vuex';

export default {
  components: {
    LegalEntity, 
    IndividualClient,
    IndividualEntrepreneur
  },
  data() {
    return {
      checkbox: false,
      checkbox2: false,

      PersonChoice: 'legalEntity',
      legal: {
        name: null,
      }
    };
  },
//   methods: {
//     ...mapActions(['addClient']),
//     submitForm() {
//       const client = {
//           name: this.legal.name,
//           calories: 237,
//           fat: 9.0,
//           carbs: 37,
//           protein: 4.3,
//           iron: "1%",
//           PersonChoice: this.PersonChoice,
//         };

//       this.addClient(client);
//     }
//   }
};
</script>