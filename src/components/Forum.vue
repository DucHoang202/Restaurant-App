<template>
<div class="container">
        <Header></Header>
        <div class="container">
        <h2>Welcome {{name}}</h2>
        <h3 v-highlight>What are your thoughts on {{favorites.name}}?</h3>
        <div class="container">
        <div class="forum-index">
                <img v-bind:src="favorites.image"><br>
                <p v-highlight>               {{ favorites.foodID }}:
                {{ favorites.name }}</p><br>
                {{ favorites.votes.length }} upvotes            0 downvotes<br>
          <input v-model="commentsLine" type="text" />
           <span> <button type="button" v-on:click="commented(commentsLine)">Comment</button></span>

         
        <!-- <button type="button" v-on:click="update()">Like</button>
        {{ favorites.votes }} -->
         <div class="under">
                <td v-highlight>         
                    <tr v-for="com in favorites.comments" :key="com">
                        <td><img src="#">{{ com }}</td>
                    </tr>   
                </td>
         </div>
            </div>
            </div>
      </div>
      </div>
      

  </template>
  
  <script>
  import Header from './Header.vue';
  import axios from 'axios'


  export default {
  name: 'ForumPage',
  components: {
    Header,
  },
  directives: {
    focus: {
      inserted: function (el) {
        el.focus();
      }
    },
    color: {
      bind: function (el, binding) {
        el.style.color = binding.value;
      }
    },
    tooltip: {
      bind: function (el, binding) {
        el.setAttribute('title', binding.value);
      }
    }
    },
  data() {
    return {
        user: '',
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
        
    }
  },
  methods: {
    async commented(commentsLine) {
      if (this.user) {
        const response = await axios.get('http://localhost:3000/favorites/' + this.$route.params.id)
        this.favorites = response.data
        commentsLine = this.name + " said: " + commentsLine
        this.favorites.comments.push(commentsLine)
        const result = await axios.put('http://localhost:3000/favorites/' + this.$route.params.id, {
          votes: this.favorites.votes,
          foodID: this.favorites.foodID,
          name: this.favorites.name,
          image: this.favorites.image,
          comments: this.favorites.comments
        });
        if (result.status == 200) {
          this.loadData()
        }
      } else {
        this.$router.push({name: "LoginPage"})
      }
      
        },
    async update() {
      if (this.user) {
        const response = await axios.get('http://localhost:3000/favorites/' + this.$route.params.id)
        this.favorites = response.data
        console.warn(this.name)
        this.favorites.votes.push(this.name)
        const result = await axios.put('http://localhost:3000/favorites/' + this.$route.params.id, {
          votes: this.favorites.votes,
          foodID: this.favorites.foodID,
          name: this.favorites.name,
          image: this.favorites.image,
          comments: this.favorites.comments
        });
        if (result.status == 200) {
          this.loadData()
        }
      } else {
        this.$router.push({name: "LoginPage"})
      }
        },
    async loadData()
    {
      {
        this.user = localStorage.getItem("user-info");
        if(this.user) {
          this.name = JSON.parse(this.user).name;
        } else {
          this.name = 'Guest'
        }
        try {
          let result = await axios.get('http://localhost:3000/favorites/'+this.$route.params.id)
          this.favorites = result.data
        } catch(e) {
          console.log(e)
          console.log("Waiting to load data...")
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
  .forum-index {
    border-radius: 2px;
    border-color: grey;
    font: 300%;
  }
  .under td{
    width: 2500%;
    text-align: left;
  }
  </style>
