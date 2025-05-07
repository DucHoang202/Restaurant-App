<template>
    <Header></Header>
    <div class="container">
    <div id="errHandler">
    <div v-if="iVoted==false">
        <button class="btn btn-secondary" type="button" style="font: blue;" v-on:click="like()">Like</button>
    </div>
    <div v-else><button class="btn btn-primary" type="button" @click="unlike()">You voted!</button></div><br>
    <span>
    <div v-if="iAdded==false">
         <button type="button" style="font: red;" class="btn btn-secondary" v-on:click="addMenu()">Add menu</button>
    </div>
    <div v-else><button class="btn btn-danger" type="button" @click="removeMenu()">You added!</button></div>
        </span>
    <h2>{{  title }} </h2>
        <h3>Cooking in {{  prepare }} minutes </h3><br>
        <img v-bind:src="foodImage"><br>
        <p>Summary</p>
        <div id="overview"></div>
        <p style="margin-left: auto; margin-right: auto;">Ingredients</p>

        <table style="margin-left: auto; margin-right: auto;" border="1px">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Aisle</td>
                <td>Original</td>
            </tr>
            <tr v-for="item  in ingredients" :key="item.id">
                <td>{{ item.id }}</td>
                <!-- <td>{{ item.consistency }}</td> -->
                <td>{{ item.name }}</td>
                <td>{{ item.aisle }}</td>
                <td>{{ item.original }}</td>

            </tr>
        </table>
    </div>
    </div>
</template>

<script>
import axios from 'axios'
import Header from './Header.vue'; 

