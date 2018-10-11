<template>

    <div class="container-fluid home">
        <div class="row">
            <b-form-group>
              <b-form-radio-group buttons v-model="selectedLeague" >
                 <b-form-radio button v-for="league in filteredLeagues" :key="league.id" v-bind:value="league.id">{{ league.name }}</b-form-radio>
              </b-form-radio-group>   
            </b-form-group>        
        </div>        
        <div class="row">
            <div class="col-sm">
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
                        <tr v-for="row in standingsTable" :key="row.id">
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
            <div class="col-sm">
                </br><b>Results</b></br>
                <table>
                <tr v-for="res in resultsdata" :key="res.id">
                    <td>{{ res.homeTeam.name }}</td>
                    <td>{{ res.score.fullTime.homeTeam }}</td>
                    <td> - </td>
                    <td>{{ res.score.fullTime.awayTeam }}</td>                    
                    <td>{{ res.awayTeam.name }}</td>
                </tr>
                </table>
                </br><b>Fixtures</b></br>
                <div v-for="date in scheduledGames"><h6>{{ date | dateSubstr }} </h6>
                    <table v-for="fixt in fixturedata" :key="fixt.id">
                        <tr v-if="date == fixt.utcDate.substring(0, 10)">
                            <td class="fixtime">{{ fixt.utcDate | timeSubstr }}</td>
                            <td>{{ fixt.homeTeam.name }}</td>
                            <td> vs. </td>
                            <td>{{ fixt.awayTeam.name }}</td>
                        </tr>
                    </table></br>
                </div>
             </div>
        </div>
    </div>
</template>
<script>
export default {

    name: "HomePage",
    
    data() {
        return {
            defaultLeague: '2021',
            apiUrl: '',
            leaguedata: '',
            selectedLeague: '2021',
            standingsdata: '',
            matchday: '',
            resultsdata: '',
            fixturedata: '',
        }
    },
    
    computed: {
        standingsTable() {
            if (this.standingsdata.length > 0) {
                let totalTable = this.standingsdata.filter(tablobj => tablobj.type == "TOTAL");
                return totalTable[0].table;
            }
        },
        
        filteredLeagues() {
            if (this.leaguedata.length > 0) {
                let excludedAreas = [
                    2077, // Europe (Champs League & Euros)
                    2032, // Brazil
                    2267 // World (World Cup)
                ];

                return this.leaguedata.filter(lg => excludedAreas.indexOf(lg.area.id) == -1);
             }
        },
        
        scheduledGames() {
            if (this.fixturedata.length > 0) {
                let dateArray = this.fixturedata.map(fd => fd.utcDate.substring(0, 10));
                let uniqueDates = [...new Set(dateArray)];
                return uniqueDates;
            }
        }
        
    },
    
    created() {
        this.pullLeagues();
        this.pullStandings(this.selectedLeague);
//        this.pullResults(this.defaultLeague);
    },
    
    watch: {
        leaguedata() {
            if (this.leaguedata) {
                this.pullResults(this.selectedLeague);
                this.pullFixtures(this.selectedLeague);                
            }
        },
        
        selectedLeague() {
            if (this.selectedLeague) {
                this.updateContent(this.selectedLeague);
            }
        }
    },
    
    methods:{
        updateContent(leagueid) {
            this.pullStandings(leagueid);
            this.pullResults(leagueid);
            this.pullFixtures(leagueid);            
        },
    
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
            })
            .catch(error => {
                console.log(error);
            })
        },
        
        pullResults(leagueid) {
            this.matchday = this.getMatchday(leagueid);
//            console.log('result matchday = '+this.matchday-1);
            this.apiUrl = 'http://api.football-data.org/v2/competitions/'+leagueid+'/matches?matchday='+(this.matchday-1);
            axios.get(this.apiUrl)
            .then(response => {
                this.resultsdata = response.data.matches;
//                console.log(this.resultsdata);
            })
            .catch(error => {
                console.log(error);
            })
        },

        pullFixtures(leagueid) {
            this.matchday = this.getMatchday(leagueid);
//            console.log('result matchday = '+this.matchday-1);
            this.apiUrl = 'http://api.football-data.org/v2/competitions/'+leagueid+'/matches?matchday='+this.matchday;
            axios.get(this.apiUrl)
            .then(response => {
                this.fixturedata = response.data.matches;
//                console.log(this.resultsdata);
            })
            .catch(error => {
                console.log(error);
            })
        },
        
        
        getMatchday(leagueid) {
            let currLeagueobj = this.leaguedata.filter(lg => lg.id == leagueid);
            return currLeagueobj[0].currentSeason.currentMatchday;
        },  
        
    },

    filters: {
        dateSubstr: function(datestring) {
//            let reconDate = datestring+'T14:00:00Z'
            let localDateTime = new Date(datestring+'T14:00:00Z');
            return localDateTime.toDateString();
            
        },
        
        timeSubstr: function(datestring) {
            let localDateTime = new Date(datestring);
            return localDateTime.toTimeString().substring(0, 5);
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
