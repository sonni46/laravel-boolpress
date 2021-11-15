<template>
    <header>
        <div class="row">
            <div class="col-12" v-for="post in posts" :key="post.id">

            </div>
        </div>
    </header>
</template>

<script>
export default {
    name : 'Main',
    data() {
        return {
            url:'http://127.0.0.1:8000/api/posts',
            posts : [],
            api_token : 'PekImyqsD5QkPhkFeTBLeTAtwELvGZsTxo68S8cMw3F2gWjfkppET4D3ULmMiAEHjLtuKwNBDdsBhoMx',

        }
    },
    created() {
        this.getPost();
    },
    methods : {
        getPost() {

            const bosyParameters = {
                key: "value"
            };

            const config = {
                headers: {Autorization:`Bearer ${this.api_token}`}
            };


            axios.post(this.url, bosyParameters, config)
            .then(response =>{
                this.posts = response.data.results;
            })
            .catch();
        }
    }
}
</script>