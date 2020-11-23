<template>
  <div class="container skb-body">
    <div v-show="loading">
      <div class="loader-container-full">
        <div class="loader">
        </div>
      </div>
    </div>
    <a href="/admin/category">
      <button
        title="Annulez les modifications"
        type="button"
        class="w-40px p-0 rounded-circle btn-close btn"
      >
        <i class="fas fa-times "></i>
      </button>
    </a>
    <form>
      <div class="">
        <div class="register-card w-100 h-100">
          <!-- First row  -->
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="name"
                  class="name"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('category.fields.name') }}</label>
                  <input
                    v-validate="'required'"
                    type="text"
                    name="name"
                    class="form-control"
                    :placeholder="$t('category.placeholder.name')"
                    v-model="formFields.name"
                  >
                  <div
                    v-for="errorText in formErrors.name"
                    :key="'name_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="code"
                  class="code"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('category.fields.code') }}</label>
                  <input
                    v-validate="'required'"
                    name="code"
                    type="text"
                    class="form-control"
                    :placeholder="$t('category.placeholder.code')"
                    v-model="formFields.code"
                  >
                  <div
                    v-for="errorText in formErrors.code"
                    :key="'code_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-6 offset-3">
              <button
                type="button"
                class="btn button_skb fontUbuntu"
                @click="$validateForm()"
              >{{ this.categoryId ? this.$t('commons.edit') :  this.$t('commons.create')}}</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';
import validatorRulesMixin from 'mixins/validatorRulesMixin';
import adminFormMixin from 'mixins/adminFormMixin';
import DualList from 'components/commons/dual-list';

export default {
  components: {
    DualList
  },
  mixins: [
    validatorRulesMixin,
    adminFormMixin
  ],
  data () {
    return {
      loading: true,
      API_URL: '/api/admin/categories' + (this.categoryId ? `/${this.categoryId}` : ''),
      fonctionsAtCreation: null,
      fonctions: [],
      formFields: {
        name: null,
        code: null,
        fonctions: [],
      },
      formErrors: {
        name: [],
        code: [],
        fonctions: [],
      }
    };
  },
  props: {
    categoryId: {
      type: Number,
      default: null,
    },
  },
  created () {
    let promises = [];
    promises.push(axios.get('/api/admin/fonctions'));
    if (this.categoryId) {
      promises.push(axios.get(this.API_URL));
    }
    return Promise.all(promises).then(res => {
      this.fonctions = res[0].data;
      if (this.categoryId) {
        let category = res[1].data;
        this.$removeFieldsNotInForm(category, Object.keys(this.formFields));
        this.$setEditForm(category);
      }
      this.fonctionsAtCreation = _.cloneDeep(this.formFields.fonctions);
      this.loading = false;
    }).catch(e => {
      this.$handleError(e);
      this.loading = false;
    });
  },
  methods: {

  },
}
</script>
