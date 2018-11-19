<template>
    <div>
        Главная
        <button id="show-modal" @click="signIn = true">Show signIn</button>
        <button id="show-modal" @click="signUp = true">Show signUp</button>

        <modal v-if="signIn" @close="signIn = false">
            <h3 slot="header">signIn</h3>
        </modal>

        <modal v-if="signUp" @close="signUp = false">
            <h3 slot="header">signUp</h3>

            <div slot="body">
                <form>
                    <input type="text" v-model="user.name">
                    <input type="text" v-model="user.surname">
                    <input type="text" v-model="user.emal">
                    <input type="text" v-model="user.password">
                    <input type="text" v-model="user.repassword">
                    <button @click="toRegister()">Зерегистрироваться</button>
                </form>
            </div>
        </modal>
        
    </div>
</template>

<script>

import modal from "../components/modal.vue";
import Axios from 'axios';

    export default {
        data() {
            return {
                signIn: false,
                signUp: false,

                user: {
                    name: "",
                    surname: "",
                    emal: "",
                    password: "",
                    repassword: ""
                }
            }
        },
        components: {
            modal
        },
        methods: {
            toRegister() {
                console.log(this.user);

                axios.post("http://mark-on-the-map.mcdir.ru/index.php", {
                    data: user
                })
                .then(response => {                    
                    console.log(response)
                    console.log(response.data)
                })
                .catch(e => {
                    this.errors.push(e)
                })
            }
        }
    }
</script>