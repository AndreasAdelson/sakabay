<template>
  <div class="container-fluid skb-body p-4 dashboard">
    <div v-show="loading">
      <div class="loader-container-full">
        <div class="loader" />
      </div>
    </div>
    <div class="row justify-content-between pt-4 mb-4">
      <div class="col-4 align-self-center">
        <i class="far fa-copy grey-skb fontSize20 mr-2" />
        <h1 class="text-center fontPoppins fontSize20 dashboard-title">
          {{ $t('opportunity.title_list') }}
        </h1>
      </div>
    </div>
    <div class="container opportunity-list">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row scroll-h650">
                <vuescroll :ops="opsButton">
                  <div class="col" >

                    </div>
                </vuescroll>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  import _ from 'lodash';
  import vuescroll from 'vuescroll';


  export default {
    components: {
      vuescroll,
    },
    props: {
      utilisateurId: {
        type: Number,
        default: null
      }
    },
    data() {
      return {
        loading: false,
        opsButton: {
          bar: {
            keepShow: true,
            minSize: 0.3,
          },
          rail: {
            background: '#c5c9cc',
            opacity: 0.4,
            size: '6px',
            specifyBorderRadius: false,
            gutterOfEnds: '1px',
            gutterOfSide: '2px',
            keepShow: false
          },
        },
      };
    },
    created() {
      // let promises = [];
      // promises.push(axios.get('/api/besoins/utilisateur/' + this.utilisateurId,{
      //   params: {
      //     codeStatut: 'PUB'
      //   }
      // }
      // ));
      // promises.push(axios.get('/api/besoins/utilisateur/' + this.utilisateurId,{
      //   params: {
      //     codeStatut: 'ENC'
      //   }
      // }
      // ));
      // return Promise.all(promises).then(res => {
      //   this.loading = false;
      //   this.pendingBesoins = _.cloneDeep(res[0].data);
      //   this.expiredBesoins = _.cloneDeep(res[1].data);
      // }).catch(e => {
      //   this.$handleError(e);
      //   this.loading = false;
      // });
    },
    methods: {
    }

  };
</script>
