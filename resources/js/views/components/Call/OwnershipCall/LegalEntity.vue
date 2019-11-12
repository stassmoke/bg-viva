<template>
  <div>
    <v-row class="justify-center">
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="legal.name" label="Назва Організації"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          type="number"
          v-model="legal.edrpou_code"
          oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
          maxlength="6"
          label="Код ЄДРПОУ"
          class="input-centered"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="legal.contact_person" label="Контактна Особа"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="legal.position" label="Посада"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-mask="mask" v-model="legal.phone" type="number" label="Номер Телефону"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered"  v-model="legal.landline_phone" type="number" label="Додатковий телефон"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12" class="datepicker-centered">
        <v-menu
          ref="callDate"
          v-model="callDateMenu"
          :close-on-content-click="false"
          :return-value.sync="callDate"
          transition="scale-transition"
          offset-y
          min-width="290px"
        >
          <template v-slot:activator="{ on }">
            <v-text-field
              v-model="callDate"
              label="Дата дзвінка"
              prepend-icon="event"
              readonly
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker class="input-centered"  v-model="callDate" no-title scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="callDateMenu = false">Cancel</v-btn>
            <v-btn text color="primary" @click="$refs.callDateMenu.save(callDate)">OK</v-btn>
          </v-date-picker>
        </v-menu>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-textarea name="input-7-1"  v-model="legal.comment" class="input-centered" label="Коментар" auto-grow filled></v-textarea>
      </v-col>
    </v-row>
    
  </div>
</template>

<script>
export default {
  props: {
    legal: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      mask: '###-###-##-##',
      callDate: new Date().toISOString().substr(0, 10),
      callDateMenu: false
    };
  }
};
</script>

<style>
</style>