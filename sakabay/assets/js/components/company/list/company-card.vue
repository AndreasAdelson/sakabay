<template>
  <a :href="'/entreprise/' + company.url_name ">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <img
              src="/build/logo.png"
              class="company-image"
            >
            <div class="card-main-info">
              <div class="row mb-2">
                <div class="col-12">
                  <span class="fontPoppins fontSize20 fontW600">{{ company.name }}</span>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <i class="fas fa-map-marker-alt orange-login-skb" />
                  <span class="fontPoppins fontSize14 fontW600 "> {{ company.city.name }} </span>
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  <span class="fontPoppins fontSize14 italic">{{ company.category.name }} </span>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class="mb-0 fontAlice fontSize16">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu interdum magna. Integer vitae nunc iaculis ...</p>
                </div>
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
    data() {
      return {

      };
    },
  };
</script>
