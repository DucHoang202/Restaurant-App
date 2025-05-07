<template>
    <Header></Header>
    <p>{{ favorites.id }}</p>
    <p>{{ favorites.foodID }}</p>
    <p>{{ favorites.name }}</p>
    <p>{{ favorites.image }}</p>
    <p>{{ favorites.votes }}</p>
    <button type="button" v-on:click="update(favorites.id)">Update</button>
</template>

<script>
import Header from './Header.vue';
import axios from 'axios'

export default {
    name: 'UpdatePage',
    components: {
        Header,
    },
    data ()
    {
        return {
            favorites: {
                id: '',
                foodID: '',
                name: '',
                image: '',
                votes: '',
                comments: []
            }

        }
    },
    methods: {
        async update(id) {
            const result = await axios.put('http://localhost:3000/favorites/' + id, {
            // const result = await axios.put('http://localhost:3000/favorites/' + this.$route.params.id, {
                votes: this.favorites.votes += 1,
                foodID: this.favorites.foodID,
                name: this.favorites.name,
                image: this.favorites.image,
                comments: this.favorites.comments
            });
            if (result.status == 200)
            {
                this.$router.push({name: 'UpdatePage'});
            }

        }
    },
    async mounted()
    {
            let user = localStorage.getItem("user-info")
            if (!user)
            {
                this.$router.push({name: 'LoginPage'})
            }
            const result = await axios.get('http://localhost:3000/favorites/' + this.$route.params.id)
            this.favorites = result.data
            console.warn("result", result)
        
    }
}
</script>