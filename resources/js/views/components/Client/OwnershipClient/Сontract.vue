<template>
    <div>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <h3 class="font-weight-medium">Мета отримання кредиту</h3>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <v-text-field label="Мета отримання кредиту" v-model="client.credit_meta"></v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12" sm="12" md="12">
                <v-checkbox v-model="client.is_contract_concluded" :label="`Договір заключено`"></v-checkbox>
            </v-col>
        </v-row>

        <v-row v-if="client.is_contract_concluded">
            <v-col cols="12" sm="3" md="3">
                <v-text-field type="number" label="Номер договору" v-model="client.contract_number"></v-text-field>
            </v-col>
            <v-col cols="12" sm="3" md="3">
                <v-menu
                    ref="clientContractDateMenu"
                    v-model="clientContractDateMenu"
                    :close-on-content-click="false"
                    :return-value.sync="client.contract_date"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="client.contract_date"
                            label="Оберіть дату"
                            prepend-icon="event"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker locale="uk" v-model="client.contract_date" no-title scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="clientContractDateMenu = false">Cancel</v-btn>
                        <v-btn
                            text
                            color="primary"
                            @click="$refs.clientContractDateMenu.save(client.contract_date)"
                        >OK</v-btn>
                    </v-date-picker>
                </v-menu>
            </v-col>
            <v-col cols="12" sm="3" md="3">
                <v-text-field type="number" label="Сума договору" v-model.number="client.contract_sum"></v-text-field>
            </v-col>
            <v-col cols="12" sm="3" md="3">
                <v-text-field type="number" label="Відсоткова ставка" v-model.number="client.contract_percent"></v-text-field>
            </v-col>
        </v-row>
    </div>
</template>

<script>
    export default {
        props: {
            client: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                clientContractDateMenu: false
            };
        }
    }
</script>
