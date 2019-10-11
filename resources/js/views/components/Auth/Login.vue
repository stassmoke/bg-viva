<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="8" md="4">
      <v-card class="elevation-12">
        <v-toolbar color="indigo" dark flat>
          <v-toolbar-title>Войти</v-toolbar-title>
          <div class="flex-grow-1"></div>
        </v-toolbar>
        <v-card-text>
          <v-form>
            <v-text-field
              label="Ваша почта"
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
          <v-btn color="indigo" @click.prevent="login" dark>Войти</v-btn>
           <!-- <v-btn color="indigo" @click.prevent="loadUser" dark>getUser</v-btn> -->
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>

import { mapActions, mapGetters } from "vuex";

export default {
  data() {
    return {
      email: null,
      password: null
    };
  },
  computed: {
    ...mapGetters([
      'user'
    ])
  },
  methods: {
    ...mapActions([
      'loginUser',
      'getUser'
		]),
    login() {
      const user = {
        email: this.email,
        password: this.password,
      };
      this.loginUser(user)
			.then(resp => {
      })
      .then(() => {
          this.$router.push('/client')
      })
    },
    loadUser() {
      this.getUser()
    }
  }
};
</script>
