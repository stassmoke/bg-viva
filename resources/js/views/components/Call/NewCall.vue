<template>
  <div>
    <v-container>
      <v-row class="d-flex justify-space-between align-center">
        <v-col cols="12" sm="7" md="7">
          <v-radio-group v-model="PersonChoice" row>
            <v-radio label="Юридична особа" value="legalEntity"></v-radio>
            <v-radio label="Фізична особа підприємець" value="IndividualEntrepreneur"></v-radio>
            <v-radio label="Фізична особа" value="individual"></v-radio>
          </v-radio-group>
        </v-col>
        <v-col cols="12" sm="3" md="3">
          <v-text-field v-model="branchNumber" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" label="Код відділення яке створює"></v-text-field>
        </v-col>
      </v-row>

      <LegalEntity :clientLegal="clientLegal" v-if="PersonChoice === 'legalEntity'"></LegalEntity>
      <IndividualEntrepreneur :individualEntrepreneur="individualEntrepreneur" v-else-if="PersonChoice === 'IndividualEntrepreneur'"></IndividualEntrepreneur>
      <IndividualClient :individualClient="individualClient" v-else></IndividualClient>
    
      <v-row class="justify-space-between align-center">
        <v-col  class="d-flex justify-start" cols="12" sm="6" md="6">
          <v-btn depressed color="primary" @click="submitForm()">Зберегти</v-btn>
        </v-col>

        <v-col class="d-flex justify-end" cols="12" sm="6" md="6">
          <v-btn depressed color="primary" v-on:click="$router.push('/meetings/')">Домовились про зустріч</v-btn>
        </v-col>
      </v-row>

    </v-container>
  </div>
</template>

<script>

import LegalEntity from '../Call/OwnershipCall/LegalEntity';
import IndividualEntrepreneur from '../Call/OwnershipCall/IndividualEntrepreneur';
import IndividualClient from '../Call/OwnershipCall/IndividualClient';
import { mapActions } from 'vuex';


export default {
  components: {
    LegalEntity,
    IndividualClient,
    IndividualEntrepreneur
  },
  data() {
    return {
      PersonChoice: 'legalEntity',

      branchNumber: null,

      clientLegal: {
        name: null,
        legalCode: null,
        contactPerson: null,
        position: null,
        phoneNumber: null,
        secondPhone: null,
        comment: null
      },

      individualClient: {
        name: null,
        Ipn: null,
        mobileNumber: null,
        alternateNumber: null,
        comment: null,
      },

      individualEntrepreneur: {
        name: null,
        Ipn: null,
        mobileNumber: null,
        alternateNumber: null,
        comment: null,
      },
    };
  },
  methods: {
    ...mapActions(['addCalls']),
    submitForm() {
      const call = {
          name: this.clientLegal.name,
          code: this.clientLegal.legalCode,
          contractNumber: this.clientLegal.contractNumber,
          branchNumber: this.clientLegal.branchNumber

          // PersonChoice: this.PersonChoice,
        };

      this.addCalls(call);
    }
  }
};
</script>