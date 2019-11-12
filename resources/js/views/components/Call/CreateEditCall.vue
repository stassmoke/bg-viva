<template>
    <div>
        <v-container>
            <v-row class="d-flex justify-space-between align-center">
                <v-col cols="12" sm="7" md="7">
                    <v-radio-group v-model.number="call.type" class="d-flex align-center no-mess" row>
                        <v-radio label="Юридична особа" :value="legalType"></v-radio>
                        <v-radio label="Фізична особа підприємець" :value="individualEntrepreneurType"></v-radio>
                        <v-radio label="Фізична особа" :value="individualType"></v-radio>
                    </v-radio-group>
                </v-col>
                <v-col cols="12" sm="4" md="3">
                    <v-text-field
                        v-model="call.branch_code"
                        maxlength="3"
                        type="number"
                        label="Код відділення яке створює"
                    ></v-text-field>
                </v-col>
            </v-row>

            <LegalEntity :call="call" v-if="call.type === 1 || call.type === 2"></LegalEntity>

            <IndividualClient :call="call" v-else></IndividualClient>

            <v-row>
                <v-col cols="12" sm="12" md="12" class="datepicker-centered">
                    <v-menu
                        ref="callDate"
                        v-model="callDateMenu"
                        :close-on-content-click="false"
                        :return-value.sync="callDate"
                        transition="scale-transition"
                        offset-y
                        min-width="290px"
                    >
                        <template v-slot:activator="{ on }">
                            <v-text-field
                                v-model="call.date_at"
                                label="Дата дзвінка"
                                prepend-icon="event"
                                readonly
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker locale="uk" class="input-centered"  v-model="call.date_at" no-title scrollable>
                            <v-spacer></v-spacer>
                            <v-btn text color="primary" @click="callDateMenu = false">Cancel</v-btn>
                            <v-btn text color="primary" @click="$refs.callDateMenu.save(callDate)">OK</v-btn>
                        </v-date-picker>
                    </v-menu>
                </v-col>
                <v-col cols="12" sm="12" md="12">
                    <v-textarea name="input-7-1"  v-model="call.comment" class="input-centered" label="Коментар" auto-grow filled></v-textarea>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12" class="d-flex justify-space-between align-center">
                    <v-btn depressed color="primary" @click="submitForm()">Зберегти</v-btn>
                    <v-btn depressed color="primary" @click="goToList()">Таблиця дзвінків</v-btn>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import LegalEntity from "../Call/OwnershipCall/LegalEntity";
    import IndividualClient from "../Call/OwnershipCall/IndividualClient";

    import {mapActions} from "vuex";

    export default {
        name: "CreateEditCall",
        components: {
            LegalEntity,
            IndividualClient,

        },
        data() {
            return {
                legalType: 1,
                individualEntrepreneurType: 2,
                individualType: 3,

                call: {
                    id: null,
                    type: 1,
                    branch_code: null,
                    edrpou_code: null,
                    ipn: null,
                    contact_name: null,
                    name: null,
                    contact_position: null,
                    phone: null,
                    alternate_phone: null,
                    date_at: null,
                    comment: null,
                }
            };
        },
        mounted() {
            const callID = this.$route.params.id;

            if (callID) {
                this.findCall(callID).then(call => {
                    this.call = call;
                });
            }
        },
        methods: {
            ...mapActions(['findCall', 'updateCall', 'addCall']),
            submitForm() {
                if (this.call.id === null) {
                    this.addCall(this.call).then(() => {
                        this.goToList();
                    });
                } else {
                    this.updateCall(this.call).then(() => {
                        this.goToList();
                    });
                }
            },
            goToList() {
                this.$router.push({name: 'calls'});
            }
        }
    };
</script>
