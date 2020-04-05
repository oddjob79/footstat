<template>
    <div class="container-fluid home">
      Please select a Team:
      <select v-model="teamname">
        <option>Tottenham</option>
        <option>Arsenal</option>
      </select>
      <p>The selected team is: {{ teamname }}</p>

      <button v-on:click="loadteamstats">Load stats</button>

    </div>
</template>
<script>
export default {

    name: "Stats",
    data() {
        return {
            teamname: '',
            teamstatsdata: '',
        }
    },

    methods: {
      loadteamstats: function (event) {
        // alert('test one '+this.teamname)
        this.apiUrl = '/api/stats/'+this.teamname;
        // this.apiUrl = '/api/stats';
        axios.get(this.apiUrl)
        .then(response => {
            this.teamstatsdata = response.data;
        })
        .catch(error => {
            console.log(error);
        })
      }
    }

}
</script>
<style>
.home {
    padding-top: 100px;
}

</style> */
