<template>
    <v-row class="d-flex justify-center align-center sing-up__centered">
        <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
                <v-toolbar color="primary" dark flat>
                    <v-toolbar-title>Вхід</v-toolbar-title>
                    <div class="flex-grow-1"></div>
                </v-toolbar>
                <v-card-text>
                    <v-form>
                        <v-text-field
                            label="Ваша пошта"
                            name="email"
                            type="email"
                            v-model="email"
                            required
                        ></v-text-field>

                        <v-text-field
                            id="password"
                            label="Пароль"
                            name="password"
                            type="password"
                            v-model="password"
                            required
                        ></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn color="primary" @click.prevent="login" >Увійти</v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>

    import { mapActions } from "vuex";

    export default {
        data() {
            return {
                email: null,
                password: null
            };
        },
        methods: {
            ...mapActions([
                'loginUser',
                'getUser',
            ]),
            login() {
                const user = {
                    email: this.email,
                    password: this.password,
                };

                this.loginUser(user)
                    .then(() => {
                        this.getUser()
                            .then(() => {
                                this.$router.push({name: 'clients'});
                            })
                        ;

                    })
                ;
            }
        }
    };
</script>
