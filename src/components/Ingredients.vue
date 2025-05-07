<template>
    <Header></Header>
    <h2>Hello User, welcome on Ingredients Page</h2>
    <div class="login">
        <div id="content"></div>
    </div> 
    
</template>

<script>
import axios from 'axios'
import Header from './Header.vue'; 

export default {
    name: 'ingredientsPage',
    data() {
        return {
            food: [],
            ingredients: [],
            recipes: {
                id: '',
                aisle: '',
                image: '',
                consistency: '',
                name: '',
                nameClean: '',
                original: '',
            summary: '',
            foodImage: '',
            title: '',
            prepare: '',
            MYapi:'26d4076d12044c1fa3f8428c7700f97a',
            foodID: '716429'
            }       
        }
    },
    components: {
        Header,

    },
    methods: {
        async loadData() {
            let fetchAPI = localStorage.getItem('user-api');
            let fetchID = localStorage.getItem('user-id');
            this.MYapi = fetchAPI;
            this.foodID = fetchID;
        }
    },

    async mounted () {
        this.loadData()
        this.foodID = 90629
        const response = await axios.get(`https://api.spoonacular.com/recipes/${this.foodID}/ingredientWidget`, {
          params: {
            apiKey: '26d4076d12044c1fa3f8428c7700f97a'
          }
        });
        this.ingredients = response.data;
        //this.food = result.data
        console.warn(this.ingredients)
        document.getElementById("content").innerHTML = this.ingredients
    }
}

// 26d4076d12044c1fa3f8428c7700f97a 

</script>

<style>
td {
  width: 160px;
  height: 40px;
}
.containing {
    padding: auto;
    margin: auto;
}
</style>