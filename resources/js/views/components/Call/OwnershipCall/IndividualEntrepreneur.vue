<template>
  <div>

    <v-row class="justify-center">
      <v-col cols="12" sm="12" md="12">
        <v-text-field v-model="individualEntrepreneur.name"  class="input-centered" label="ФІО"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field v-model="individualEntrepreneur.Ipn" label="ІПН" class="input-centered"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field v-model="individualEntrepreneur.mobileNumber" type="number" label="Мобільний номер телефону" class="input-centered"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field v-model="individualEntrepreneur.alternateNumber" type="number" label="Альтернативний номер телефону(Домашній /Робочий)" class="input-centered"></v-text-field>
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
          <v-date-picker v-model="callFopDate" no-title scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="callFopDateMenu = false">Cancel</v-btn>
            <v-btn text color="primary" @click="$refs.callFopDateMenu.save(callFopDate)">OK</v-btn>
          </v-date-picker>
        </v-menu>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-textarea v-model="individualEntrepreneur.commet" name="input-7-1" label="Коментар" class="input-centered" auto-grow></v-textarea>
      </v-col>
    </v-row>
    
  </div>
</template>

<script>
export default {
   props: {
    individualEntrepreneur: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      callFopDate: new Date().toISOString().substr(0, 10),
      callFopDateMenu: false
    };
  }
};
</script>