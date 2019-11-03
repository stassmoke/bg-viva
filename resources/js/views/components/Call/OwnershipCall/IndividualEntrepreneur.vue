<template>
  <div>

    <v-row>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="ФІО"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="ІПН"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" label="Мобільний номер телефону"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" label="Альтернативний номер телефону(Домашній /Робочий)"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
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
        <v-textarea name="input-7-1" label="Коментар" auto-grow></v-textarea>
      </v-col>
    </v-row>

    <v-row justify="space-between">
      <v-col cols="12" sm="2" md="2">
        <v-btn depressed color="primary">Зберегти</v-btn>
      </v-col>

      <v-col cols="12" sm="2" md="2">
        <v-btn depressed color="primary">Домовились про зустріч</v-btn>
      </v-col>
    </v-row>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      callFopDate: new Date().toISOString().substr(0, 10),
      callFopDateMenu: false
    };
  }
};
</script>

<style>
</style>