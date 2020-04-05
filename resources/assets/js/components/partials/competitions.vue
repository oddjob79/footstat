<template>
  <div class="row justify-content-center">
    <b-form-group>
      <b-form-radio-group buttons v-model="selectedLeague" >
         <b-form-radio button v-for="league in leagues" :key="league.id" v-bind:value="league.id" @change="newLeague(league.id)">
           {{ league.league_name }}
         </b-form-radio>
      </b-form-radio-group>
    </b-form-group>
  </div>
</template>
<script>
export default {
    name: "Competitions",
    props: ['leagues'],
    data() {
        return {
            defaultLeague: '2021',
            apiUrl: '',
            selectedLeague: '2021',
            standingsdata: '',
            matchday: '',
            resultsdata: '',
            fixturedata: '',
        }
    },

    methods: {
      newLeague(leagueid) {
        this.$emit('update-league', leagueid)
      }
    }

    // watch: {
    //
    //     selectedLeague() {
    //         if (this.selectedLeague) {
    //             this.updateContent(this.selectedLeague);
    //         }
    //     }
    // }

}
</script>
<style>
.home {
    padding-top: 100px;
}

.fixtime {
    padding-right: .5em;
}

</style>
