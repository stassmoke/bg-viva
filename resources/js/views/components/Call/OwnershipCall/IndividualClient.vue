<template>
    <v-row class="justify-center">
        <v-col cols="12" sm="12" md="12">
            <v-text-field class="input-centered" v-model="call.fio" label="ФІО"></v-text-field>
        </v-col>
        <v-col cols="12" sm="12" md="12">
            <v-text-field class="input-centered" v-model="call.ipn" label="ІПН"></v-text-field>
        </v-col>
        <v-col cols="12" sm="12" md="12">
            <v-text-field class="input-centered" v-model="call.phone" type="number"
                          label="Мобільний номер телефону"></v-text-field>
        </v-col>
        <v-col cols="12" sm="12" md="12">
            <v-text-field class="input-centered" v-model="call.alternate_phone" type="number"
                          label="Альтернативний номер телефону(Домашній /Робочий)"></v-text-field>
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
