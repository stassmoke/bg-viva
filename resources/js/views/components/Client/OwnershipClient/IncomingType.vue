<template>
    <div>
        <v-col cols="12" sm="12" md="12">
            <v-radio-group @change="updateValue()"  v-model="value" row>
                <v-radio class="mx-2" :value="incoming_types.first" label="< 0,5млн - 2,5 млн. грн."></v-radio>
                <v-radio class="mx-2" :value="incoming_types.second" label="2,5-10 млн. грн."></v-radio>
                <v-radio class="mx-2" :value="incoming_types.third" label="10 млн. грн."></v-radio>
            </v-radio-group>
        </v-col>
    </div>
</template>

<script>
    export default {
        name: "IncomingType",
        props: {
            name: {
                type: String,
                required: true,
            },
            value: {
                type: Number,
                default: 1,
            },
        },
        data() {
            return {
                incoming_types: {
                    first: 1,
                    second: 2,
                    third: 3,
                },
            };
        },
        methods: {
            updateValue() {
                this.$emit('updateValue', { name: this.name, value: this.value });
            }
        }
    }
</script>
