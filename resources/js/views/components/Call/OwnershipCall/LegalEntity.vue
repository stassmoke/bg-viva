<template>
  <div>
    <v-row>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="Назва Організації"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field
          type="number"
          oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
          maxlength="6"
          label="Код ЄДРПОУ"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="Контактна Особа"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="Посада"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" label="Номер Телефону"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" label="Додатковий телефон"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
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
          <v-date-picker v-model="callDate" no-title scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="callDateMenu = false">Cancel</v-btn>
            <v-btn text color="primary" @click="$refs.callDateMenu.save(callDate)">OK</v-btn>
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
      callDate: new Date().toISOString().substr(0, 10),
      callDateMenu: false
    };
  }
};
</script>

<style>
</style>