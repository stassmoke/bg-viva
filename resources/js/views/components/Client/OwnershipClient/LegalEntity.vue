<template>
    <div>
        <v-row class="justify-center">
            <v-col cols="12" sm="12" md="12">
                <v-text-field class="input-centered" v-model="legal.name" label="Назва"></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <v-text-field
                    class="input-centered"
                    v-model="legal.edrpou_code"
                    label="Код ЄДРПОУ"
                    maxlength="6"
                    type="number"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <v-text-field
                    class="input-centered"
                    v-model="legal.legal_address"
                    label="Юридична адреса"
                ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <v-text-field
                    class="input-centered"
                    v-model="legal.actual_address"
                    label="Фактична адреса"
                ></v-text-field>
            </v-col>
        </v-row>

        <v-row >
            <v-col cols="12" sm="12" md="12">
                <v-text-field
                    class="input-centered"
                    v-model="legal.contact_person"
                    label="Контактна особа"
                ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <v-text-field class="input-centered" v-model="legal.position" label="Посада"></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <v-text-field
                    class="input-centered"
                    v-model="legal.phone"
                    type="number"
                    label="Телефон"
                ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <v-text-field
                    class="input-centered"
                    v-model="legal.landline_phone"
                    type="number"
                    label="Стаціонарний телефон"
                ></v-text-field>
            </v-col>
        </v-row>

        <v-row >
            <v-col cols="12" sm="12" md="12">
                <h2
                    class="font-weight-medium"
                >Відомості (ідентифікаційні дані) про структуру власності клієнта (пряме володіння), із зазначенням
                    частки</h2>
            </v-col>
            <v-col cols="12" sm="12" md="12" class="d-flex align-center">
                <h3 class="font-weight-medium">Фізичні особи-учасники</h3>
                <v-btn @click="$emit('addIndividualPerson')" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <p
                    class="font-weight-light"
                >(зазначте ПІБ., дату народження, громадянство, реєстраційний номер (ІПН) (у разі наявності), паспорт
                    Серія та Номер, Орган який видав, дату видачі паспорта, місце реєстрації / проживання, номер у
                    демографичному реєстрі ( для ID паспортів громадян України ,частку у статутному капіталі</p>
            </v-col>
        </v-row>
        <div></div>
        <v-row v-for="(individualPerson,index) in legal.individual_persons" :key="`ip_${individualPerson.id}`">
            <v-col cols="10" sm="4" md="4" class="d-flex align-center">
                <v-text-field v-model="individualPerson.description" label="Фізичні особи-учасники"></v-text-field>
                <v-btn @click="$emit('removeIndividualPerson',index)" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-minus</v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <v-row >
            <v-col cols="12" sm="12" md="12" class="d-flex align-center">
                <h3 class="font-weight-medium">Юридичні особи-учасники</h3>
                <v-btn @click="$emit('addPerson')" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <p
                    class="font-weight-light"
                >(зазначте назву, ЄДРПОУ/ номер реєстрації ( для нерезидентів), КВЕД основний (для резидентів), країну
                    реєстрації, адресу місцезнаходження, адресу місцезнаходження виконавчого органу (для нерезидентів)та
                    частку у статутному капіталі).</p>
            </v-col>
        </v-row>

        <v-row   v-for="(person,index) in legal.persons" :key="`p_${person.id}`">
            <v-col cols="10" sm="4" md="4" class="d-flex align-center">
                <v-text-field v-model="person.description" label="Юридичні особи-учасники"></v-text-field>
                <v-btn @click="$emit('removePerson',index)" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-minus</v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <v-row >
            <v-col cols="12" sm="12" md="12" class="d-flex align-center">
                <h3 class="font-weight-medium">Вид (види) господарської (економічної) діяльності клієнта</h3>
                <v-btn @click="$emit('addActivity')" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <v-row  v-for="(activity,index) in legal.activities" :key="`a_${activity.id}`">
            <v-col cols="10" sm="4" md="4" class="d-flex align-center">
                <v-text-field v-model="activity.description" label="Вид діяльності"></v-text-field>
                <v-btn @click="$emit('removeActivity',index)" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-minus</v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <v-row >
            <v-col cols="12" sm="12" md="12">
                <h3
                    class="font-weight-medium"
                >Чистий дохід від реалізації продукції (товарів, робіт, послуг) за попередній звітний рік (для працюючих
                    суб’єктів господарювання) та запланований дохід за рік</h3>
            </v-col>
            <v-col cols="12" sm="6" md="6">
                <v-col cols="12" sm="12" md="12">
                    <v-radio-group v-model="legal.net_profit_type" row>
                        <v-radio class="mx-2" :value="incoming_types.first" label="< 0,5млн - 2,5 млн. грн."></v-radio>
                        <v-radio class="mx-2" :value="incoming_types.second" label="2,5-10 млн. грн."></v-radio>
                        <v-radio class="mx-2" :value="incoming_types.third" label="10 млн. грн."></v-radio>
                    </v-radio-group>
                </v-col>
            </v-col>

            <v-col cols="12" sm="12" md="12">
                <p
                    class="font-weight-light"
                >(зазначте назву, ЄДРПОУ/ номер реєстрації ( для нерезидентів), КВЕД основний (для резидентів), країну
                    реєстрації, адресу місцезнаходження, адресу місцезнаходження виконавчого органу (для нерезидентів)та
                    частку у статутному капіталі).</p>
            </v-col>
        </v-row>

        <Credits
            :credits="credits"
            @addOtherCredit="$emit('addOtherCredit')"
            @removeOtherCredit="$emit('removeOtherCredit')"
        ></Credits>

        <v-row >
            <v-col cols="12" sm="12" md="12" class="d-flex align-center">
                <h3 class="font-weight-medium">Основні засоби у власності підприємстава</h3>
                <v-btn @click="$emit('addEquipment')" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <p class="font-weight-light">(машини, обладнання,устаткування, нерухомість у власності)</p>
            </v-col>
        </v-row>

        <v-row v-for="(equipment,index) in legal.equipment" :key="`e_${equipment.id}`">
            <v-col cols="10" sm="4" md="4" class="d-flex align-center">
                <v-text-field
                    v-model="equipment.description"
                  label="Основні засоби у власності підприємстава"
                ></v-text-field>
                <v-btn @click="$emit('removeEquipment',index)" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-minus</v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <v-row>

            <v-col cols="12" sm="12" md="12">
                <h3 class="font-weight-medium">Балансова вартість станом на останню звітну дату</h3>
            </v-col>
            <v-col cols="12" sm="2" md="2">
                <v-menu
                    ref="clientBalanceDateMenu"
                    v-model="clientBalanceDateMenu"
                    :close-on-content-click="false"
                    :return-value.sync="legal.carrying_date"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="legal.carrying_date"
                            label="Оберіть дату"
                            prepend-icon="event"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker v-model="legal.carrying_date" no-title scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="clientBalanceDateMenu = false">Cancel</v-btn>
                        <v-btn
                            text
                            color="primary"
                            @click="$refs.clientBalanceDateMenu.save(legal.carrying_date)"
                        >OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>
            </v-col>

            <v-col cols="12" sm="12" md="12">
                <v-radio-group v-model="legal.carrying_type" row>
                    <v-radio class="mx-2" :value="incoming_types.first" label="< 0,5млн - 2,5 млн. грн."></v-radio>
                    <v-radio class="mx-2" :value="incoming_types.second" label="2,5-10 млн. грн."></v-radio>
                    <v-radio class="mx-2" :value="incoming_types.third" label="10 млн. грн."></v-radio>
                </v-radio-group>
            </v-col>
        </v-row>

        <v-row >
            <v-col cols="12" sm="12" md="12">
                <h3 class="font-weight-medium">Кредиторська заборгованість</h3>
            </v-col>
            <v-col cols="12" sm="2" md="2">
                <v-menu
                    ref="clientPayablesDateMenu"
                    v-model="clientPayablesDateMenu"
                    :close-on-content-click="false"
                    :return-value.sync="legal.payables_date"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="legal.payables_date"
                            label="Оберіть дату"
                            prepend-icon="event"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker v-model="legal.payables_date" no-title scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="clientPayablesDateMenu = false">Cancel</v-btn>
                        <v-btn
                            text
                            color="primary"
                            @click="$refs.clientPayablesDateMenu.save(legal.payables_date)"
                        >OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>
            </v-col>

            <v-col cols="12" sm="12" md="12">
                <v-radio-group v-model="legal.payables_type" row>
                    <v-radio class="mx-2" :value="incoming_types.first" label="< 0,5млн - 2,5 млн. грн."></v-radio>
                    <v-radio class="mx-2" :value="incoming_types.second" label="2,5-10 млн. грн."></v-radio>
                    <v-radio class="mx-2" :value="incoming_types.third" label="10 млн. грн."></v-radio>
                </v-radio-group>
            </v-col>
        </v-row>

        <v-row >
            <v-col cols="12" sm="12" md="12">
                <h3 class="font-weight-medium">Дебіторська заборгованість</h3>
            </v-col>
            <v-col cols="12" sm="2" md="2">
                <v-menu
                    ref="clientReceivablesDateMenu"
                    v-model="clientReceivablesDateMenu"
                    :close-on-content-click="false"
                    :return-value.sync="legal.receivables_date"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="legal.receivables_date"
                            label="Оберіть дату"
                            prepend-icon="event"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker locale="uk" v-model="legal.receivables_date" no-title scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="clientReceivablesDateMenu = false">Cancel</v-btn>
                        <v-btn
                            text
                            color="primary"
                            @click="$refs.clientReceivablesDateMenu.save(legal.receivables_date)"
                        >OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>
            </v-col>

            <v-col cols="12" sm="12" md="12">
                <v-radio-group v-model="legal.receivables_type" row>
                    <v-radio class="mx-2" :value="incoming_types.first" label="< 0,5млн - 2,5 млн. грн."></v-radio>
                    <v-radio class="mx-2" :value="incoming_types.second" label="2,5-10 млн. грн."></v-radio>
                    <v-radio class="mx-2" :value="incoming_types.third" label="10 млн. грн."></v-radio>
                </v-radio-group>
            </v-col>
        </v-row>

    </div>
</template>

<script>
    import Credits from "./Credits";

    export default {
        components: {
            Credits,
        },
        props: {
            legal: {
                type: Object,
                required: true
            },
            credits: {
                type: Array,
                required: true,
            },
        },
        data() {
            return {
                incoming_types: {
                    first: 1,
                    second: 2,
                    third: 3,
                },
                clientPayablesDateMenu: false,
                clientReceivablesDateMenu: false,
                clientBalanceDateMenu: false,
            }
        },
    };
</script>
