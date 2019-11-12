<template>
    <v-row class="justify-center">
        <v-col cols="12" sm="12" md="12">
            <v-text-field class="input-centered" v-model="call.name" label="Назва Організації"></v-text-field>
        </v-col>
        <v-col cols="12" sm="12" md="12">
            <v-text-field
                type="number"
                v-model="call.edrpou_code"
                maxlength="6"
                label="Код ЄДРПОУ"
                class="input-centered"
            ></v-text-field>
        </v-col>
        <v-col cols="12" sm="12" md="12">
            <v-text-field class="input-centered" v-model="call.contact_name" label="Контактна Особа"></v-text-field>
        </v-col>
        <v-col cols="12" sm="12" md="12">
            <v-text-field class="input-centered" v-model="call.contact_position" label="Посада"></v-text-field>
        </v-col>
        <v-col cols="12" sm="12" md="12">
            <v-text-field class="input-centered" v-model="call.phone" type="number"
                          label="Номер Телефону"></v-text-field>
        </v-col>
        <v-col cols="12" sm="12" md="12">
            <v-text-field class="input-centered" v-model="call.alternate_phone" type="number"
                          label="Додатковий телефон"></v-text-field>
        </v-col>

    </v-row>
</template>

<script>
    export default {
        props: {
            call: {
                type: Object,
                required: true
            }
        },
    };
</script>
