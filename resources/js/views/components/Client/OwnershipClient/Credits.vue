<template>
    <div>
        <v-row justify="space-between">
            <v-col cols="12" sm="12" md="12" class="d-flex align-center">
                <h3 class="font-weight-medium">Кредити в інших фінансових установах</h3>
                <v-btn @click="$emit('addOtherCredit')" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-col>
            <v-col cols="12" sm="12" md="12">
                <p class="font-weight-light">(назва установи, сума, з якої дати)</p>
            </v-col>
        </v-row>

        <v-row justify="space-between" v-for="(credit,index) in credits" :key="credit.id">
            <v-col cols="10" sm="4" md="4">
                <v-text-field v-model="credit.name" label="Назва установи"></v-text-field>
            </v-col>
            <v-col cols="2" sm="4" md="4">
                <v-btn @click="$emit('removeOtherCredit',index)" class="mx-2" fab small dark color="primary">
                    <v-icon dark>mdi-minus</v-icon>
                </v-btn>
            </v-col>
        </v-row>
    </div>
</template>

<script>
    export default {
        name: "Credits",
        props: {
            credits: {
                type: Array,
                required: true,
            },
        }
    }
</script>
