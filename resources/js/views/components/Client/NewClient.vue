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
                    type: 1,
                    branch_code: 12312,
                    credit_meta: "Хочу купить ноут",
                    is_contract_concluded: true,
                    contract_number: 1231,
                    contract_date: "2019-09-01",
                    contract_sum: 10022,
                    contract_percent: 18.2,
                    individual: {
                        fio: "Name",
                        ipn: "IPN",
                        registration_address: "registration_address",
                        residence_address: "residence_address",
                        contact_phone: "3809711111",
                        work_place: "work_place",
                        work_place_phone: "3809711111",
                        average_monthly_income: 100.2,
                        another_income: 999,
                        is_married: false,
                        dependents_count: 0,
                        is_have_guarantor: true,
                        guarantor: {
                            fio: "fio",
                            ipn: "ipn",
                            registration_address: "registration_address",
                        },
                        real_estates: [
                            {
                                id: null,
                                description: "My real estate 1"
                            },
                            {
                                id: null,
                                description: "My real estate 2"
                            }
                        ],
                        movables: [
                            {
                                id: null,
                                description: "My movables 1"
                            },
                            {
                                id: null,
                                description: "My movables 2"
                            }
                        ]
                    },
                    legal_entry: {
                        id: null,
                        name: "name",
                        edrpou_code: 1234123,
                        legal_address: "legal_address",
                        actual_address: "actual_address",
                        contact_person: "contact_person",
                        position: "Manager",
                        phone: "380971211111",
                        landline_phone: "2202020",
                        activity: "Cars",
                        net_profit_type: "1",
                        carrying_amount: 100000,
                        carrying_date: "2019-01-01",
                        carrying_type: "1",
                        payables: 200000,
                        payables_date: "2019-02-01",
                        payables_type: "1",
                        receivables: 300000,
                        receivables_date: "2019-03-01",
                        receivables_type: "1",
                        equipment: [
                            {
                                id: null,
                                description: 'equipment 1',
                            },
                        ],
                    },
                    other_bank_credits: [
                        {
                            id: null,
                            name: "Bank Name 1",
                            sum: 1000000,
                            date: "2019-01-02"
                        },
                        {
                            id: null,
                            name: "Bank Name 2",
                            sum: 2000000,
                            date: "2019-02-02"
                        }
                    ]
                }
            };
        },
        methods: {
            ...mapActions(['addClient']),
            submitForm() {
                this.addClient(this.client);
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
            removeOtherCredit(index) {
                this.client.other_bank_credits.splice(index, 1);
            },
            removeEquipment(index) {
                this.client.legal_entry.equipment.splice(index, 1);
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
