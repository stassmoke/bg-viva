<template>
  <div>
    <v-row class="justify-center">
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.name" label="ФІО"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.Ipn" label="ІПН"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="individualClient.mobileNumber"
          type="number"
          label="Мобільний номер телефону"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field
          class="input-centered"
          v-model="individualClient.alternateNumber"
          type="number"
          label="Альтернативний номер телефону(Домашній /Робочий)"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12" class="datepicker-centered">
        <v-menu
          ref="callFopDate"
          v-model="callFopDateMenu"
          :close-on-content-click="false"
          :return-value.sync="callFopDate"
          transition="scale-transition"
          offset-y
          min-width="290px"
        >
          <template v-slot:activator="{ on }">
            <v-text-field
              v-model="callFopDate"
              label="Дата дзвінка"
              prepend-icon="event"
              readonly
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker locale="uk" v-model="callFopDate" no-title scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="callFopDateMenu = false">Cancel</v-btn>
            <v-btn text color="primary" @click="$refs.callFopDateMenu.save(callFopDate)">OK</v-btn>
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
          class="input-centered"
          v-model="individualClient.commet"
          name="input-7-1"
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
    individualClient: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      callTime: null,
      menu2: false,
      modal2: false,
      callFopDate: new Date().toISOString().substr(0, 10),
      callFopDateMenu: false
    };
  }
};
</script>

<style>
</style>