<template>
    <div class="container-fluid" style="padding-top: 30px;">
        This is the home page b
        <br>
        <br>

        <select v-model="selectedLeague" @change="pullStandings(selectedLeague)">
          <option v-for="league in leaguedata" v-bind:value="league.id" :selected="league.id==2021">
            {{ league.name }}
          </option>
        </select>
        <span>Selected: {{ selectedLeague }}</span>
        <br>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Pos.</th>
                    <th>Team</th>
                    <th>Pl</th>
                    <th>W</th>
                    <th>D</th>
                    <th>L</th>
                    <th>F</th>
                    <th>A</th>
                    <th>GD</th>
                    <th>Pts</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in standingsTable">
                    <td>{{ row.position }}</td>
                    <td>{{ row.team.name }}</td>
                    <td>{{ row.playedGames }}</td>
                    <td>{{ row.won }}</td>
                    <td>{{ row.draw }}</td>
                    <td>{{ row.lost }}</td>
                    <td>{{ row.goalsFor }}</td>
                    <td>{{ row.goalsAgainst }}</td>
                    <td>{{ row.goalDifference }}</td>
                    <td>{{ row.points }}</td>
                </tr>
            </tbody>
        </table>
        
    </div>
</template>
<script>
export default {

    name: "HomePage",
    
    data() {
        return {
            apiUrl: '',
            leaguedata: '',
            selectedLeague: 'Premier League',
            standingsdata: '',
            standingsTable: ''
        }
    },
    
 /*   computed: {
        standingsTable: function() {
            for (obj in this.standingsdata) {
                if (obj.type == "TOTAL") {
                    return obj.table;
                }
            }
        }
    },
*/    
    mounted() {
        this.pullLeagues();
        this.pullStandings(2021);
    },
    
    methods:{
        pullLeagues() {
            axios.defaults.headers.common = {
              "X-Auth-Token": "13c6b55f8b8a4e2aa431cc56aa377eb2"
            }
            this.apiUrl = 'http://api.football-data.org/v2/competitions?plan=TIER_ONE'
            axios.get(this.apiUrl)
            .then(response => {
                this.leaguedata = response.data.competitions;
            })
            .catch(error => {
                console.log(error);
            })
        },
        pullStandings(leagueid) {
            this.apiUrl = 'http://api.football-data.org/v2/competitions/'+leagueid+'/standings';
            axios.get(this.apiUrl)
            .then(response => {
                this.standingsdata = response.data.standings;
                console.log(this.standingsdata);
                this.standingsdata.forEach((tablobj) => {
                    if (tablobj.type == 'TOTAL') {
                        this.standingsTable = tablobj.table;
                    }
                });

                console.log(this.standingsTable);
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>
<style>
</style>
