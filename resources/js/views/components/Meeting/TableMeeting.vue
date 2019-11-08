<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="meetings"
      :items-per-page="100"
      :search="meetingSearch"
      class="elevation-1"
    >
      <template slot="meetings" slot-scope="props">
        <tr @click="showAlert(props.item)">
          <td>{{ name }}</td>
          <td>{{ code }}</td>
          <td>{{ contractNumber }}</td>
          <td>{{ branchNumber }}</td>
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
        { text: "Назва/ФІО", align: "left", sortable: false, value: "name" },
        { text: "Код", value: "legalCode" },
        { text: "Номер", value: "phoneNumber" },
        { text: "Дата зустрічі", value: "contractNumber" },
        { text: "Час зустрічі", value: "branchNumber" },
        { text: "Домовились з клієнтом про", value: "whatAgees" }
      ]
    };
  },
  computed: {
    ...mapGetters(["meetings", "meetingSearch"])
  },
  methods: {
    showAlert(a) {
      if (event.target.classList.contains("btn__content")) return;
      alert("Alert! \n" + a.name);
    }
  }
};
</script>