<template>
  <div class="skb-body container">
    <div v-if="loading">
    </div>
    <div v-else>
      <div
        v-if="canEdit"
        class="row mt-3 "
      >
        <div class="col-6">
          <h1 class="fontUbuntu orange-skb">{{ this.$t('commons.detail') }}</h1>
        </div>
        <div class="col-6 justify-content-end">
          <a
            class="float-right"
            :href="'/admin/companystatut/edit/' + categoryId"
          >
            <b-button class="button_skb">{{ this.$t('commons.edit') }}</b-button>
          </a>
        </div>
      </div>
      <a href="/admin/category">
        <button
          :title="$t('commons.go_back')"
          type="button"
          class="w-40px mt-4 p-0 rounded-circle btn-close btn"
        >
          <i class="fas fa-times "></i>
        </button>
      </a>
      <div class="register-card mt-3 w-100 h-100">

        <div class="row">
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('category.fields.name') }}</span>
          </div>
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('category.fields.code') }}</span>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            <span class="fontHelveticaOblique fontSize18">{{ this.category.name.toUpperCase() }}</span>
          </div>
          <div class="col-6">
            <span class="fontHelveticaOblique fontSize18">{{ this.category.code }}</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
import axios from 'axios';
import Avatar from 'vue-avatar';

export default {
  components: {
    Avatar
  },
  props: {
    categoryId: {
      type: Number,
      default: null
    },
    canEdit: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      category: null,
      loading: false
    }
  },
  async created () {
    if (this.categoryId) {
      this.loading = true;
      return axios.get('/api/admin/categories/' + this.categoryId)
        .then(response => {
          this.category = response.data;
          this.loading = false;
        }).catch(error => {
          console.log(error);
        });
    }
  },
  methods: {

  },
}
</script>>
