<template>
    <Header></Header>

    <button type="button" v-on:click="update">Like</button>
</template>

<script>
import Header from './Header.vue';
import axios from 'axios'

export default {
    name: 'AddPage',
    components: {
        Header,
    },
    data ()
    {
        return {
            favorites: {
                foodID: '',
                name: '',
                image: '',
                votes: 1,
                comments: []
            }

        }
    },
    methods: {
        async update() {
            localStorage.getItem("user-id")
            const result = await axios.post("http://localhost:3000/favorites", {
                foodID: this.favorites.foodID,
                name: this.favorites.name,
                image: this.favorites.image,
                votes: this.favorites.votes,
                comments: this.favorites.comments
            });
            console.warn("result", result)
        }
    },
    mounted()
    {
        
    }
}
</script>