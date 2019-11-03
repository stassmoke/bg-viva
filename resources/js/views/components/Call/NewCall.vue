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

import LegalEntity from '../Call/OwnershipCall/LegalEntity';
import IndividualEntrepreneur from '../Call/OwnershipCall/IndividualEntrepreneur';
import IndividualClient from '../Call/OwnershipCall/IndividualClient';



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
    };
  }
};
</script>