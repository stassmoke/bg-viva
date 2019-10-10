<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="8" md="4">
      <v-card class="elevation-12">
        <v-toolbar color="indigo" dark flat>
          <v-toolbar-title>Вход</v-toolbar-title>
          <div class="flex-grow-1"></div>
        </v-toolbar>
        <v-card-text>
          <v-form>
            <v-text-field
              label="Ваша почта"
              name="login"
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
          </v-form>
        </v-card-text>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn color="indigo" @click.prevent="login" dark>Войти</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      email: null,
      password: null,
      is_admin: null
    };
  },
  methods: {
    login: function() {
      let email = this.email;
      let password = this.password;
      this.$store
        .dispatch("login", { email, password })
        .then(() => this.$router.push("/"))
        .catch(err => console.log(err));
    }
  }
};
</script>
