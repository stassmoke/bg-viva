<template>
    <div>
        <v-container v-if="this.isLoaded">
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
                client: {},
                isLoaded: false,
            };
        },
        mounted() {
            const clientID = this.$route.params.id;
            this.findClient(clientID).then(client => {
                this.client = client;
                this.isLoaded = true;
            });
        },
        methods: {
            ...mapActions(['findClient']),
            submitForm() {
                this.addClient(this.client)
                    .then(() => {
                        this.$router.push('/clients/');
                    })
                ;
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
        }
    };
</script>
