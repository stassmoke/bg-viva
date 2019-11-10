<template>
    <div>
        <v-container>
            <v-row class="d-flex justify-space-between align-center">
                <v-col cols="12" sm="7" md="7">
                    <v-radio-group v-model.number="client.type" class="d-flex align-center no-mess" row>
                        <v-radio label="Юридична особа" :value="legalType"></v-radio>
                        <v-radio label="Фізична особа підприємець" :value="individualEntrepreneurType"></v-radio>
                        <v-radio label="Фізична особа" :value="individualType"></v-radio>
                    </v-radio-group>
                </v-col>
                <v-col cols="12" sm="4" md="3">
                    <v-text-field
                        v-model="client.branch_code" maxlength="3"
                        oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        type="number"
                        label="Код відділення яке створює"
                    ></v-text-field>
                </v-col>
            </v-row>

            <LegalEntity
                :credits="client.other_bank_credits"
                @addOtherCredit="addOtherCredit"
                @removeOtherCredit="removeOtherCredit"
                @addEquipment="addEquipment"
                @removeEquipment="removeEquipment"
                @addActivity="addActivity"
                @removeActivity="removeActivity"
                :legal="client.legal_entry"
                v-if="client.type === 1 || client.type === 2"
            ></LegalEntity>
            <IndividualClient
                :credits="client.other_bank_credits"
                @addOtherCredit="addOtherCredit"
                @removeOtherCredit="removeOtherCredit"
                @addRealEstate="addRealEstate"
                @removeRealEstate="removeRealEstate"
                @addMovables="addMovables"
                @removeMovables="removeMovables"
                :individual="client.individual"
                v-else
            ></IndividualClient>

            <Contract :client="client"></Contract>

            <v-row>
                <v-col cols="12" class="d-flex justify-space-between align-center">
                    <v-btn depressed color="primary" @click="submitForm()">Зберегти</v-btn>
                    <v-btn depressed color="primary" @click="$router.push('/clients/')">Таблиця клієнтів</v-btn>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import LegalEntity from '../Client/OwnershipClient/LegalEntity';
    import IndividualClient from '../Client/OwnershipClient/IndividualClient';
    import Contract from './OwnershipClient/Сontract';
    import { mapActions } from 'vuex';

    export default {
        name: "CreateEditClient",
        components: {
            LegalEntity,
            IndividualClient,
            Contract
        },
        data() {
            return {
                legalType: 1,
                individualEntrepreneurType: 2,
                individualType: 3,
                client: {
                    id: null,
                    type: 1,
                    branch_code: null,
                    credit_meta: null,
                    is_contract_concluded: false,
                    contract_number: null,
                    contract_date: null,
                    contract_sum: null,
                    contract_percent: null,
                    individual: {
                        fio: null,
                        ipn: null,
                        registration_address: null,
                        residence_address: null,
                        contact_phone: null,
                        work_place: null,
                        work_place_phone: null,
                        average_monthly_income: null,
                        another_income: null,
                        is_married: false,
                        dependents_count: 0,
                        is_have_guarantor: true,
                        guarantor: {
                            fio: null,
                            ipn: null,
                            registration_address: null,
                        },
                        real_estates: [],
                        movables: []
                    },
                    legal_entry: {
                        id: null,
                        name: null,
                        edrpou_code: null,
                        legal_address: null,
                        actual_address: null,
                        contact_person: null,
                        position: null,
                        phone: null,
                        landline_phone: null,
                        activity: null,
                        net_profit_type: null,
                        carrying_amount: null,
                        carrying_date: null,
                        carrying_type: 1,
                        payables: null,
                        payables_date: null,
                        payables_type: 1,
                        receivables: null,
                        receivables_date: null,
                        receivables_type: 1,
                        equipment: [],
                        activities: [],
                    },
                    other_bank_credits: [],
                }
            };
        },
        mounted() {
            const clientID = this.$route.params.id;

            if (clientID) {
                this.findClient(clientID).then(client => {
                    this.client = client;
                });
            }
        },
        methods: {
            ...mapActions(['findClient','updateClient','addClient']),
            submitForm() {
                if (this.client.id === null) {
                    this.addClient(this.client)
                        .then(() => {
                            this.$router.push('/clients/');
                        })
                    ;
                } else {
                    this.updateClient(this.client)
                        .then(() => {
                            this.$router.push('/clients/');
                        })
                    ;
                }
            },
            addRealEstate() {
                this.client.individual.real_estates.push({
                    id: null,
                    description: null,
                });
            },
            addMovables() {
                this.client.individual.movables.push({
                    id: null,
                    description: null,
                });
            },
            addOtherCredit() {
                this.client.other_bank_credits.push({
                    id: null,
                    name: null,
                    sum: null,
                    date: null,
                });
            },
            addEquipment() {
                this.client.legal_entry.equipment.push({
                    id: null,
                    description: null,
                });
            },
            addActivity() {
                this.client.legal_entry.activities.push({
                    id: null,
                    description: null,
                });
            },
            removeOtherCredit(index) {
                this.client.other_bank_credits.splice(index, 1);
            },
            removeEquipment(index) {
                this.client.legal_entry.equipment.splice(index, 1);
            },
            removeActivity(index) {
                this.client.legal_entry.activities.splice(index, 1);
            },
            removeRealEstate(index) {
                this.client.individual.real_estates.splice(index, 1);
            },
            removeMovables(index) {
                this.client.individual.movables.splice(index, 1);
            },
        },
    };
</script>
