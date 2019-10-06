<template>
  <v-app-bar app color="indigo" dark>
    <v-app-bar-nav-icon @click.stop="toggleNav()"></v-app-bar-nav-icon>
    <v-toolbar-title>Viva-Capital Ba</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
      <v-btn
        v-for="btn of buttons"
        @click="toPage(btn.route)"
        :key="btn.title"
         text >
          <v-icon left>
            <!-- {{btn.icon}} -->
          </v-icon>
          {{btn.title}}
      </v-btn>
    </v-toolbar-items>
  </v-app-bar>
</template>

<script>
    import { mapMutations } from 'vuex';

export default {
  data: () => ({
    buttons: [
      {
        title: 'Вход',
        icon: 'lock',
        route: 'clients.create'
        
      },
      {
        title: 'Выход',
        icon: 'lock',
        route: 'login'
      },
      {
        title: 'Зарегистрировать',
        icon: 'lock',
        route: 'login',
      }
    ]
  }),
    methods: {
        ...mapMutations([
            'toggleNav',
        ]),
        toPage(name) {
            this.$router.push({ name: name });
        }
    },
};
</script>
