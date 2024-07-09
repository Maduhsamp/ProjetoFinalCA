<template>
        <div id="nav">
            <div id="logo">
                <router-link to="#">
                    <img src="https://media.glassdoor.com/sqll/2841457/3c-plus-squareLogo-1662652407726.png" alt="imagemLogo3C">
                </router-link>
            </div>
            <div class="icons">
                <i class='bx bx-phone'/>
                <i class='bx bx-bar-chart-square bx-rotate-180' />
                <form @submit.prevent="LogOut">
                    <button class="btnLogOut"><i class='bx bx-log-out'></i></button>
                </form>
            </div>
        </div>
</template>


<script>
import HttpService from '@/services/HttpService';
import { mapActions } from 'vuex';
export default {
    name: "Navbar",
    data(){
        return{

        }
    },
    methods:{
        ...mapActions(['LogOut']),
        async LogOut() {
                try {
                    const response = await HttpService.post('/api/logout', {
                    });
                    this.LogOut();
                    this.$router.push('/'); 
                    console.log('Logout', response.data);
                    } catch (error) {
                    console.error('Logout error:', error);
                }
            },
    }
}
</script>


<style scoped>
    *{
        max-width: 72px;
    }

    #nav{
        max-width: 72px;
        border-right: #E1E9F4 1px solid;
    }

    #logo{
        background: #FFBD00;
        height: 56px;
        width: 72px;
    }

    img{
        width: 42px;
        margin-left: 15px;
        margin-right: 15px;
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .icons{
        background: white;
        display: flex;
        flex-direction: column;
        max-width: 72px;
        height: 700px;
        align-items: center;
    }

    i{
        font-size: 1.3em;
        margin-top: 20px;
        justify-content: center;
    }

    .btnLogOut{
        color: red;
        background: #E1E9F4;
        border: none;
        border-radius: 10px;
        margin-top: 580px;
        height: 40px;
        width: 40px;
        cursor: pointer;
    }

    .btnLogOut i{
        margin: 0 auto;
        display: flex;

    }

    

</style>