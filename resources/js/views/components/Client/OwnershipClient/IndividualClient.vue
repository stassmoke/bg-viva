<template>
  <div>
    <v-row class="justify-center">
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.name" label="ФІО"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.ipn" label="ІПН"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.registrationAddress" label="Адреса прописки"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.residenceAddress" label="Адреса проживання"></v-text-field>
      </v-col>
    </v-row>

    <v-row >
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.contactPhone" type="number" label="Контактний телефон"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.workPlace" label="Місце роботи"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.phoneInWorkPlace" type="number" label="Телефон з місця роботи"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.averageMonthlyIncome" label="Середньомісячний дохід"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field class="input-centered" v-model="individualClient.otherIncome" label="Інші доходи"></v-text-field>
      </v-col>
    </v-row>

    <v-row >
      <v-col cols="12" sm="12" md="12" class="d-flex align-center">
        <h3 class="font-weight-medium">Рухоме майно у власності</h3>
        <v-btn @click="addRow2" class="mx-2" fab small dark color="primary">
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
      </v-col>
      <v-col cols="12" sm="4" md="4">
        <v-text-field v-model="individualClient.movablePropertyOwned" label="Рухоме майно у власності"></v-text-field>
      </v-col>
    </v-row>

    <v-row >
      <v-col cols="12" sm="12" md="12" class="d-flex align-center">
        <h3 class="font-weight-medium">Нерухоме майно</h3>
        <v-btn @click="addRow2" class="mx-2" fab small dark color="primary">
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
      </v-col>
      <v-col cols="12" sm="4" md="4">
        <v-text-field v-model="individualClient.realEstate" label="Нерухоме майно"></v-text-field>
      </v-col>
    </v-row>

    <v-row >
      <v-col cols="12" sm="12" md="12">
        <v-radio-group v-model="individualClient.maritalStatus" row>
          <v-radio label="Одружений" value="Одружений"></v-radio>
          <v-radio label="Не одружений" value="Не одружений"></v-radio>
        </v-radio-group>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Кількісь утриманців (діти до 18 років)</h3>
      </v-col>
      <v-col cols="12" sm="2" md="2">
        <v-select
          :items="numberDependents"
          label="Оберіть клькість"
          v-model="individualClient.numberDependents"
        ></v-select>
      </v-col>
    </v-row>

    <v-row >
      <v-col cols="12" sm="12" md="12" class="d-flex align-center">
        <h3 class="font-weight-medium">Кредити в інших банках</h3>
        <v-btn @click="addRow2" class="mx-2" fab small dark color="primary">
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
      </v-col>
      <v-col cols="12" sm="4" md="4">
        <v-text-field v-model="individualClient.creditInOtherBanks" label="Кредити в інших банках"></v-text-field>
      </v-col>
    </v-row>

    <v-row >
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Поручитель</h3>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-radio-group v-model="bailStatus" row>
          <v-radio label="Так" value="true"></v-radio>
          <v-radio label="Ні" value="false"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>

    <v-row v-if="bailStatus === 'true'">
      <v-col cols="12" sm="12" md="12">
        <v-text-field label="ФІО" v-model="individualClient.bailName"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label="ІПН" v-model="individualClient.bailIpn"></v-text-field>
      </v-col>
      <v-col cols="12" sm="12" md="12">
        <v-text-field label="Адреса проживання" v-model="individualClient.bailAdress"></v-text-field>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" sm="12" md="12">
        <h3 class="font-weight-medium">Мета отримання кредиту</h3>
      </v-col>
      <v-col cols="12" sm="4" md="4">
        <v-textarea
          v-model="individualClient.purposeCredit"
          no-resize="true"
          label="Мета отримання кредиту"
      ></v-textarea>
      </v-col>

    </v-row>

    <v-row  v-if="contractIs == true">
      <v-col cols="12" sm="12" md="12">
        <v-checkbox v-model="contractIs" :label="`Договір заключено`"></v-checkbox>
      </v-col>
    </v-row>

    <v-row >
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" v-model="individualClient.contractNumber" label="Номер договору"></v-text-field>
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
        <v-text-field type="number" v-model="individualClient.amountContract" label="Сума договору"></v-text-field>
      </v-col>
      <v-col cols="12" sm="3" md="3">
        <v-text-field type="number" v-model="individualClient.interestRate" label="Відсоткова ставка"></v-text-field>
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
      bailStatus: "true",
      MaritalStatus: "married",
      contractIs: true,
      numberDependents: [
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        10
      ]
    };
  }
};
</script>

<style>
</style>