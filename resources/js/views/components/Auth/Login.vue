<template>
    <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
                <v-toolbar color="indigo" dark flat>
                    <v-toolbar-title>Регистрация</v-toolbar-title>
                    <div class="flex-grow-1"></div>
                </v-toolbar>
                <v-card-text>
                    <v-form>
                        <v-text-field
                            label="Ваша почта"
                            name="login"
                            prepend-icon
                            type="email"
                            required
                        ></v-text-field>

                        <v-text-field
                            id="password"
                            label="Пароль"
                            name="password"
                            prepend-icon
                            type="password"
                            required
                        ></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn color="indigo" @click.prevent="login()" dark>Войти</v-btn>
                </v-card-actions>
                {{ isAuthenticated ? 'YES' : 'NO' }}
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
    import { mapState } from 'vuex';

    export default {

        data() {
            return {
                user: {
                    name: 'Lol',
                    userId: 100,
                }
            };
        },
        computed: {
            isAuthenticated() {
                return this.$store.state.isAuthenticated;
            }
        },
        methods: {
            login() {
                const data = {
                    user: {
                        name: this.user.name,
                        userId: this.user.userId
                    }
                };

                this.$store.dispatch('login', data);
            }
        }
    };
</script>
