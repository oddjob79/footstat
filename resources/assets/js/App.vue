<template>
    <div id="app">
        <FootStatHeader/>
        <HomePage/>
        <!-- <div class="container">
            <router-view /> -->
        <!-- </div> -->
    </div>
</template>

<script>
    import FootStatHeader from './components/FootStatHeader';
    import HomePage from './components/HomePage';
    // import Competitions from './components/partials/competitions';
    import Stats from './components/Stats';

    // Vue.component('Competitions', {
    //   props: ['leagues']
    //   // ,
    //   // components: { Competitions }
    // })


    export default {
        name:"App",
        components: {
            FootStatHeader,
            HomePage,
            Stats
        },

      data() {
          return {
              leagues: {}
          }
      },

      watch: {
        created() {
            this.getLeagues();
        }
      },

      methods: {
          getLeagues() {
              axios.get('/api/leagues')
              .then(response => {
                  this.leagues = response.data;
              })
              .catch(error => {
                  console.log(error);
              })
          }
      }
    }

</script>

<style scoped>
#app {
	max-width: 400px;
	margin: 0 auto;
	line-height: 1.4;
	font-family: 'Avenir', Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	color: $vue-blue;
}
</style>
