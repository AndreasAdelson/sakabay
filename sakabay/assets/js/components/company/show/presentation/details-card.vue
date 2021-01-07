<template>
  <div class="row mt-3 card-skb">
    <div class="col-8">
      <div class="title-card-skb">
        <i class="fas fa-info-circle fa-lg yellow-login-skb" />
        <span class="fontPoppins underline">{{ $t('company.presentation.informations') }}</span>
      </div>
      <div class="details-card">
        <div class="number-line py-2">
          <i class="fas fa-phone-alt green-skb" />
          <span class="ml-2 fontAlice fontSize18">06 48 59 63 56</span>
        </div>
        <div class="number-line py-2">
          <i class="fas fa-map-marker-alt blue-skb" />
          <span class="ml-2 fontAlice fontSize18">{{ company.address.postal_address }}, {{ company.address.postal_code }} {{ company.city.name.toUpperCase() }}</span>
        </div>
        <div class="number-line py-2">
          <i class="fas fa-link orange-login-skb" />
          <span class="ml-2 fontAlice fontSize18">{{ company.address.postal_address }}, {{ company.address.postal_code }} {{ company.city.name.toUpperCase() }}</span>
        </div>
      </div>
    </div>
    <div class="col-4">
      <v-map
        :zoom="16"
        :center="[company.address.latitude, company.address.longitude]"
        style="height:300px"
      >
        <v-marker :lat-lng="[company.address.latitude, company.address.longitude]" />
        <v-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png" />
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
  };
</script>
