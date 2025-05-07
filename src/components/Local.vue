<template>
   <Header></Header>
    <div class="container" border="1px">
      <h2>Welcome {{ name }}</h2>
      <div class="row" >
    <div class="table-responsive col-md-9">
           <table >
          <tr>
            <td><aria-label for="code">ID:</aria-label></td>
            <td><aria-label for="desc">Name:</aria-label></td>
          </tr>
          <tr>
            <td><input type="text" aria-label="Code:" name="code" id="code" v-model="searchArray.foodID"/></td>
            <td><input type="text" aria-label="Description:" name="desc" id="desc" v-model="searchArray.name"/></td>
           </tr>
        </table>

      </div>
      <table class="col-md-3">
          <th>Ingredient:</th>
                  <tr> 
            <td class="dropdown">
              <div class="dropdown-content"> 
                             <input type="radio" aria-label="Code:" value="" name="core" id="all" v-model="searchArray.type" />
              <aria-label for="core">All</aria-label><br>
              <input type="radio" aria-label="Code:" value="Garlic" name="core" id="core" v-model="searchArray.type"/>
              <aria-label for="core">Garlic</aria-label><br>
              <input type="radio" aria-label="Code:" value="Bean" name="core" id="software" v-model="searchArray.type"/>
              <aria-label for="core">Bean</aria-label><br>
              <input type="radio" aria-label="Code:" value="Honey" name="core" id="system" v-model="searchArray.type"/>
              <aria-label for="core">Honey</aria-label><br>
    <input type="radio" aria-label="Code:" value="Tomato" name="core" id="tomato" v-model="searchArray.type"/>
    <aria-label for="tomato">Tomato</aria-label><br>
    <input type="radio" aria-label="Code:" value="Onion" name="core" id="onion" v-model="searchArray.type"/>
    <aria-label for="onion">Onion</aria-label><br>
    <input type="radio" aria-label="Code:" value="Chicken" name="core" id="chicken" v-model="searchArray.type"/>
    <aria-label for="chicken">Chicken</aria-label><br>
    <input type="radio" aria-label="Code:" value="Beef" name="core" id="beef" v-model="searchArray.type"/>
    <aria-label for="beef">Beef</aria-label><br>
    <input type="radio" aria-label="Code:" value="Pork" name="core" id="pork" v-model="searchArray.type"/>
    <aria-label for="pork">Pork</aria-label><br>
    <input type="radio" aria-label="Code:" value="Fish" name="core" id="fish" v-model="searchArray.type"/>
    <aria-label for="fish">Fish</aria-label><br>
    <input type="radio" aria-label="Code:" value="Shrimp" name="core" id="shrimp" v-model="searchArray.type"/>
    <aria-label for="shrimp">Shrimp</aria-label><br>
    <input type="radio" aria-label="Code:" value="Tofu" name="core" id="tofu" v-model="searchArray.type"/>
    <aria-label for="tofu">Tofu</aria-label><br>
    <input type="radio" aria-label="Code:" value="Mushroom" name="core" id="mushroom" v-model="searchArray.type"/>
    <aria-label for="mushroom">Mushroom</aria-label><br>
    <input type="radio" aria-label="Code:" value="Carrot" name="core" id="carrot" v-model="searchArray.type"/>
    <aria-label for="carrot">Carrot</aria-label><br>
    <input type="radio" aria-label="Code:" value="Potato" name="core" id="potato" v-model="searchArray.type"/>
    <aria-label for="potato">Potato</aria-label><br>
    <input type="radio" aria-label="Code:" value="Broccoli" name="core" id="broccoli" v-model="searchArray.type"/>
    <aria-label for="broccoli">Broccoli</aria-label><br>
    <input type="radio" aria-label="Code:" value="Spinach" name="core" id="spinach" v-model="searchArray.type"/>
    <aria-label for="spinach">Spinach</aria-label><br>
    <input type="radio" aria-label="Code:" value="Bell Pepper" name="core" id="bellpepper" v-model="searchArray.type"/>
    <aria-label for="bellpepper">Bell Pepper</aria-label><br>
    <input type="radio" aria-label="Code:" value="Zucchini" name="core" id="zucchini" v-model="searchArray.type"/>
    <aria-label for="zucchini">Zucchini</aria-label><br>
    <input type="radio" aria-label="Code:" value="Eggplant" name="core" id="eggplant" v-model="searchArray.type"/>
    <aria-label for="eggplant">Eggplant</aria-label><br>
    <input type="radio" aria-label="Code:" value="Cucumber" name="core" id="cucumber" v-model="searchArray.type"/>
    <aria-label for="cucumber">Cucumber</aria-label><br>
    <input type="radio" aria-label="Code:" value="Lettuce" name="core" id="lettuce" v-model="searchArray.type"/>
    <aria-label for="lettuce">Lettuce</aria-label><br>
    <input type="radio" aria-label="Code:" value="Cabbage" name="core" id="cabbage" v-model="searchArray.type"/>
    <aria-label for="cabbage">Cabbage</aria-label><br>
    <input type="radio" aria-label="Code:" value="Avocado" name="core" id="avocado" v-model="searchArray.type"/>
    <aria-label for="avocado">Avocado</aria-label><br>
    <input type="radio" aria-label="Code:" value="Apple" name="core" id="apple" v-model="searchArray.type"/>
    <aria-label for="apple">Apple</aria-label><br>
    <input type="radio" aria-label="Code:" value="Banana" name="core" id="banana" v-model="searchArray.type"/>
    <aria-label for="banana">Banana</aria-label><br>
    <input type="radio" aria-label="Code:" value="Orange" name="core" id="orange" v-model="searchArray.type"/>
    <aria-label for="orange">Orange</aria-label><br>
    <input type="radio" aria-label="Code:" value="Strawberry" name="core" id="strawberry" v-model="searchArray.type"/>
    <aria-label for="strawberry">Strawberry</aria-label><br>
    <input type="radio" aria-label="Code:" value="Blueberry" name="core" id="blueberry" v-model="searchArray.type"/>
    <aria-label for="blueberry">Blueberry</aria-label><br>
    <input type="radio" aria-label="Code:" value="Raspberry" name="core" id="raspberry" v-model="searchArray.type"/>
    <aria-label for="raspberry">Raspberry</aria-label><br>
    <input type="radio" aria-label="Code:" value="Grape" name="core" id="grape" v-model="searchArray.type"/>
    <aria-label for="grape">Grape</aria-label><br>
    <input type="radio" aria-label="Code:" value="Pineapple" name="core" id="pineapple" v-model="searchArray.type"/>
    <aria-label for="pineapple">Pineapple</aria-label><br>

              </div>
            </td>
            
          </tr>
      </table>
      </div>


  <h3>{{ filterPost.length }} results</h3>
  <div class="row">
  <div class="col-md-3 card" v-for="item in showPost" :key="item.id">
    
        <img v-bind:src=" item.image" @click="goTo(item.foodID)" class="card-img-top" />
       <div class="card-body">
          <h5 class="card-title">
          {{ item.foodID }}: <strong>{{ item.name }} </strong> </h5>
          <p class="card-text">{{ item.vote}}</p>
          <p v-if="item.comments!=null" style="font: 150%;"><strong>"{{item.comments[0]}}" </strong> </p>
          <button class="btn btn-primary" type="button" @click="goTo(item.foodID)">Find more</button>

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
name: 'LocalPage',
components: {
  Header,
},
data() {
        return {
            currentPage: 1,
            itemPerPage: 8,
            posts: [],
            searchArray: { foodID: '', name: '', cp: 0.0, type: '' },
        
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
        //take into show post
    filterPost() {
        return this.posts
              .filter(
                (item) =>
                
                  item.foodID.match(this.searchArray.foodID) &&
                  item.name.toLowerCase().match(this.searchArray.name) &&
                item.name.toLowerCase().match(this.searchArray.type.toLowerCase()) 

        )

          
      },
      showPost() {
                const startPage = (this.currentPage -1 )* this.itemPerPage
        const endPage = startPage + this.itemPerPage;
        return this.filterPost.slice(startPage, endPage)
      },
    totalPages() {
        return Math.ceil(this.filterPost.length / this.itemPerPage);
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
      goTo(item) {
        localStorage.setItem('food-id', item)
            this.$router.push({name: 'HomePage'})
          },
            
        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
              this.currentPage = page;
            }
          },
        // async deleteRestaurant(id) {
        //     const response = await axios.delete('http://localhost:3000/favorites/' + id)
      
        //     if (response.status == 200)
        //     {
        //         this.loadData()
        //     }
        // },
        async loadData()
        {
          {
            let user = localStorage.getItem("user-info")
            if (user) {
              this.name = JSON.parse(user).name
            } else {
              this.name = 'Guest'
            }
            let result = await axios.get("http://localhost:3000/local")
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