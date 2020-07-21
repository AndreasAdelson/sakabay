<template>
  <div>
    <b-form @reset="onReset" v-if="show">
      <b-form-group id="input-group-2" label="nom:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.name"
          required
          placeholder="Enter .."
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="prenom:" label-for="input-3">
        <b-form-input
          id="input-3"
          v-model="form.prenom"
          required
          placeholder="Enter .."
        ></b-form-input>
      </b-form-group>
      <!-- <b-form-group id="input-group-3" label="Food:" label-for="input-3">
        <b-form-select
          id="input-3"
          v-model="form.food"
          :options="foods"
          required
        ></b-form-select>
      </b-form-group> -->

      <!-- <b-form-group id="input-group-4">
        <b-form-checkbox-group v-model="form.checked" id="checkboxes-4">
          <b-form-checkbox value="me">Check me out</b-form-checkbox>
          <b-form-checkbox value="that">Check that out</b-form-checkbox>
        </b-form-checkbox-group>
      </b-form-group> -->

      <b-button @click="onSubmit()" type="button" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          prenom: '',
          name: '',
        },
        show: true
      }
    },
    methods: {
      onSubmit() {
        return "ok!!";
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>