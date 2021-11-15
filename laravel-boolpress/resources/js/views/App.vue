<template>
    <div class="container">
        <Header />
        <Main />
    </div>
</template>

<script>
// si puo' decidere se togliere la destionazione o tenerla (io la tolgo che mi da degli erroiri) 
import Header from '../components/Header'
import Main from '../components/Main'
export default {
    name : 'App',
    components : {
        Header,
        Main,
    },
    data() {
        return {

        }
    },
    created() {

    },
    methods : {
        
    }
    
}
</script>

<style lang="sass" scoped>

</style>