<template>
  <div>
    <h2 class="center">My Application</h2>
    <div v-text="message"></div>
    {{ message }}
    <ul>
      <li :key="word.id" v-for="word in words">{{ word }}</li>
    </ul>
    
  <formulaire></formulaire>>
  
  </div>
</template>

<script>
import formulaire from './formulaire';

export default {
  components:{
    formulaire,
  },
  data() {
    return {
      message: "A list of words !!!",
      words: []
    };
  },
  mounted() {

    let el = document.querySelector("div[data-words]");
    let mywords = el.dataset.words.split(",");

    this.words.push.apply(this.words, mywords);
  }
};
</script>

<style>
.center {
  text-align: center;
}
</style>