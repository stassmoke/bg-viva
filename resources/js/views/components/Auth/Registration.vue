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
              label="Имя"
              name="name"
              prepend-icon
              type="name"
              v-model="name"
              required
            ></v-text-field>
            <v-text-field
              label="Почта"
              name="email"
              prepend-icon
              type="email"
              v-model="email"
              required
            ></v-text-field>

            <v-text-field
              id="password"
              label="Пароль"
              name="password"
              prepend-icon
              type="password"
              v-model="password"
              required
            ></v-text-field>
            <v-text-field
              id="confrim-password"
              label="Подтвердите пароль"
              name="password"
              prepend-icon
              type="password"
              v-model="confrimPassword"
              required
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn color="indigo" @click.prevent="register" dark>Зарегистрировать</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>

import {mapActions} from 'vuex';

export default {
  data() {
    return {
			name: null,
      email: null,
      password: null,
      confrimPassword: null
    };
  },
  methods: {
		...mapActions([
			'regiterUsers'
		]),
		register() {
      const user = {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.confrimPassword
			};
			this.regiterUsers(user)
			.then(resp => {
				console.log(resp)
			})
    }
  }
};
</script>
