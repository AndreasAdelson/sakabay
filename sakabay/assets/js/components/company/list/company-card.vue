<template>
  <a :href="'/entreprise/' + company.url_name ">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
          <div class="col-3">
            <img
              src="/build/logo.png"
              class="company-image"
            />
          </div>
          <div class="col-9">
            <div class="row mb-2">
              <div class="col-12">
                <span class="fontPatua fontSize20">{{ company.name }}</span>
              </div>
            </div>
            <div class="row pl-3 mb-1">
              <div class="col-12">
                <i class="fas fa-map-marker-alt orange-login-skb"></i>
                <span class="fontPatua fontSize14"> Ville </span>
              </div>
            </div>
            <div class="row pl-3 mb-2">
              <div class="col-12">
                <span class="fontHelveticaOblique fontSize14">{{ company.category.name }} </span>
              </div>
            </div>
            <div class="row pl-3 mb-2">
              <div class="col-12">
                <p class="fontHelveticaOblique fontSize16">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu interdum magna. Integer vitae nunc iaculis ...</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </a>
</template>
<script>
export default {
  props: {
    company: {
      type: Object,
      default: () => new Object()
    }
  },
  data () {
    return {

    }
  },
}
</script>
