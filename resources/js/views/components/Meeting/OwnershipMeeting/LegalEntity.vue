<template>
  <div>
    <v-row class="justify-center">
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="clientLegal.name" label="Назва Організації"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          type="number"
          v-model="clientLegal.legalCode"
          oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
          maxlength="6"
          label="Код ЄДРПОУ"
          class="input-centered"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="clientLegal.contactPerson"
          label="Контактна Особа"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="clientLegal.position" label="Посада"></v-text-field>
      </v-col>

      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="clientLegal.phoneNumber"
          type="number"
          label="Номер Телефону"
        ></v-text-field>
      </v-col>

      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="clientLegal.secondPhone"
          type="number"
          label="Додатковий телефон"
        ></v-text-field>
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
          <v-date-picker locale="uk" class="input-centered" v-model="callDate" no-title scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="callDateMenu = false">Cancel</v-btn>
            <v-btn text color="primary" @click="$refs.callDateMenu.save(callDate)">OK</v-btn>
          </v-date-picker>
        </v-menu>
      </v-col>
      <v-col cols="12" sm="12" md="12" class="datepicker-centered">
        <v-menu
          ref="menu"
          v-model="menu2"
          :close-on-content-click="false"
          :nudge-right="40"
          :return-value.sync="callTime"
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="290px"
        >
          <template v-slot:activator="{ on }">
            <v-text-field
              v-model="callTime"
              label="Час дзвінка"
              prepend-icon="access_time"
              readonly
              v-on="on"
            ></v-text-field>
          </template>
          <v-time-picker
            format="24hr"
            v-if="menu2"
            v-model="callTime"
            full-width
            @click:minute="$refs.menu.save(callTime)"
          ></v-time-picker>
        </v-menu>
      </v-col>

      <v-col cols="12" sm="12" md="12">
        <v-textarea
          filled
          name="input-7-1"
          v-model="clientLegal.comment"
          class="input-centered"
          label="Коментар"
          auto-grow
        ></v-textarea>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  props: {
    clientLegal: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      callTime: null,
      menu2: false,
      modal2: false,
      callDate: new Date().toISOString().substr(0, 10),
      callDateMenu: false
    };
  }
};
</script>

<style>
</style>