<template>
    <Header></Header>
    <div class="container">
      <h2>Hello User, welcome on Find Page</h2>
      <input type="text" v-model="findName" placeholder="Food name" required />
      <input type="text" v-model="findNum" placeholder="Food amount" required />
      <button v-on:click="findFood()">Find</button>

      <table class="table table-striped" border="1px">
        <tr>
          <td>ID</td>
          <td>Title</td>
        </tr>
        <tr v-for="item in menuItems" :key="item.id">
          <td> {{ item.id }}</td>
          <td class="toHome" v-on:click="goTo(item.id)"> {{ item.title }}</td>
        </tr>
      </table>
  </div>
</template>

<script>
import axios from 'axios'
import Header from './Header.vue'; 

export default {
    name: 'FindPage',
    data() {
        return {
            food: '',
            number: '',
            menuItems: [],
            menuItem: {
                title: '',
                id: ''
            },
            myMenu: [],
            findName: 'burger',
            findNum: '2',
            favorites: {
                foodID: '',
                name: '',
                image: '',
                votes: 1,
                comments: []
            }
        }
    }, 
    components: {
        Header,
    }, 
    methods: {
      findFood() {
        localStorage.setItem("food-name", this.findName)
        localStorage.setItem("food-amount", this.findNum)
                localStorage.setItem("user-api", '26d4076d12044c1fa3f8428c7700f97a')
            localStorage.setItem("food-id", '')
            this.loadData()
      },
      goTo(id) {
        localStorage.setItem("food-id", id)
        this.$router.push({name: 'HomePage'})
        
      },
    async getMenuItems() {
      try {
  
        // for 

        
      } catch (error) {
        console.error('Error fetching menu items:', error);
      }
    },
    async loadData() {
      this.menuItems = []
      this.findName = localStorage.getItem("food-name")
      this.findNum = localStorage.getItem("food-amount")
            if (!(this.findName && this.findNum)) {
            this.findName = 'burger'
            this.findNum = '2'
        }
       // https://api.spoonacular.com/recipes/findByIngredients?ingredients=apples,+flour,+sugar&number=2
       
        const response = await axios.get('https://api.spoonacular.com/food/menuItems/suggest', {
        //const response = await axios.get('https://api.spoonacular.com/recipes/findByIngredients', {
          params: {
            // ingredients: this.findName,
            query: this.findName,
            number: this.findNum,
            apiKey: '26d4076d12044c1fa3f8428c7700f97a'
          }
        });
        this.menuItems = response.data;
        this.menuItems = this.menuItems['results']
        for (let i = 0; i < this.menuItems.length; i++ ) {
            this.menuItem = this.menuItems[i]
            if (this.menuItem !== null) this.myMenu.push(this.menuItem)
        } 
    }
  },

    
  async mounted() {
        
    this.loadData()
    this.findFood()
 
    }
}
 
</script>

<style>
table {
  padding-left: auto;
  padding-right: auto;
  margin-left: auto;
  margin-right: auto;
}
.toHome:hover {
  background-color: grey;
}
</style>