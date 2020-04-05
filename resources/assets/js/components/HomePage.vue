<template>

    <div class="container-fluid home">
        <competitions :leagues="leagues" @update-league="updateLeague"></competitions>
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
import Competitions from './partials/competitions'
export default {
    name: "HomePage",
    props: ['leagues'],
    components: {
        Competitions
    },
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
        standingsTable() {
            if (this.standingsdata.length > 0) {
                let totalTable = this.standingsdata.filter(tablobj => tablobj.type == "TOTAL");
                return totalTable[0].table;
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

    watch: {
      leagues() {
        if (this.leagues) {
            this.pullStandings(this.selectedLeague);
            this.pullResults(this.selectedLeague);
            this.pullFixtures(this.selectedLeague);
        }
      }

      // selectedLeague() {
      //   if (this.selectedLeague) {
      //       this.updateContent(this.selectedLeague);
      //   }
      // }
    },

    methods:{
      updateLeague(lgid) {
        // console.log(e);
        // this.selectedLeague = lgid;
        this.updateContent(lgid);
      },

      updateContent(leagueid) {
          this.pullStandings(leagueid);
          this.pullResults(leagueid);
          this.pullFixtures(leagueid);
      },

      pullStandings(leagueid) {
          this.apiUrl = '/api/standings/'+leagueid;
          axios.get(this.apiUrl)
          .then(response => {
              this.standingsdata = response.data;
          })
          .catch(error => {
              console.log(error);
          })
      },

      pullFixtures(leagueid) {
          this.matchday = this.getMatchday(leagueid);
          this.apiUrl = '/api/matchday/'+leagueid+'/'+(this.matchday+1);
          axios.get(this.apiUrl)
          .then(response => {
              this.fixturedata = response.data;
          })
          .catch(error => {
              console.log(error);
          })
      },

      pullResults(leagueid, matchday) {
          this.matchday = this.getMatchday(leagueid);
          this.apiUrl = '/api/matchday/'+leagueid+'/'+this.matchday;
          axios.get(this.apiUrl)
          .then(response => {
              this.resultsdata = response.data;
          })
          .catch(error => {
              console.log(error);
          })
      },


      getMatchday(leagueid) {
          let currLeagueobj = this.leagues.filter(lg => lg.id == leagueid);
          // return currLeagueobj[0].currentSeason.currentMatchday;
          return currLeagueobj[0].current_matchday;
      }

    },

    filters: {
        dateSubstr: function(datestring) {
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
