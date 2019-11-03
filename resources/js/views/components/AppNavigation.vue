<template>
  <div>
    <v-navigation-drawer v-if="isAuthenticated" app  v-model="isShowNav">
      <v-list dense nav>
        <v-list-item v-for="link of links" :key="link.title" link>
          <v-list-item-content>
            <v-list-item-title>
              <router-link :to="{ name: link.url }">{{link.title}}</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>

import { mapGetters } from "vuex";

export default {
  data: () => ({
    links: [
      {
        title: "Клієнт",
        url: "client",
      },
      {
        title: "Дзвінок",
        url: "call",
      },
      {
        title: "Зустріч",
        url: "meeting",
      }
    ]
  }),
  computed: {
    ...mapGetters(["user", "isAuthenticated"]),
    isShowNav: {
      get() {
        return this.$store.getters.isShowNav;
      },
      set() {}
    }
  }
};
</script>