const comm = [
    "An adventure of taste", 
    "My children likes it", 
    "An unforgetable taste", 
    "The ambrosia of the Olympus",
    "Easy yet tasty", 
    "Let 'em cook", 
    "I had this in my childhood", 
    "Lovely", 
    "Unforgetable",
    "A symphony of flavors.",
    "A culinary masterpiece.",
    "A feast for the senses.",
    "Simply divine.",
    "A taste of heaven.",
    "Pure indulgence.",
    "A delightful treat.",
    "An explosion of flavors.",
    "A gourmet delight.",
    "A taste sensation.",
    "A flavor journey.",
    "Absolutely mouthwatering."
];
export default {
    name: 'HomePage',
    data() {
        return {
            registerFood: false,
            user: '',
            iVoted: false,
            iAdded: false,
            numAdded: -2,
            numLiked: -2,
            takeAway: '',
            favorite:'',
            id: '',
            menus: [],
            menu: {
                foodID: '',
                name: '',
                image: '',
                note: ''
            },
            name: '',
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
            foodID: '716429',
            favorites: {
                foodID: '',
                name: '',
                image: '',
                votes: [],
                comments: []
            }
            }       
        }
    },
    components: {
        Header,

    },
    computed: {
    },
    methods: {
        nonUser() {
            if (!this.user) {
                this.$router.push({ name: 'LoginPage' });
            }
        },
        async loadMenu() {
            this.MYapi = localStorage.getItem('user-api');
            this.foodID = localStorage.getItem("food-id");
            this.user = localStorage.getItem("user-info");
            if (this.user) {
                this.id = JSON.parse(this.user).id;
                this.name = JSON.parse(this.user).name;
            

            //get menu
            const response = await axios.get(`http://localhost:3000/user/${this.id}`)
            this.favorite = response.data
            this.menus = this.favorite["menu"]
            console.warn(this.menus)
            //neu mon an da co trong menu ca nhan
            this.iAdded = false;
            for (let i = 0; i < this.menus.length; i++) {

                if (this.menus[i].foodID == this.foodID) {
                    this.numAdded = i
                    this.iAdded = true;
                } else {
                    this.iAdded = false;
                }

            }


            //neu nguoi dung da co ten trong danh sach cua mon an

            const takeAway = await axios.get(`http://localhost:3000/favorites?foodID=${this.foodID}`)
            this.takeAway = takeAway.data;
            this.iVoted = false;
            if (this.takeAway.length > 0) {
                this.registerFood = true;
                for (let i = 0; i < this.takeAway[0].votes.length; i++) {

                    if (this.takeAway[0].votes[i] == this.name) {
                        this.iVoted = true;
                        this.numLiked = i;
                    } else {
                        this.iVoted = false;
                    }
                }
            } else {
                this.registerFood = false;
                console.log("Food has not been registered yet")
            }
        } 
        },
        async signUp()
        {
            //let result = await axios.post("http://localhost:3000/user"), {}
            localStorage.setItem("user-api", this.MYapi)
            localStorage.setItem("user-id", this.foodID)
        },
        async loadData() {
            this.loadMenu()

        //other
        
        this.foodID = localStorage.getItem("food-id")
        if (!(this.MYapi && this.foodID)) {
            this.MYapi = '26d4076d12044c1fa3f8428c7700f97a'
            this.foodID = '716429'
            localStorage.setItem("user-api", '26d4076d12044c1fa3f8428c7700f97a')
            localStorage.setItem("food-id", '716429')
        }
        try {
            let result =  await axios.get(`https://api.spoonacular.com/recipes/${this.foodID}/information?apiKey=${this.MYapi}`);
            if (result.status == 404 )
            {
                this.$router.push({name: 'FindPage'})
            }
            this.food = result.data
                    //EXTENDED INGREDIENTS
        const ingredient = this.food['extendedIngredients']
        const listLength = ingredient.length
        
        for (let i = 0; i < listLength; i++) {
            this.recipes = ingredient[i]
            if (ingredient !== null) this.ingredients.push(ingredient[i])
        }
    
        //SUMMARY
        this.summary = this.food['summary']
        document.getElementById("overview").innerHTML = this.summary
        this.foodImage = this.food['image']
        this.title = this.food['title']
        this.prepare = this.food['readyInMinutes']
        }
        catch(err) {
            document.getElementById("errHandler").innerHTML = err.message + "<br><br><p>Note: Error 401: Wrong API Key</p><p>Error 404: Wrong food ID<p>Suggested API Key: 26d4076d12044c1fa3f8428c7700f97a</p><br><p>Suggested food ID: </p><p>716429<br>Apple Or Peach Strudel - ID: 73420<br>Apricot Glazed Apple Tart - ID: 632660<br>Baked Apples in White Wine - ID: 90629<br>Chocolate Silk Pie with Marshmallow Meringue - ID: 284420</p> ";   
        }
 
    
        },
        async removeMenu() {
            this.nonUser();
                                        const response = await axios.get(`http://localhost:3000/user/${this.id}`)
            this.favorite = response.data
        this.menus = this.favorite["menu"]
            if (this.iAdded == true) {
                if (this.numAdded > -1) {
                     this.menus.splice(this.numAdded, 1)
        }
        if (this.user) {
          await axios.put(`http://localhost:3000/user/${this.id}`, {
            id: this.id,
            email: JSON.parse(this.user).email,
            name: JSON.parse(this.user).name,
            password: JSON.parse(this.user).password,
            menu: this.menus,
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
            } 
            this.loadMenu()
            
        },
        async unlike() {
            this.nonUser();
            this.loadMenu()
            if (this.iVoted == true) {
                if (this.registerFood == true) {
                
                let get = this.takeAway[0].votes
                get.splice(this.numLiked, 1)
                await axios.put(`http://localhost:3000/favorites/${this.takeAway[0].id}`, {
                    foodID: this.takeAway[0].foodID,
                    name: this.takeAway[0].name,
                    image: this.takeAway[0].image,
                    votes: get,
                    comments: this.takeAway[0].comments
                });
                
            }

            }
            
        },
        async like() {
            this.nonUser();
            if (this.registerFood == false) {
                const randomNum = comm[Math.floor(Math.random() * comm.length)]
                await axios.post("http://localhost:3000/favorites", {
                    foodID: this.foodID,
                    name: this.title,
                    image: this.foodImage,
                    votes: [this.name],
                    comments: [randomNum]
                });
            } else if (this.registerFood == true) {
                
                let get = this.takeAway[0].votes
                get.push(this.name)
                                await axios.put(`http://localhost:3000/favorites/${this.takeAway[0].id}`, {
                    foodID: this.takeAway[0].foodID,
                    name: this.takeAway[0].name,
                    image: this.takeAway[0].image,
                    votes: get,
                    comments: this.takeAway[0].comments
                });
                
            } else {
                this.$router.push({name: 'LoginPage'})
            }
            this.loadMenu()
            
        },
        async addMenu() {
            this.nonUser();
            //setup
            this.menu = {}
            let user = localStorage.getItem("user-info");

            // let getThis = localStorage.getItem("food-id");
            this.menu.foodID = this.foodID;
            this.menu.name = this.title;
            this.menu.image = this.foodImage;
            this.menu.note = ""
            this.menus.push(this.menu);


                //update
            if (this.user) {
                    this.id = JSON.parse(user).id;
                    await axios.put(`http://localhost:3000/user/${this.id}`, {
                        id: this.id,
                        email: JSON.parse(user).email,
                        name: JSON.parse(user).name,
                        password: JSON.parse(user).password,
                        menu: this.menus,
                    })
                        .then(response => {
                            console.log('Success:', response);
                        })
                        .catch(error => {
                            console.error('Error:', error.response ? error.response.data : error.message);
                        });
                } else {
                    this.$router.push({ name: 'LoginPage' })
            }
            this.loadMenu()
        }
    },
    async mounted() {
        this.loadData()

    }
}

</script>

<style>
td {
  width: 160px;
  height: 40px;
}

</style>