<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div>
          <b-table striped hover :items="items"></b-table>
          <b-button-group>
            <b-button>Button 1</b-button>
            <b-button>Button 2</b-button>
            <b-button>Button 3</b-button>
          </b-button-group>
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
    },

    data() {
      return {
        items: [
          { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { age: 38, first_name: 'Jami', last_name: 'Carney' }
        ]
      }
    }
}
</script>