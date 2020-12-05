<template>
  <div class="container skb-body">
    <div v-show="loading">
      <div class="loader-container-full">
        <div class="loader">
        </div>
      </div>
    </div>
    <a href="/admin/city">
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
            <div class="col-12">
              <div class="form-group">
                <fieldset
                  id="name"
                  class="name"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('city.fields.name') }}</label>
                  <input
                    v-validate="'required'"
                    type="text"
                    name="name"
                    class="form-control"
                    :placeholder="$t('city.placeholder.name')"
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
          </div>
          <div class="row my-3">
            <div class="col-6 offset-3">
              <button
                type="button"
                class="btn button_skb fontUbuntu"
                @click="$validateForm()"
              >{{ this.cityId ? this.$t('commons.edit') :  this.$t('commons.create')}}</button>
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
      API_URL: '/api/admin/cities' + (this.cityId ? `/${this.cityId}` : ''),
      fonctionsAtCreation: null,
      formFields: {
        name: null,
      },
      formErrors: {
        name: [],
      }
    };
  },
  props: {
    cityId: {
      type: Number,
      default: null,
    },
  },
  created () {
    let promises = [];
    if (this.cityId) {
      promises.push(axios.get(this.API_URL));
    }
    return Promise.all(promises).then(res => {
      if (this.cityId) {
        let city = res[0].data;
        this.$removeFieldsNotInForm(city, Object.keys(this.formFields));
        this.$setEditForm(city);
      }
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
