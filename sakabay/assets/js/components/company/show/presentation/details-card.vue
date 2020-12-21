<template>
  <div class="row mt-3 card-skb">
    <div class="col-8">
      <div class="title-card-skb">
        <span class="fontPoppins">{{$t('company.presentation.title')}}</span>
      </div>
      <div class="details-card">
        <div class="number-line py-2">
          <i class="fas fa-phone-alt green-skb"></i>
          <span class="ml-2 fontAlice fontSize18">06 48 59 63 56</span>
        </div>
        <div class="number-line py-2">
          <i class="fas fa-map-marker-alt yellow-login-skb"></i>
          <span class="ml-2 fontAlice fontSize18">{{ company.address.postal_address }}, {{ company.address.postal_code }} {{ company.city.name.toUpperCase() }}</span>
        </div>
        <div class="number-line py-2">
          <i class="fas fa-link orange-login-skb"></i>
          <span class="ml-2 fontAlice fontSize18">{{ company.address.postal_address }}, {{ company.address.postal_code }} {{ company.city.name.toUpperCase() }}</span>
        </div>
      </div>
    </div>
    <div class="col-4">
      <v-map
        :zoom=16
        :center="[company.address.latitude, company.address.longitude]"
        style="height:300px"
      >
        <v-marker :lat-lng="[company.address.latitude, company.address.longitude]"></v-marker>
        <v-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></v-tile-layer>
      </v-map>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    company: {
      type: Object,
      default: null
    }
  }
}
</script>
