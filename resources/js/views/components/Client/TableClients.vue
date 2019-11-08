<template>
  <div>
    <v-data-table
      single-select="true"
      :headers="headers"
      :items="clients"
      :items-per-page="5"
      :search="clientSearch"
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <tr @click="showAlert(props.item)">
          <td>{{ props.name }}</td>
          <td>{{ props.item.code }}</td>
          <td>{{ props.item.contractNumber }}</td>
          <td>{{ props.item.branchNumber }}</td>
        </tr>
      </template>
    </v-data-table>
  </div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      headers: [
        { text: "Назва", align: "left", sortable: false, value: "name" },
        { text: "Код", value: "code" },
        { text: "Номер договору", value: "contractNumber" },
        { text: "Номер відділення", value: "branchNumber" }
      ]
    };
  },
  computed: {
    ...mapGetters(["clients", "clientSearch"])
  },
  methods: {
    showAlert(a) {
      if (event.target.classList.contains("btn__content")) return;
      alert("Alert! \n" + a.name);
    }
  }
};
</script>