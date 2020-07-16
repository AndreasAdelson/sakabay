<template>
  <div>
    <div class="container">
      <div class="card">
        <img slot="image" class="img rounded img-raised" src="https://demos.creative-tim.com/vue-now-ui-kit-pro/img/project13.jpg"/>
        <div class="card-body">
          <h6 class="category text-warning">
            <i class="now-ui-icons business_bulb-63"></i> Focus
          </h6>
          <h5 class="card-title">
            <a href="#nuk">Stay Focused: Train Your Brain</a>
          </h5>
          <p class="card-footer">
            Our brains are finely attuned to distraction, so today's digital environment makes it
            especially hard to focus...
            {{ message }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
    components: {
        
    },
    props: {
      message: {
        type: String,
        default: 'Pd'
      }
    }
}
</script>