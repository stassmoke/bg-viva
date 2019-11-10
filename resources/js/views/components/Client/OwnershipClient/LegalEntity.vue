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
                    oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="6"
                    label="Код ЄДРПОУ"
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

        <v-row justify="space-between">
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

        <v-row justify="space-between">
            <v-col cols="12" sm="12" md="12">
                <h2
                    class="font-weight-medium"
                >Відомості (ідентифікаційні дані) про структуру власності клієнта (пряме володіння), із зазначенням
                    частки</h2>
            </v-col>
            <v-col cols="12" sm="12" md="12" class="d-flex align-center">
                <h3 class="font-weight-medium">Фізичні особи-учасники</h3>
                <v-btn class="mx-2" fab small dark color="primary">
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
        <v-row>
            <v-col cols="12" sm="4" md="4">
                <v-text-field v-model="legal.individualsParticipating" label="Фізичні особи-учасники"></v-text-field>
            </v-col>
        </v-row>

        <v-row justify="space-between">
            <v-col cols="12" sm="12" md="12" class="d-flex align-center">
                <h3 class="font-weight-medium">Юридичні особи-учасники</h3>
                <v-btn class="mx-2" fab small dark color="primary">
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

        <v-row justify="space-between">
            <v-col cols="12" sm="4" md="4">
                <v-text-field v-model="legal.legalParticipating" label="Юридичні особи-учасники"></v-text-field>
            </v-col>
        </v-row>

        <v-row justify="space-between">
            <v-col cols="12" sm="12" md="12" class="d-flex align-center">
                <h3 class="font-weight-medium">Вид (види) господарської (економічної) діяльності клієнта</h3>
                <v-btn @click="$emit('addActivity')" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <v-row justify="space-between" v-for="(activity,index) in legal.activities" :key="activity.id">
            <v-col cols="10" sm="4" md="4">
                <v-text-field v-model="activity.description" label="Вид діяльності"></v-text-field>
            </v-col>
            <v-col cols="2">
                <v-btn @click="$emit('removeActivity',index)" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-minus</v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <v-row justify="flex-start">
            <v-col cols="12" sm="12" md="12">
                <h3
                    class="font-weight-medium"
                >Чистий дохід від реалізації продукції (товарів, робіт, послуг) за попередній звітний рік (для працюючих
                    суб’єктів господарювання) та запланований дохід за рік</h3>
            </v-col>
            <v-col cols="12" sm="6" md="6">
                <IncomingType :value.sync="legal.net_profit_type" name="net_profit_type"></IncomingType>
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

        <v-row justify="space-between">
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

        <v-row justify="space-between" v-for="(equipment,index) in legal.equipment" :key="equipment.id">
            <v-col cols="10" sm="4" md="4">
                <v-text-field
                    v-model="equipment.description"
                  label="Основні засоби у власності підприємстава"
                ></v-text-field>
            </v-col>
            <v-col cols="2" sm="4" md="4">
                <v-btn @click="$emit('removeEquipment',index)" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-minus</v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <v-row justify="flex-start">

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

            <IncomingType :value.sync="legal.carrying_type" name="carrying_type"></IncomingType>
        </v-row>

        <v-row justify="flex-start">
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

            <IncomingType :value.sync="legal.payables_type" name="payables_type"></IncomingType>
        </v-row>

        <v-row justify="flex-start">
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
                    <v-date-picker v-model="legal.receivables_date" no-title scrollable>
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

            <IncomingType :value.sync="legal.receivables_type" name="receivables_type"></IncomingType>
        </v-row>

    </div>
</template>

<script>
    import Credits from "./Credits";
    import IncomingType from "./IncomingType";

    export default {
        components: {
            Credits,
            IncomingType,
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
                clientPayablesDateMenu: false,
                clientReceivablesDateMenu: false,
                clientBalanceDateMenu: false,
            }
        },
    };
</script>
