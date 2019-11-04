<template>
  <div>
        <v-row justify="space-between">
          <v-col cols="12" sm="3" md="3">
            <v-text-field v-model="legal.name" label="Назва"></v-text-field>
          </v-col>
          <v-col cols="12" sm="3" md="3">
            <v-text-field oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "6" label="Код ЄДРПОУ"></v-text-field>
          </v-col>
          <v-col cols="12" sm="3" md="3">
            <v-text-field label="Юридична адреса"></v-text-field>
          </v-col>
          <v-col cols="12" sm="3" md="3">
            <v-text-field label="Фактична адреса"></v-text-field>
          </v-col>
        </v-row>

        <v-row justify="space-between">
          <v-col cols="12" sm="3" md="3">
            <v-text-field label="Контактна особа"></v-text-field>
          </v-col>
          <v-col cols="12" sm="3" md="3">
            <v-text-field label="Посада"></v-text-field>
          </v-col>
          <v-col cols="12" sm="3" md="3">
            <v-text-field type="number" label="Телефон"></v-text-field>
          </v-col>
          <v-col cols="12" sm="3" md="3">
            <v-text-field type="number" label="Стаціонарний телефон"></v-text-field>
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
          <v-col cols="12" sm="12" md="12">
            <v-text-field label single-line></v-text-field>
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
          <v-col cols="12" sm="12" md="12">
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
          <v-col cols="12" sm="12" md="12">
            <v-text-field label single-line></v-text-field>
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
          <v-col cols="12" sm="12" md="12">
            <v-text-field label single-line></v-text-field>
          </v-col>
        </v-row>

        <v-row justify="space-between">
          <v-col cols="12" sm="12" md="12">
            <h3 class="font-weight-medium">Вид (види) господарської (економічної) діяльності клієнта</h3>
          </v-col>
          <v-col cols="12" sm="12" md="12">
            <v-text-field label="основний вид діяльності"></v-text-field>
          </v-col>
        </v-row>

        <v-row justify="flex-start">
          <v-radio-group v-model="radioGroup3" row>
            <v-col cols="12" sm="12" md="12">
              <h3
                class="font-weight-medium"
              >Чистий дохід від реалізації продукції (товарів, робіт, послуг) за попередній звітний рік (для працюючих суб’єктів господарювання) та запланований дохід за рік</h3>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-radio class="mx-2" label="< 0,5млн - 2,5 млн. грн."></v-radio>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-radio class="mx-2" label="2,5-10 млн. грн."></v-radio>
            </v-col>
            <v-col cols="12" sm="2" md="2">
              <v-radio class="mx-2" label="10 млн. грн."></v-radio>
            </v-col>
          </v-radio-group>

          <v-col cols="12" sm="12" md="12">
            <p
              class="font-weight-light"
            >(зазначте назву, ЄДРПОУ/ номер реєстрації ( для нерезидентів), КВЕД основний (для резидентів), країну реєстрації, адресу місцезнаходження, адресу місцезнаходження виконавчого органу (для нерезидентів)та частку у статутному капіталі).</p>
          </v-col>
        </v-row>

        <v-row justify="space-between">
          <v-col cols="12" sm="12" md="12">
            <h3 class="font-weight-medium">Кредити в інших фінансових установах</h3>
          </v-col>
          <v-col cols="12" sm="12" md="12">
            <p class="font-weight-light">(назва установи, сума, з якої дати)</p>
          </v-col>
        </v-row>

        <v-row justify="space-between">
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
            <h3 class="font-weight-medium">Основні засоби у власності підприємстава</h3>
          </v-col>
          <v-col cols="12" sm="12" md="12">
            <p class="font-weight-light">(машини, обладнання,устаткування, нерухомість у власності)</p>
          </v-col>
        </v-row>

        <v-row justify="space-between">
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

        <v-row justify="flex-start">
          <v-radio-group v-model="radioGroup4" row>
            <v-col cols="12" sm="12" md="12">
              <h3 class="font-weight-medium">Балансова вартість станом на останню звітну дату</h3>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-menu
                ref="clientBalanceDateMenu"
                v-model="clientBalanceDateMenu"
                :close-on-content-click="false"
                :return-value.sync="clientBalanceDate"
                transition="scale-transition"
                offset-y
                min-width="290px"
              >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="clientBalanceDate"
                    label="Оберіть дату"
                    prepend-icon="event"
                    readonly
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="clientBalanceDate" no-title scrollable>
                  <v-spacer></v-spacer>
                  <v-btn text color="primary" @click="clientBalanceDateMenu = false">Cancel</v-btn>
                  <v-btn text color="primary" @click="$refs.clientBalanceDateMenu.save(clientBalanceDate)">OK</v-btn>
                </v-date-picker>
              </v-menu>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-radio class="mx-2" label="< 0,5млн - 2,5 млн. грн."></v-radio>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-radio class="mx-2" label="2,5-10 млн. грн."></v-radio>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-radio class="mx-2" label="10 млн. грн."></v-radio>
            </v-col>
          </v-radio-group>
        </v-row>

        <v-row justify="flex-start">
          <v-radio-group v-model="radioGroup5" row>
            <v-col cols="12" sm="12" md="12">
              <h3 class="font-weight-medium">Кредиторська заборгованість </h3>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-menu
                ref="clientPayablesDateMenu"
                v-model="clientPayablesDateMenu"
                :close-on-content-click="false"
                :return-value.sync="clientPayablesDate"
                transition="scale-transition"
                offset-y
                min-width="290px"
              >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="clientPayablesDate"
                    label="Оберіть дату"
                    prepend-icon="event"
                    readonly
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="clientPayablesDate" no-title scrollable>
                  <v-spacer></v-spacer>
                  <v-btn text color="primary" @click="clientPayablesDateMenu = false">Cancel</v-btn>
                  <v-btn text color="primary" @click="$refs.clientPayablesDateMenu.save(clientPayablesDate)">OK</v-btn>
                </v-date-picker>
              </v-menu>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-radio class="mx-2" label="< 0,5млн - 2,5 млн. грн."></v-radio>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-radio class="mx-2" label="2,5-10 млн. грн."></v-radio>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-radio class="mx-2" label="10 млн. грн."></v-radio>
            </v-col>
          </v-radio-group>
        </v-row>

        <v-row justify="flex-start">
          <v-radio-group v-model="radioGroup6" row>
            <v-col cols="12" sm="12" md="12">
              <h3 class="font-weight-medium">Дебіторська заборгованість </h3>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-menu
                ref="clientReceivablesDateMenu"
                v-model="clientReceivablesDateMenu"
                :close-on-content-click="false"
                :return-value.sync="clientReceivablesDate"
                transition="scale-transition"
                offset-y
                min-width="290px"
              >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="clientReceivablesDate"
                    label="Оберіть дату"
                    prepend-icon="event"
                    readonly
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="clientReceivablesDate" no-title scrollable>
                  <v-spacer></v-spacer>
                  <v-btn text color="primary" @click="clientReceivablesDateMenu = false">Cancel</v-btn>
                  <v-btn text color="primary" @click="$refs.clientReceivablesDateMenu.save(clientReceivablesDate)">OK</v-btn>
                </v-date-picker>
              </v-menu>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-radio class="mx-2" label="< 0,5млн - 2,5 млн. грн."></v-radio>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-radio class="mx-2" label="2,5-10 млн. грн."></v-radio>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-radio class="mx-2" label="10 млн. грн."></v-radio>
            </v-col>
          </v-radio-group>
        
        </v-row>

        <v-row justify="space-between">
          <v-col cols="12" sm="12" md="12">
            <h3 class="font-weight-medium">Мета отримання кредиту </h3>
          </v-col>
          <v-col cols="12" sm="12" md="12">
            <v-text-field label single-line></v-text-field>
          </v-col>
        </v-row>

        <v-row justify="space-between">
          <v-col cols="12" sm="12" md="12">
            <v-checkbox v-model="contractIs" :label="`Договір заключено`"></v-checkbox>
          </v-col>
        </v-row>

        <v-row justify="space-between" v-if="contractIs == true">
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
                  <v-btn text color="primary" @click="$refs.clientContractDateMenu.save(clientContractDate)">OK</v-btn>
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
  props: {
    legal: {
      type: Object,
      required: true,
    }
  },
    data() {
        return {
          radioGroup: 0,
          radioGroup3: 0,
          radioGroup4: 0,
          radioGroup5: 0,
          radioGroup6: 0,

        
          clientBalanceDate: new Date().toISOString().substr(0, 10),
          clientBalanceDateMenu: false,

          clientPayablesDate: new Date().toISOString().substr(0, 10),
          clientPayablesDateMenu: false,

          clientReceivablesDate: new Date().toISOString().substr(0, 10),
          clientReceivablesDateMenu: false,

          contractIs: true,

          clientContractDate: new Date().toISOString().substr(0, 10),
          clientContractDateMenu: false,
        }
        
    }
}
</script>

<style>

</style>