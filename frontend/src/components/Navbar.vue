<template>
    <div class="body">

        <div id="nav">
            <div id="logo">
                <router-link to="#">
                    <img src="https://media.glassdoor.com/sqll/2841457/3c-plus-squareLogo-1662652407726.png" alt="imagemLogo3C">
                </router-link>
            </div>
            <div class="icons">
                <i class='bx bx-phone'/>
                <i class='bx bx-bar-chart-square bx-rotate-180' />
                <i class='bx bx-user' ></i>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    name: "Navbar"
}
</script>


<style scoped>
    #nav{
        max-width: 72px;
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
        height: 720px;
        align-items: center;
    }

    i{
        margin-top: 20px;
        font-size: 1.3em;
    }

    i:last-of-type{
        margin-top: 600px;
        border: #E1E9F4 solid 10px;
        border-radius:16px;
        background: #E1E9F4;
    }


    .body{
        background: #E1E9F4;

    }


    

</style>