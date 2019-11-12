<template>
  <div>
    <v-container>
      <v-row class="d-flex justify-space-between align-center">
        <v-col cols="12" sm="7" md="7">
          <v-radio-group v-model.number="call.type" class="d-flex align-center no-mess" row>
            <v-radio label="Юридична особа" :value="legalType"></v-radio>
            <v-radio label="Фізична особа підприємець" :value="individualEntrepreneurType"></v-radio>
            <v-radio label="Фізична особа" :value="individualType"></v-radio>
          </v-radio-group>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field
            v-model="call.branch_code"
            maxlength="3"
            oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            type="number"
            label="Код відділення яке створює"
          ></v-text-field>
        </v-col>
      </v-row>

      <LegalEntity
        @addOtherCredit="addOtherCredit"
        @removeOtherCredit="removeOtherCredit"
        @addEquipment="addEquipment"
        @removeEquipment="removeEquipment"
        @addActivity="addActivity"
        @removeActivity="removeActivity"
        @addPerson="addPerson"
        @removePerson="removePerson"
        @addIndividualPerson="addIndividualPerson"
        @removeIndividualPerson="removeIndividualPerson"
        :legal="call.legal_entry"
        v-if="call.type === 1 || call.type === 2"
      ></LegalEntity>

      <IndividualClient
        @addOtherCredit="addOtherCredit"
        @removeOtherCredit="removeOtherCredit"
        @addRealEstate="addRealEstate"
        @removeRealEstate="removeRealEstate"
        @addMovables="addMovables"
        @removeMovables="removeMovables"
        :individual="call.individual"
        v-else
      ></IndividualClient>


      <v-row>
        <v-col cols="12" class="d-flex justify-space-between align-center">
          <v-btn depressed color="primary" @click="submitForm()">Зберегти</v-btn>
          <v-btn depressed color="primary" @click="$router.push('/calls/')">Таблиця дзвінків</v-btn>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import LegalEntity from "../Call/OwnershipCall/LegalEntity";
import IndividualClient from "../Call/OwnershipCall/IndividualClient";

import { mapActions } from "vuex";

export default {
  name: "CreateEditCall",
  components: {
    LegalEntity,
    IndividualClient,
    
  },
  data() {
    return {
      legalType: 1,
      individualEntrepreneurType: 2,
      individualType: 3,

      call: {
        id: null,
        type: 1,
        branch_code: null,
        credit_meta: null,
        is_contract_concluded: false,
        contract_number: null,
        contract_date: null,
        contract_sum: null,
        contract_percent: null,

        individual: {
          fio: null,
          ipn: null,
          contact_phone: null,
          alternate_number: null,
          comment: null,
          average_monthly_income: null,
          another_income: null,
          dependents_count: 0,
          is_have_guarantor: true,
          guarantor: {
            fio: null,
            ipn: null,
            registration_address: null
          },
        },
        legal_entry: {
          id: null,
          name: null,
          edrpou_code: null,
          position: null,
          phone: null,
          comment: null,
          landline_phone: null,
        },
        other_bank_credits: [],
      }
    };
  },
  mounted() {
    const callID = this.$route.params.id;

    if (callID) {
      this.findcall(callID).then(call => {
        this.call = call;
      });
    }
  },
  methods: {
    ...mapActions(["findCall", "updateCall", "addCall"]),
    submitForm() {
      if (this.call.id === null) {
        this.addCall(this.call).then(() => {
          this.$router.push("/calls/");
        });
      } else {
        this.updateCall(this.call).then(() => {
          this.$router.push("/calls/");
        });
      }
    },
    addRealEstate() {
      this.call.individual.real_estates.push({
        id: null,
        description: null
      });
    },
    addMovables() {
      this.call.individual.movables.push({
        id: null,
        description: null
      });
    },
    addOtherCredit() {
      this.call.other_bank_credits.push({
        id: null,
        name: null,
        sum: null,
        date: null
      });
    },
    addEquipment() {
      this.call.legal_entry.equipment.push({
        id: null,
        description: null
      });
    },
    addPerson() {
      this.call.legal_entry.persons.push({
        id: null,
        description: null
      });
    },
    addIndividualPerson() {
      this.call.legal_entry.individual_persons.push({
        id: null,
        description: null
      });
    },
    addActivity() {
      this.call.legal_entry.activities.push({
        id: null,
        description: null
      });
    },
    removeOtherCredit(index) {
      this.call.other_bank_credits.splice(index, 1);
    },
    removeEquipment(index) {
      this.call.legal_entry.equipment.splice(index, 1);
    },
    removeActivity(index) {
      this.call.legal_entry.activities.splice(index, 1);
    },
    removePerson(index) {
      this.call.legal_entry.persons.splice(index, 1);
    },
    removeIndividualPerson(index) {
      this.call.legal_entry.individual_persons.splice(index, 1);
    },
    removeRealEstate(index) {
      this.call.individual.real_estates.splice(index, 1);
    },
    removeMovables(index) {
      this.call.individual.movables.splice(index, 1);
    }
  }
};
</script>
