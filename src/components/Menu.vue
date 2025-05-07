<template>
<div class="container">
        <Header></Header>
  <h1>Hello {{ name }}</h1>
  <div class="row">
  <div class="col-md-3 card" v-for="(item, index) in posts" :key="item.id">
    
    
          <img v-bind:src=" item.image" class="card-img-top" @click="changeDir(item.foodID)"/>
       <div class="card-body">
          <h5 class="card-title">
          {{ item.foodID }}: <strong>{{ item.name }} </strong> </h5>
          <input class="face" type="text" v-model="item.note"><button type="button" @click="note(index, item.note)">Note</button>
          <p class="card-text">{{ item.vote}}</p>
          <p v-if="item.comments!=null" style="font: 150%;"><strong>"{{item.comments[0]}}" </strong> </p>
          <button class="btn btn-primary" type="button" v-on:click="remove(index)">Delete</button>

      </div>
   </div>
   </div>
      </div>
      

  </template>
  
  <script>
  import Header from './Header.vue';
  import axios from 'axios'
  
  export default {
  name: 'MenuPage',
  components: {
    Header,
  },
  data() {
    return {
        preNote: '',
        user: '',
        id: '',
        name: '',
        restaurant: [],
        favorites: {
            id: '',
            foodID: '',
            name: '',
            image: '',
            votes: [],
            comments: [],

        },
      commentsLine: '',
      posts: []
        
    }
  },
    methods: {
      changeDir(item) {
        localStorage.setItem("food-id", item)
        this.$router.push({name: 'HomePage'})
      },
      async remove(index) {
        if (index > -1) {
          this.posts.splice(index, 1)
        }
        if (this.user) {
          await axios.put(`http://localhost:3000/user/${this.id}`, {
            id: this.id,
            email: JSON.parse(this.user).email,
            name: JSON.parse(this.user).name,
            password: JSON.parse(this.user).password,
            menu: this.posts,
          })
            .then(response => {
              console.log('Success:', response);
            })
            .catch(error => {
              console.error('Error:', error.response ? error.response.data : error.message);
            });
                    } else {
                this.$router.push({name: 'LoginPage'})
            }
      },
      async note(index, message) {
        this.posts[index].note = message
        console.warn(message)
        await axios.put(`http://localhost:3000/user/${this.id}`, {
            id: this.id,
            email: JSON.parse(this.user).email,
            name: JSON.parse(this.user).name,
            password: JSON.parse(this.user).password,
            menu: this.posts,
          })
            .then(response => {
              console.log('Success:', response);
            })
            .catch(error => {
              console.error('Error:', error.response ? error.response.data : error.message);
            });

      },
    async loadData()
        {
      {
            this.user = localStorage.getItem("user-info")
            if (this.user) {
              this.id = JSON.parse(this.user).id
              this.name = JSON.parse(this.user).name
            } else {
              this.$router.push({name: 'LoginPage'})
            }


        let result = await axios.get(`http://localhost:3000/user?id=${this.id}`)
        this.restaurant = result.data;
        for (let i = 0; i < this.restaurant.length; i++) {
          console.warn(this.restaurant[i].menu.length)
          for (let y = 0; y < this.restaurant[i].menu.length; y++) {
            let say = this.restaurant[i].menu[y] 
            if (say) {
              this.posts.push(say)
            }
          }
        }
        
      }
          
        }
  },
  
  async mounted()
  {
    this.loadData()
  }
  }
  </script>

<style>
@media (max-width: 1470px) {
  .face {
    width: 100px;
  }

  }

</style>