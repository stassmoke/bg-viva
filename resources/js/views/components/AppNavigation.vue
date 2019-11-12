<template>
  <div>
    <v-navigation-drawer width="325" mini-variant-width="55" expand-on-hover v-if="isAuthenticated" app >
      <v-list  nav>
        <v-list-item v-for="link of links" :key="link.title" link>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="d-flex align-center" :to="{ name: link.url }"><v-icon>{{link.icon}}</v-icon>{{link.title}}</router-link>
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
    mini: true,
    links: [
      {
        title: "Клієнт",
        url: "clients",
        icon: "mdi-account-multiple"
      },
      {
        title: "Дзвінок",
        url: "calls",
        icon: "call"
      },
      {
        title: "Зустріч",
        url: "meetings",
        icon: "message"
      },
      {
        title: "Дебіторська заборгованість",
        url: "receivables",
        icon: "monetization_on"
      },
      {
        title: "Календар",
        url: "calendar",
        icon: "calendar_today"
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
