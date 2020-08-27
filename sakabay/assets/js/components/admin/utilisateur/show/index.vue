<template>
   <vue-loaders-ball-beat color="red" scale="1"></vue-loaders-ball-beat>
</template>
<script>

export default {
  props: {
    utilsateurId: {
      type: Number,
      default: null
    }
  },
  data () {
    return {
      utilisateur: null
    }
  },
  created () {
    return axios.get('/api/admin/utilisateur/' + this.utilsateurId)
      .then(response => {
        this.utilisateur = response.data;
      })
  },
}
</script>>
