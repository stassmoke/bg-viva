<template>
  <div>
    <v-row justify="space-between">
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="ФІО"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="ІПН"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="Адреса прописки"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="Адреса проживання"></v-text-field>
      </v-col>
    </v-row>

    <v-row justify="space-between">
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" label="Контактний телефон"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="Місце роботи"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" label="Телефон з місця роботи"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="Середньомісячний дохід"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field label="Інші доходи"></v-text-field>
      </v-col>
    </v-row>

    <v-row justify="space-between">
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Рухоме майно у власності</h3>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
    </v-row>

    <v-row justify="space-between">
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Нерухоме майно</h3>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
    </v-row>

    <v-row justify="space-between">
      <v-col cols="12" sm="12" md="12">
        <v-radio-group v-model="MaritalStatus" row>
          <v-radio label="Одружений" value="married"></v-radio>
          <v-radio label="Не одружений" value="notMarried"></v-radio>
        </v-radio-group>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <h3 class="font-weight-medium">Кількісь утриманців (діти до 18 років)</h3>
        <v-text-field type="number" single-line></v-text-field>
      </v-col>
    </v-row>

    <v-row justify="space-between">
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Кредити в інших банках</h3>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
    </v-row>

    <v-row justify="space-between">
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Поручитель</h3>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-radio-group v-model="BailStatus" row>
          <v-radio label="Так" value="bail"></v-radio>
          <v-radio label="Ні" value="notBail"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>

    <v-row v-if="BailStatus === 'bail'">
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label="ФІО"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label="ІПН"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label="Адреса проживання"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label="Адреса проживання"></v-text-field>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Мета отримання кредиту</h3>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label single-line></v-text-field>
      </v-col>
    </v-row>

    <v-row justify="space-between" v-if="contractIs == true">
      <v-col cols="12" sm="12" md="12">
        <v-checkbox v-model="contractIs" :label="`Договір заключено`"></v-checkbox>
      </v-col>
    </v-row>

    <v-row justify="space-between">
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" label="Номер договору"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-menu
          ref="clientContractDateMenu"
          v-model="clientContractDateMenu"
          :close-on-content-click="false"
          :return-value.sync="clientContractDate"
          transition="scale-transition"
          offset-y
          min-width="290px"
        >
          <template v-slot:activator="{ on }">
            <v-text-field
              v-model="clientContractDate"
              label="Оберіть дату"
              prepend-icon="event"
              readonly
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker v-model="clientContractDate" no-title scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="clientContractDateMenu = false">Cancel</v-btn>
            <v-btn
              text
              color="primary"
              @click="$refs.clientContractDateMenu.save(clientContractDate)"
            >OK</v-btn>
          </v-date-picker>
        </v-menu>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" label="Сума договору"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" label="Відсоткова ставка"></v-text-field>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      BailStatus: "bail",
      MaritalStatus: "married",
      contractIs: true
    };
  }
};
</script>

<style>
</style>