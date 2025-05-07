<template>
    <div class="menuHead">
    <h1>Spoonacular API powered</h1>
    <div class="nav">
        <router-link to="/">Home</router-link>
        <router-link to="/find">Find Recipe</router-link>
        <router-link to="/local">Local Find</router-link>
        <router-link to="/menu">My Menu</router-link>
        <router-link to="/login">Login</router-link>
        <router-link to="/signup">Sign Up</router-link>
        <router-link to="/ingredients">Ingredients</router-link>
        <router-link to="/features">Features</router-link>
        <a v-on:click="logout()" style="color: white;">Log Out</a>
        <div class="nav">
        <input type="text" v-model="MYapi" placeholder="Your API" value="haha" required> 
        <input type="text" v-model="foodID" placeholder="Food ID" value="716429" required>
        <button type="button" v-on:click="getInfo()">Find Food</button>
        </div>
    </div>
    </div>


</template>

<script>
export default {
    name: 'HeaderNav',
    data() {
        return {
            MYapi:'',
            foodID: ''
        }
    },
    methods: {
        logout()
        {
            localStorage.clear();
            this.$router.push({name: 'LoginPage'})
        },
        async getInfo()
        {
            //let result = await axios.post("http://localhost:3000/user"), {}
            if (!this.foodID) {
                this.foodID = 716429;
                
            }
            if (!this.MYapi) {
                this.MYapi = '26d4076d12044c1fa3f8428c7700f97a';
            }
            localStorage.setItem("user-api", this.MYapi)
            localStorage.setItem("food-id", this.foodID)
            this.$router.push({name: 'HomePage'})
        }
    }
}
</script>

<style>
.nav {
    background-color: #333;
    overflow: hidden;
}
.nav a{
    float: left;
    color: #f2f2f2f2;
    padding: 14px 16px ;
    text-align: center;
    font-size: 17px;
    text-decoration: None;
    margin-right: 5px;
}
.nav a:hover {
    background-image: url("pic.jpg");
    background-size: contain;
    color: #333;
}
.menuHead {
    background-color: #333;
}
h1 {
    background-image: url("pic.jpg");
    background-size: contain;
    background-color: rgba(0, 0, 0, 0.5); /* Black overlay with 50% opacity */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 50px;
    font-family: "Railway", sans-serif;
    font-weight: 900;
    margin-left: 30px;
}



</style>
