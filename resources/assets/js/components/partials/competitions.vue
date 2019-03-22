<template>

    <div class="container-fluid home">
        <div class="row">
            <b-form-group>
              <b-form-radio-group buttons v-model="selectedLeague" >
                 <b-form-radio button v-for="league in filteredLeagues" :key="league.id" v-bind:value="league.id">{{ league.name }}</b-form-radio>
              </b-form-radio-group>   
            </b-form-group>        
        </div>        
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

   computed: {
        
        filteredLeagues() {
            if (this.leagues.length > 0) {            
                let excludedAreas = [
                    2077, // Europe (Champs League & Euros)
                    2032, // Brazil
                    2267 // World (World Cup)
                ];

                return this.leagues.filter(lg => excludedAreas.indexOf(lg.area.id) == -1);
             }
        }
    },
    
    watch: {
        
        selectedLeague() {
            if (this.selectedLeague) {
                this.updateContent(this.selectedLeague);
            }
        }
    }
    
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
