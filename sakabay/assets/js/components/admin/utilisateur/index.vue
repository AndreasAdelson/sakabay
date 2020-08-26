<template>
  <div class="container">
    <div class="row">
      <div class="table-responsive tablestyle">
        <table class="table table-hover">
          <caption class="fontUbuntu orange-skb">{{ this.$t('admin.user.title') }}</caption>
          <thead class="thead tableitem">
            <tr>
              <th scope="col">{{ this.$t('admin.user.fields.email') }}</th>
              <th scope="col">{{ this.$t('admin.user.fields.login') }}</th>
              <th scope="col">{{ this.$t('admin.user.fields.first_name') }}</th>
              <th scope="col">{{ this.$t('admin.user.fields.last_name') }}</th>
              <th scope="col">{{ this.$t('commons.actions') }}</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(utilisateur, index) in utilisateurs"
              :key="'utilisateur_info'+utilisateur.login"
            >
              <td>{{ utilisateur.email }}</td>
              <td>{{ utilisateur.login }}</td>
              <td>{{ utilisateur.first_name }}</td>
              <td>{{ utilisateur.last_name }}</td>
              <td>
                <a :href="'/admin/utilisateur/edit/'+ utilisateur.id">
                  <button
                    class="btn btn-secondary"
                    type="button"
                  >
                    <i class="fas fa-edit"></i>
                  </button>
                </a>
                <button
                  class="btn btn-secondary"
                  type="button"
                  @click="deleteUtilisateur(utilisateur.id,index)"
                >
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data () {
    return {
      utilisateurs: [],
    }
  },
  methods: {
    deleteUtilisateur (utilisateurId, index) {
      return axios.delete("/api/admin/utilisateurs/" + utilisateurId)
        .then(response => {
          window.location.assign(response.headers.location);
        });
    },
  },
  created () {
    return axios.get("/api/admin/utilisateurs")
      .then(response => {
        this.utilisateurs = response.data;
      });
  }
}
</script>
