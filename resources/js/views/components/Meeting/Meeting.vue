
<template>
    <div>
        <v-container>
            <v-row justify="space-between">
                <v-col cols="12" sm="8" md="8">
                    <v-btn depressed color="primary" v-on:click="newMeeting = true">Зустріч клієнт існуючий</v-btn>
                    <v-btn depressed color="primary" v-on:click="newMeeting = false">Зустріч новий клієнт</v-btn>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    data() {
            return {
                newMeeting: true,
                // searchTableCall: '',
            }
        }
}
</script>

<style>

</style>