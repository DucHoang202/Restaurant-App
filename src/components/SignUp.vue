<template>
    <Header>/</Header>
    <h2>Sign Up</h2>
    <div class="register">
        <input type="text" v-model="name" placeholder="Enter name" v-bind:class="{'form-control is-invalid': error.name}" class="form-control" @blur="validate()"/>
        <div class="invalid-feedback">{{ error.name }}</div>
        <input type="text" v-model="email" placeholder="Enter email" v-bind:class="{'form-control is-invalid': error.email}" class="form-control" @blur="validate()"/>
        <div class="invalid-feedback">{{ error.email }}</div>
        {{ email }}
        <input type="password" v-model="password" placeholder="Enter password" v-bind:class="{'form-control is-invalid': error.password}" class="form-control" @blur="validate()"/>
        <div class="invalid-feedback">{{ error.password }}</div>
        <button v-if="isValid" @click="signUp()">Sign Up</button>
        <button v-else @click="validate()">Sign Up</button>

        <p>
            Have had an account?
            <router-link to="/login">Login</router-link>
        </p>
    </div>
</template>

<script>
import Header from './Header.vue';
import axios from 'axios'


function validPassword(param, alert) {
  const pattern = /^(?=.*[$%^&*])[A-Za-z\d$%^&*]{8,}$/;

  if (!pattern.test(param)) {
    alert =
      "Must contain at least one special character $ % ^ & * and moret than 8 characters long.";
  } else {
    alert = "";
  }
  return alert;
}
export default {
    name: 'SignUp',
    components: {
        Header,
    },
    data() {
        return {
            validEmail2: false,
            validEmail: false,
            error: {
                name: '',
                email: '',
                password: '',
            },
            name: '',
            email: '',
            password: '',
            menu: [],
            isValid: true
        }
    },
    computed: {

    },
    methods: {
        simpleEmail(param, alert) {
            const pattern =
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!pattern.test(param)) {
                alert = "Not valid email";
                this.validEmail = false;
            } else {
                alert = "";
                this.validEmail = true;
            }
            return alert;
        },
        async validate() {
            this.isValid = true;
            this.validEmail = false;
            this.error = {
                name: '',
                email: '',
                password: '',
            }
            if (!this.name) {
                this.error.name = "Name required";
                this.isValid = false;
            }
            if (!this.email) {
                this.error.email = "Email required";
                this.isValid = false;
      
            } 
            else {
                this.error.email = this.simpleEmail(this.email, this.error.email);
            
                if (this.validEmail) {   
                                this.validEmail2 = false;
            let result = await axios.get(`http://localhost:3000/user?email=${this.email}`)

            if (result.data.length > 0) {
                        this.validEmail2 = true;
                    } else {
                        this.validEmail2 =  false;
            }             
                    if ((this.validEmail2) == true) {
                        this.error.email = "Email existed!"
                        this.isValid = false;
                    }
                }

            }
            if (!this.password) {
                this.error.password = "Password required";
                this.isValid = false;
            } else {
                this.error.password = validPassword(
                    this.password,
                    this.error.password
                );
            }

            return this.isValid
        },
        async signUp() {
                let result = await axios.post("http://localhost:3000/user", {
                    email: this.email,
                    name: this.name,
                    password: this.password,
                    menu: this.menu,
                });
                if (result.status == 201) {
                    localStorage.setItem("user-info", JSON.stringify(result.data))
                    this.$router.push({ name: 'HomePage' })
                }

        },
    },
    async mounted() {
        //
            

            //stay
            let user = localStorage.getItem('user-info');
            if (user) {
                this.$router.push({ name: 'HomePage' })
            }
        }
    }

</script>