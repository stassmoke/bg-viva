<template>
  <div>
    <v-row class="justify-center">
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individual.fio" label="ФІО"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="individual.ipn"
          
          label="ІПН"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="individual.registration_address"
          label="Адреса прописки"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="individual.residence_address"
          label="Адреса проживання"
        ></v-text-field>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="individual.contact_phone"
          type="number"
          label="Контактний телефон"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individual.work_place" label="Місце роботи"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="individual.work_place_phone"
          type="number"
          label="Телефон з місця роботи"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="individual.average_monthly_income"
          label="Середньомісячний дохід"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="individual.another_income"
          label="Інші доходи"
        ></v-text-field>
      </v-col>
    </v-row>

    <v-row class="flex-column">
      <v-col cols="12" sm="12" md="12" class="d-flex align-center">
        <h3 class="font-weight-medium">Рухоме майно у власності</h3>
        <v-btn @click="$emit('addMovables')" class="mx-2" fab small dark color="primary">
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
      </v-col>
      <v-col
        cols="12"
        sm="4"
        md="4"
        class="d-flex align-center"
        v-for="(movable,index) in individual.movables"
        :key="movable.id"
      >
        <v-text-field v-model="movable.description" label="Рухоме майно у власності"></v-text-field>
        <v-btn @click="$emit('removeMovables',index)" class="mx-2" fab small dark color="primary">
          <v-icon dark>mdi-minus</v-icon>
        </v-btn>
      </v-col>
    </v-row>

    <v-row class="flex-column">
      <v-col cols="12" sm="12" md="12" class="d-flex align-center">
        <h3 class="font-weight-medium">Нерухоме майно</h3>
        <v-btn @click="$emit('addRealEstate')" class="mx-2" fab small dark color="primary">
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
      </v-col>
      <v-col
        v-for="(realEstate,index) in individual.real_estates"
        class="d-flex align-center"
        cols="12"
        sm="4"
        md="4"
        :key="realEstate.id"
      >
        <v-text-field v-model="realEstate.description" label="Нерухоме майно"></v-text-field>
        <v-btn @click="$emit('removeRealEstate',index)" class="mx-2" fab small dark color="primary">
          <v-icon dark>mdi-minus</v-icon>
        </v-btn>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" sm="12" md="12">
        <v-radio-group v-model="individual.is_married" row>
          <v-radio label="Одружений" :value="true"></v-radio>
          <v-radio label="Не одружений" :value="false"></v-radio>
        </v-radio-group>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Кількісь утриманців (діти до 18 років)</h3>
      </v-col>
      <v-col cols="12" sm="2" md="2">
        <v-select
          :items="numberDependents"
          label="Оберіть клькість"
          v-model="individual.dependents_count"
        ></v-select>
      </v-col>
    </v-row>

    <Credits
      :credits="credits"
      @addOtherCredit="$emit('addOtherCredit')"
      @removeOtherCredit="$emit('removeOtherCredit')"
    ></Credits>

    <v-row>
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Поручитель</h3>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-radio-group v-model="individual.is_have_guarantor" row>
          <v-radio label="Так" :value="true"></v-radio>
          <v-radio label="Ні" :value="false"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>

    <v-row v-if="individual.is_have_guarantor" class="flex-column">
      <v-col cols="4" sm="4" md="4">
        <v-text-field label="ФІО" v-model="individual.guarantor.fio"></v-text-field>
      </v-col>
      <v-col cols="4" sm="4" md="4">
        <v-text-field label="ІПН" v-model="individual.guarantor.ipn"></v-text-field>
      </v-col>
      <v-col cols="4" sm="4" md="4">
        <v-text-field label="Адреса проживання" v-model="individual.guarantor.registration_address"></v-text-field>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import Credits from "./Credits";
import { range } from "lodash";

export default {
  components: {
    Credits
  },
  props: {
    individual: {
      type: Object,
      required: true
    },
    credits: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      numberDependents: range(1, 11)
    };
  }
};
</script>
