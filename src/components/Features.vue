<template>
   <Header></Header>
    <div class="container" border="1px">
      <h2>Welcome {{ name }}</h2>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
      <div class="carousel-inner" >
        <div class="mainShow" v-if="restaurant != null" >
          <div  v-for="item in restaurant" :key="item.id">
            <div class="carousel-item active" >
              <img v-bind:src="item.image" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h2>{{ item.name }}</h2>
                <h3>Search {{ item.foodID }} </h3>
              </div>
            </div>
          </div>
      </div>
      <div v-else><img src="pic.jpg">hello</div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  <h3>Maybe you like</h3>
  <div class="row">
  <div class="col-md-3 card" v-for="item in showPost" :key="item.id">
    
        <router-link :to="'/forum/'+item.id"><img v-bind:src=" item.image" class="card-img-top" /></router-link>
       <div class="card-body">
          <h5 class="card-title">
          {{ item.foodID }}: <strong>{{ item.name }} </strong> </h5>
            <!-- Example single danger button -->
          <div class="dropdown " @click="alert(item.votes)">
            <span class="btn-primary">
              Votes: {{ item.votes.length}}
            </span>
            <div class="dropdown-content" v-for="get in item.votes" :key="get.id">
              <p>{{ get }}</p>
            </div>
          </div>
        
          <p v-if="item.comments!=null" style="font: 150%;"><strong>"{{item.comments[0]}}" </strong> </p>
          <button class="btn btn-primary" type="button" v-on:click="deleteRestaurant(item.id)">Delete</button>

      </div>
   </div>
   </div>
   <nav label="Here">
   <ul class="pagination justify-content-center mt-4">
   <li class="page-item">
      <a class="page-link" href="#" @click="changePage(currentPage -1)" :disabled="currentPage === 1">Previous</a>
      </li>

 <li class="page-item" v-for="pageNumber in showPageNumbers" :key="pageNumber" :class="{active:currentPage == pageNumber || PageNumber === '...'}">
            <a class="page-link" href="#" @click="changePage(pageNumber)">{{pageNumber}}</a>
 </li>    

   <li class="page-item">
      <a class="page-link" href="#" @click="changePage(currentPage +1)" :disabled="currentPage === totalPages">Next</a>
      </li>
    </ul>
   </nav>
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
            currentPage: 1,
            itemPerPage: 4,
            posts: [],

            name: [],
            restaurant: [],
            favorites: {
                id: '',
                foodID: '',
                name: '',
                image: '',
                votes: 0,
                comments: [],
            },
            commentsLine: '',
            
        }
      },
    computed: {
    showPost() {
        const startPage = (this.currentPage -1 )* this.itemPerPage
        const endPage = startPage + this.itemPerPage;
        return this.posts.slice(startPage, endPage);
    },
    totalPages() {
        return Math.ceil(this.posts.length / this.itemPerPage);
    },
    showPageNumbers() {
        let pageCount = [];
        if (this.totalPages <= 6) {
            for (let i = 1; i <= this.totalPages; i++) {
                pageCount.push(i)
            }
        } else {
        if (this.currentPage <= 5 ) {
            pageCount = [1,2,3,4,5, "...", this.totalPages];
        } else if (this.currentPage >= this.totalPages - 3)
            {
                pageCount = [1, '...', this.totalPages - 4, this.totalPages - 3,this.totalPages - 2, this.totalPages - 1, this.totalPages ]
            }
        else {
            pageCount = [1, '...', this.currentPage - 1, this.currentPage, this.currentPage + 1, '...', this.totalPages]
        
        }
    }
        
        return pageCount;
    }
},
  methods: {
    alert(array) {
      let post = '';
      for (let i = 0; i < array.length; i++) {
        post += array[i] + "\n"; 
      }

      alert("Users have liked:\n" + post); 
    },

                
        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
              this.currentPage = page;
            }
          },
        async deleteRestaurant(id) {
            const response = await axios.delete('http://localhost:3000/favorites/' + id)
      
            if (response.status == 200)
            {
                this.loadData()
            }
        },
        async loadData()
        {
          {
            let user = localStorage.getItem("user-info")
            if (user) {
              this.name = JSON.parse(user).name
            } else {
              this.name = 'Guest'
            }
            let result = await axios.get("http://localhost:3000/favorites")
            this.posts = result.data;
            this.restaurant  = result.data;
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
h2, h3 {
  font-size: 50px;
  color: white;
  -webkit-text-stroke: 1px black;
}
.likeButton button{
  margin-top: auto;
  margin-bottom: auto;
  padding-top: auto;
  padding-bottom: auto;
}
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>