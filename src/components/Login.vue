<template>
    <Header>/</Header>
    <h2>Login</h2>
    <div class="login">
        <input type="text" v-model="email" placeholder="Enter email" />
        <input type="password" v-model="password" placeholder="Enter password" />
        <button v-on:click="login">Login</button>
        <p>
            Haven't had an account?
            <router-link to="/signup">Sign Up</router-link>
        </p>
    </div>
</template>

<script>
import Header from './Header.vue';
import axios from 'axios'
 
export default {
    name: 'LoginPage',
    components: {
        Header,
    },
    data()
    {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        async login() {
            let result = await axios.get(`http://localhost:3000/user?email=${this.email}&password=${this.password}`)
            if (result.status==200 && result.data.length > 0)
            {
                localStorage.setItem("user-info", JSON.stringify(result.data[0]))
                this.$router.push({name: 'HomePage'})
            }
            console.warn(result)
        }
    },
    mounted() 
    {
      let user = localStorage.getItem('user-info');
      if (user)
      {
        this.$router.push({name:'HomePage'})
      }
        
    }
}
</script>