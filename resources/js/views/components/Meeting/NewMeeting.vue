<template>
  <div>
    <v-container>
      <v-row class="d-flex justify-space-between align-center">
        <v-col cols="12" sm="7" md="7">
          <v-radio-group v-model="personChoice" row>
            <v-radio label="Юридична особа" value="legalEntity"></v-radio>
            <v-radio label="Фізична особа підприємець" value="IndividualEntrepreneur"></v-radio>
            <v-radio label="Фізична особа" value="individual"></v-radio>
          </v-radio-group>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field label="Код відділення яке створює"></v-text-field>
        </v-col>
      </v-row>

      <LegalEntity :clientLegal="clientLegal" v-if="personChoice === 'legalEntity'"></LegalEntity>
      <IndividualEntrepreneur :individualEntrepreneur="individualEntrepreneur" v-else-if="personChoice === 'IndividualEntrepreneur'"></IndividualEntrepreneur>
      <IndividualClient :individualClient="individualClient" v-else></IndividualClient>

      <v-row class="justify-space-between align-center">
        <v-col  class="d-flex justify-start" cols="12" sm="6" md="6">
          <v-btn depressed color="primary" @click="submitForm()">Зберегти</v-btn>
        </v-col>

        <v-col class="d-flex justify-end" cols="12" sm="6" md="6">
           <v-radio-group v-model="whatAgees" column>
              <v-radio label="Клієнт погодився на кредит" value="agreed"></v-radio>
              <v-radio label="Клієнт обдумає пропозицію і йому необхідно передзвонити" value="clientConsidering"></v-radio>
              <v-radio label="Збір документів" value="collectionDocuments"></v-radio>
           </v-radio-group>
        </v-col>
      </v-row>
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
      personChoice: 'legalEntity',

      whatAgees: '',

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
    ...mapActions(['addMeeting']),
    submitForm() {
      const metting = {
          name: this.clientLegal.name,
          code: this.clientLegal.legalCode,
          contractNumber: this.clientLegal.contractNumber,
          branchNumber: this.clientLegal.branchNumber

          // PersonChoice: this.PersonChoice,
        };

      this.addMeeting(metting);
    }
  }

};
</script>