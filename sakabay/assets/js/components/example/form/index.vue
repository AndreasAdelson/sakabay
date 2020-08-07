<template>
  <div class="row no-gutters">
    <form class="col-12">
      <div class="row">
        <fieldset
          id="nom"
          class="col-12"
        >
          <label>Nom de l'example</label>
          <input
            v-model="formFields.nom"
            type="text"
            name="nom"
            maxlength="100"
          >
          <div
            v-for="errorText in formErrors.nom"
            :key="'nom_' + errorText"
            class="line-height-1"
          >
            <span>{{ errorText }} </span>
          </div>
        </fieldset>
      </div>
      <div class="row">
        <fieldset
          id="consigne"
          class="col-12"
        >
          <label>Consigne</label>
          <textarea
            v-model="formFields.consigne"
            type="text"
            name="consigne"
            maxlength="100"
            rows="5"
            :placeholder="'300 caractères max'"
          />
          <div
            v-for="errorText in formErrors.consigne"
            :key="'consigne_' + errorText"
            class="line-height-1"
          >
            <span>{{ errorText }} </span>
          </div>
        </fieldset>
      </div>
      <div class="col-12 my-4">
        <button
          type="button"
          class="btn btn-primary mx-3"
          data-cy="form-valider"
          @click="submitForm()"
        >Valider</button>

        <button
          type="button"
          class="btn btn-primary mx-3"
          data-cy="form-valider"
          @click="getAllExamples()"
        >Get all </button>
      </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';
import _ from 'lodash';
export default {
  data () {
    return {
      examples: null,
      formFields: {
        nom: '',
        consigne: ''
      },
      formErrors: {
        nom: [],
        consigne: []
      }
    }
  },

  methods: {
    getAllExamples () {
      return axios.get("/api/examples")
        .then(response => {
          this.examples = response.data;
        });
    },

    submitForm () {
      return axios.post("/api/examples", this.formFields)
        .then(response => {
        });
    }
  },
}
</script>
