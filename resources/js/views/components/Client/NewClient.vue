<template>
  <div>
    <v-container>
      <v-row class="d-flex justify-space-between align-center">
        <v-col cols="12" sm="7" md="7">
          <v-radio-group v-model="personChoice" class="d-flex align-center no-mess" row>
            <v-radio label="Юридична особа" value="legalEntity"></v-radio>
            <v-radio label="Фізична особа підприємець" value="IndividualEntrepreneur"></v-radio>
            <v-radio label="Фізична особа" value="IndividualClient"></v-radio>
          </v-radio-group>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field v-model="clientLegal.branchNumber" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" label="Код відділення яке створює"></v-text-field>
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
          <v-btn depressed color="primary" v-on:click="$router.push('/clients/')">Таблиця клієнтів</v-btn>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>

import LegalEntity from '../Client/OwnershipClient/LegalEntity';
import IndividualEntrepreneur from '../Client/OwnershipClient/IndividualEntrepreneur';
import IndividualClient from '../Client/OwnershipClient/IndividualClient';
import { mapActions } from 'vuex';

export default {
  components: {
    LegalEntity,
    IndividualClient,
    IndividualEntrepreneur
  },
  data() {
    return {

      personChoice: 'IndividualClient',

      individualEntrepreneur: {
        name: null,
        legalCode: null,
        legalAdress: null,
        actualAdress: null,
        contactPerson: null,
        position: null,
        phoneNumber: null,
        phoneLandline: null,
        individualsParticipating: null,
        legalParticipating: null,
        mainActivity: null,
        creditOther: null,
        equipmentOwneredEnterprise: null,
        netSalesRevenue: null,
        carryingAmount: null,
        clientBalanceDate: new Date().toISOString().substr(0, 10),
        clientBalanceDateMenu: false,
        clientPayablesDate: new Date().toISOString().substr(0, 10),
        clientPayablesDateMenu: false,
        clientReceivablesDate: new Date().toISOString().substr(0, 10),
        clientReceivablesDateMenu: false,   
        clientContractDate: new Date().toISOString().substr(0, 10),
        clientContractDateMenu: false,
        payables: null,
        receivables: null,
        purposeCredit: null,
        contractNumber: null,
        amountContract: null,
        interestRate: null,
        branchNumber: null

      },
      clientLegal: {
        name: null,
        legalCode: null,
        legalAdress: null,
        actualAdress: null,
        contactPerson: null,
        position: null,
        phoneNumber: null,
        phoneLandline: null,
        individualsParticipating: null,
        legalParticipating: null,
        mainActivity: null,
        creditOther: null,
        equipmentOwneredEnterprise: null,
        netSalesRevenue: null,
        carryingAmount: null,
        clientBalanceDate: new Date().toISOString().substr(0, 10),
        clientBalanceDateMenu: false,
        clientPayablesDate: new Date().toISOString().substr(0, 10),
        clientPayablesDateMenu: false,
        clientReceivablesDate: new Date().toISOString().substr(0, 10),
        clientReceivablesDateMenu: false,   
        clientContractDate: new Date().toISOString().substr(0, 10),
        clientContractDateMenu: false,
        payables: null,
        receivables: null,
        purposeCredit: null,
        contractNumber: null,
        amountContract: null,
        interestRate: null,
        branchNumber: null
      },
      individualClient: {
        name: null,
        ipn: null,
        registrationAddress: null,
        residenceAddress: null,
        contactPhone: null,
        workPlace: null,
        phoneInWorkPlace: null,
        averageMonthlyIncome: null,
        otherIncome: null,
        movablePropertyOwned: null,
        realEstate: null,
        maritalStatus: null,
        numberDependents: null,
        creditInOtherBanks: null,
        bailName: null,
        bailIpn: null,
        bailAdress: null,
        purposeCredit: null,
        contractNumber: null,
        clientContractDate: new Date().toISOString().substr(0, 10),
        clientContractDateMenu: false,
        amountContract: null,
        interestRate: null,
        branchNumber: null
      }
    };
  },
  methods: {
    ...mapActions(['addClient']),
    submitForm() {
      const client = {
          name: this.clientLegal.name,
          code: this.clientLegal.legalCode,
          contractNumber: this.clientLegal.contractNumber,
          branchNumber: this.clientLegal.branchNumber

          // PersonChoice: this.PersonChoice,
        };

      this.addClient(client);
    }
  }
};
</script>