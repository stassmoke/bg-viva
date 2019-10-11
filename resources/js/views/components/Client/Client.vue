<template>
  <div>
    <v-container>
      <v-row justify="space-between">
        <v-col cols="12" sm="3" md="3">
          <v-radio-group v-model="radioGroup">
            <v-radio label="Новий клієнт"></v-radio>
            <v-radio label="Існуючий клієнт"></v-radio>
          </v-radio-group>
        </v-col>
        <v-col cols="12" sm="3" md="3">
          <v-text-field label="Введіть код або назву клієнта" solo></v-text-field>
        </v-col>
      </v-row>
      <v-card>
        <v-container>
          <v-row justify="space-between">
            <v-col cols="12" sm="3" md="3">
              <v-radio-group v-model="radioGroup2">
                <v-radio label="Юр"></v-radio>
                <v-radio label="Фіз"></v-radio>
              </v-radio-group>
            </v-col>
            <v-col cols="12" sm="3" md="3">
              <v-text-field label="Код відділення яке створює" solo></v-text-field>
            </v-col>
          </v-row>
          <v-row justify="space-between">
            <v-col cols="12" sm="3" md="3">
              <v-text-field label="Назва" solo></v-text-field>
            </v-col>
            <v-col cols="12" sm="3" md="3">
              <v-text-field label="Код ЄДРПОУ" solo></v-text-field>
            </v-col>
            <v-col cols="12" sm="3" md="3">
              <v-text-field label="Юридична адреса" solo></v-text-field>
            </v-col>
            <v-col cols="12" sm="3" md="3">
              <v-text-field label="Фактична адреса" solo></v-text-field>
            </v-col>
          </v-row>
          <v-row justify="space-between">
            <v-col cols="12" sm="3" md="3">
              <v-text-field label="Контактна особа" solo></v-text-field>
            </v-col>
            <v-col cols="12" sm="3" md="3">
              <v-text-field label="Посада" solo></v-text-field>
            </v-col>
            <v-col cols="12" sm="3" md="3">
              <v-text-field type="number" label="Телефон" solo></v-text-field>
            </v-col>
            <v-col cols="12" sm="3" md="3">
              <v-text-field type="number" label="Стаціонарний телефон" solo></v-text-field>
            </v-col>
          </v-row>
          <v-row justify="space-between">
            <v-col cols="12" sm="12" md="12">
              <h2
                class="font-weight-medium"
              >Відомості (ідентифікаційні дані) про структуру власності клієнта (пряме володіння), із зазначенням частки</h2>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <h3 class="font-weight-medium">Фізичні особи-учасники</h3>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <p
                class="font-weight-light"
              >(зазначте ПІБ., дату народження, громадянство, реєстраційний номер (ІПН) (у разі наявності), паспорт Серія та Номер, Орган який видав, дату видачі паспорта, місце реєстрації / проживання, номер у демографичному реєстрі ( для ID паспортів громадян України ,частку у статутному капіталі</p>
            </v-col>
          </v-row>
          <v-row justify="space-between">
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
          </v-row>
          <v-row justify="space-between">
            <v-col cols="12" sm="12" md="12">
              <h3 class="font-weight-medium">Юридичні особи-учасники</h3>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <p
                class="font-weight-light"
              >(зазначте назву, ЄДРПОУ/ номер реєстрації ( для нерезидентів), КВЕД основний (для резидентів), країну реєстрації, адресу місцезнаходження, адресу місцезнаходження виконавчого органу (для нерезидентів)та частку у статутному капіталі).</p>
            </v-col>
          </v-row>
          <v-row justify="space-between">
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-text-field label single-line></v-text-field>
            </v-col>
          </v-row>
          <v-row justify="space-between">
            <v-col cols="12" sm="12" md="12">
              <h3
                class="font-weight-medium"
              >Вид (види) господарської (економічної) діяльності клієнта</h3>
            </v-col>
            <v-col cols="12" sm="3" md="3">
              <v-text-field label="основний вид діяльності" solo></v-text-field>
            </v-col>
          </v-row>
          <v-row justify="flex-start">
            <v-col cols="12" sm="12" md="12">
              <h3
                class="font-weight-medium"
              >Чистий дохід від реалізації продукції (товарів, робіт, послуг) за попередній звітний рік (для працюючих суб’єктів господарювання) та запланований дохід за рік</h3>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-checkbox class="mx-2" label="< 0,5млн - 2,5 млн. грн."></v-checkbox>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-checkbox class="mx-2" label="2,5-10 млн. грн."></v-checkbox>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-checkbox class="mx-2" label="10 млн. грн."></v-checkbox>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <p
                class="font-weight-light"
              >(зазначте назву, ЄДРПОУ/ номер реєстрації ( для нерезидентів), КВЕД основний (для резидентів), країну реєстрації, адресу місцезнаходження, адресу місцезнаходження виконавчого органу (для нерезидентів)та частку у статутному капіталі).</p>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-container>
  </div>
</template>

<script>
// import NewClient from './views/components/Client/NewClient';

export default {
  components: {
    // NewClient
  },
  data() {
    return {
      checkbox: false,
      checkbox2: false,
      radioGroup: 0,
      radioGroup2: 0
    };
  }
};
</script>
